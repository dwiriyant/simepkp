<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\CustomersImport;
use App\Models\Customer;
use App\Models\Visit;
use App\Models\Recommendation;
use App\Models\ActionPlan;

class CustomerController extends Controller
{
    /**
     * Show the customer list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::all();
        if(Auth::user()->can('isCreditCollection')) {
            $customers = Customer::where('branch_id', Auth::user()->branch_id)->where('aonm', Auth::user()->id)->get();
        } else if(Auth::user()->can('isCreditManager')) {
            $customers = Customer::where('branch_id', Auth::user()->branch_id)->get();
        }
        return view('customer.index', [
            'customers' =>$customers
        ]);
    }

    public function store(Request $request)
    {
        $import = Excel::import(new CustomersImport, $request->file);
        
        if(Session::has('import_customer')) {
            return redirect(route('super-admin.customer.index'));
        } else {
            return redirect(route('super-admin.customer.index'))->with('success', 'Berhasil Upload Data Nasabah!');
        }
    }

    public function detail(Request $request, Customer $customer)
    {
        $visits = Visit::where('customer_id', $customer->id)->orderBy('visit_at', 'desc')->get();
        return view('customer.detail', [
            'customer' => $customer,
            'visits' => $visits
        ]);
    }

    public function create_visit(Request $request, Customer $customer)
    {
        // echo Auth::->user()->unreadNotifications;
        return view('customer.edit', [
            'create' => true,
            'customer' => $customer,
        ]);
    }

    public function store_visit(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'visit_status' => 'required|in:visit_paid,visit_unpaid',
            'result' => 'required_if:visit_status,==,visit_unpaid',
            'document' => 'nullable|file|image|max:2048',
        ]);
        if(isset($validated['document']))
            $validated['document'] = Storage::put('visit/'.$customer->id, $validated['document']);
        $validated['customer_id'] = $customer->id;
        $validated['visit_at'] = date('Y-m-d');
        $validated['status'] = $validated['visit_status'];

        $exist = Visit::where('customer_id', $customer->id)->whereMonth('visit_at', date('m'))->first();
        if($exist)
            return redirect(route('credit-collection.customer.detail', $customer->id))->with('error', 'Anda sudah melakukan kunjungan bulan ini!');
        else
            Visit::create($validated);

        // echo Auth::->user()->unreadNotifications;
        return redirect(route('credit-collection.customer.detail', $customer->id))->with('success', 'Berhasil membuat data kunjungan!');
    }

    public function edit_visit(Request $request, Visit $visit)
    {
        
        return view('customer.edit', [
            'create' => false,
            'visit' => $visit,
            'customer' => $visit->customer
        ]);
    }

    public function update_visit(Request $request, Visit $visit)
    {
        if(Auth::user()->Role->code == "head-office-admin") {
            if($visit->status == 'action_approve') {
                $validated = $request->validate([
                    'deadline' => 'required|date',
                ]);
                $action_plan = ActionPlan::where('visit_id', $visit->id)->first();
                if($action_plan) {
                    $action_plan->deadline = $validated['deadline'];
                    $action_plan->save();
                }
                $visit->status = 'input_deadline';
                $visit->save();                
            } else {
                $validated = $request->validate([
                    'recommendation' => 'required|string',
                ]);
                $input = $validated;
                $visit->status = 'recommendation_validation';
                $visit->save();
                Recommendation::updateOrCreate(
                    [
                        'visit_id' => $visit->id,
                    ],
                    $input,
                );
            }
            
        } else if (Auth::user()->Role->code == "supervisor") {
            $validated = $request->validate([
                'recommendation' => 'required|string',
                'recommendation_status' => 'required|in:recommendation_approve,recommendation_revision',
                'recommendation_correction' => 'required_if:recommendation_status,==,recommendation_revision'
            ]);
            $input['recommendation'] = $validated['recommendation'];
            if($validated['recommendation_correction'])
                $input['recommendation_correction'] = $validated['recommendation_correction'];
            $visit->status = $validated['recommendation_status'];
            $visit->save();
            Recommendation::updateOrCreate(
                [
                    'visit_id' => $visit->id,
                ],
                $input,
            );
        } else if (Auth::user()->Role->code == "credit-collection") {
            if($visit->status == 'input_deadline') {
                $validated = $request->validate([
                    'action' => 'required|in:action_realized',
                ]);
                $action_plan = ActionPlan::where('visit_id', $visit->id)->first();
                if($action_plan) {
                    $action_plan->completion_date = date('Y-m-d');
                    $action_plan->save();
                }
                $visit->status = 'action_realized';
                $visit->save();
            } else {
                $validated = $request->validate([
                    'action' => 'required|string',
                ]);
                ActionPlan::updateOrCreate(
                    [
                        'visit_id' => $visit->id,
                    ],
                    $validated,
                );
                $visit->status = 'action_validation';
                $visit->save();
            }
        } else if (Auth::user()->Role->code == "credit-manager") {
            $validated = $request->validate([
                'action' => 'required|string',
                'action_status' => 'required|in:action_approve,action_revision',
                'action_correction' => 'required_if:action_status,==,action_revision'
            ]);
            $input['action'] = $validated['action'];
            if($validated['action_correction'])
                $input['action_correction'] = $validated['action_correction'];
            $visit->status = $validated['action_status'];
            $visit->save();
            ActionPlan::updateOrCreate(
                [
                    'visit_id' => $visit->id,
                ],
                $input,
            );
        }
        
        return redirect(route(Auth::user()->Role->code.'.customer.detail', $visit->customer->id))->with('success', 'Berhasil mengubah data kunjungan!');
    }
}
