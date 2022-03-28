<?php

namespace App\Http\Controllers\SuperAdmin;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Helpers;
use App\Imports\DashboardsImport;
use App\Models\Branch;
use App\Models\Dashboard;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $branches = Branch::all();

        if(!$request->branch_id && $branches->isNotEmpty())
            $request->branch_id = $branches[0]->id;
        $filter_branch = $request->branch_id;

        $month_end = date('Y-m-t', strtotime('-1 months'));
        $month_start = date('Y-m-01', strtotime('-6 months'));
        if($request->month) {
            $month_end = date("Y-m-t", strtotime($request->month.'-01'));
            $month_start = date('Y-m-01', strtotime('-5 months', strtotime($month_end)));
        } else {
            $request->month = date('Y-m', strtotime('-1 months'));
        }
        $month_only = date('m', strtotime($month_end));

        $comparison_date = date('Y-m-t', strtotime('-1 year', strtotime($month_end)));

        $last = Dashboard::branch($filter_branch)->whereMonth('month', $month_only)->first();
        $all = Dashboard::branch($filter_branch)->whereBetween('month',[$month_start, $month_end])->orderBy('month', 'asc')->pluck('month');

        $comparison = Dashboard::branch($filter_branch)->where('month', $comparison_date)->first();
        $all->prepend($comparison->month);
        foreach($all as $month_label) {
            $day = date('d', strtotime($month_label));
            $month = Helpers::getNumberToMonth(date('m', strtotime($month_label)));
            $year = date('Y', strtotime($month_label));
            $label[] = $day . '-' . $month . '-' . $year;
        }
        $outstanding_kredit = Dashboard::branch($filter_branch)->whereBetween('month',[$month_start, $month_end])->orderBy('month', 'desc')->pluck('outstanding_kredit');
        foreach ($outstanding_kredit as $key => $value) {
            $outstanding_kredit[$key] = (float)$value;
        }
        $outstanding_kredit->prepend((float)$comparison->outstanding_kredit);
        $outstanding_kredit = json_encode($outstanding_kredit);
        
        $kredit_produktif = Dashboard::branch($filter_branch)->whereBetween('month',[$month_start, $month_end])->orderBy('month', 'desc')->pluck('kredit_produktif');
        foreach ($kredit_produktif as $key => $value) {
            $kredit_produktif[$key] = (float)$value;
        }
        $kredit_produktif->prepend((float)$comparison->kredit_produktif);
        $kredit_produktif = json_encode($kredit_produktif);

        $baki_debet_npl = Dashboard::branch($filter_branch)->whereBetween('month',[$month_start, $month_end])->orderBy('month', 'desc')->pluck('baki_debet_npl');
        foreach ($baki_debet_npl as $key => $value) {
            $baki_debet_npl[$key] = (float)$value;
        }
        $baki_debet_npl->prepend((float)$comparison->baki_debet_npl);
        $baki_debet_npl = json_encode($baki_debet_npl);

        $non_performing_loan = Dashboard::branch($filter_branch)->whereBetween('month',[$month_start, $month_end])->orderBy('month', 'desc')->pluck('non_performing_loan');
        foreach ($non_performing_loan as $key => $value) {
            $non_performing_loan[$key] = (float)$value;
        }
        $non_performing_loan->prepend((float)$comparison->non_performing_loan);
        $non_performing_loan = json_encode($non_performing_loan);

        $growth["outstanding_kredit"] = 0;
        $growth["kredit_produktif"] = 0;
        $growth["baki_debet_npl"] = 0;
        $growth["non_performing_loan"] = 0;
        if($last && $comparison) {
            $growth["outstanding_kredit"] = ($last->outstanding_kredit - $comparison->outstanding_kredit)/$comparison->outstanding_kredit;
            $growth["kredit_produktif"] = ($last->kredit_produktif - $comparison->kredit_produktif)/$comparison->kredit_produktif;
            $growth["baki_debet_npl"] = ($last->baki_debet_npl - $comparison->baki_debet_npl)/$comparison->outstanding_kredit;
            $growth["non_performing_loan"] = $last->non_performing_loan - $comparison->non_performing_loan;
        }

        return view('superAdmin.home', [
            'branches' => $branches,
            'filter_branch' => $filter_branch,
            'last' => $last,
            'outstanding_kredit' => $outstanding_kredit,
            'kredit_produktif' => $kredit_produktif,
            'baki_debet_npl' => $baki_debet_npl,
            'non_performing_loan' => $non_performing_loan,
            'month' => $request->month,
            'label' => json_encode($label),
            'growth' => $growth,
        ]);
    }

    public function store(Request $request)
    {
        $import = Excel::import(new DashboardsImport($request->branch_id), $request->file);
        
        return redirect('super-admin.dashboard')->with('success', 'Berhasil Upload Data Dashboard!');
    }
}
