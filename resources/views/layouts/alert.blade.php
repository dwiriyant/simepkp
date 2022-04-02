@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ json_encode($message) }}</strong>
    </div>
@endif

@if (Session::has('import_customer')) 
    <div class="alert alert-danger alert-block">
        <div class="row">
            <div class="col-md-8">
                <p>Terjadi Kesalahan</p>
            </div>
            <div class="col-md-4">
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
        <ul>
            @foreach (Session::get('import_customer') as $val ) 
                <li>
                    {{$val}}
                </li>
            @endforeach
        </ul>
    </div>
    @php
        Session::forget('import_customer');
    @endphp
@endif

@if (Session::has('import_dashboard')) 
    <div class="alert alert-danger alert-block">
        <div class="row">
            <div class="col-md-8">
                <p>Terjadi Kesalahan</p>
            </div>
            <div class="col-md-4">
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
        <ul>
            @foreach (Session::get('import_dashboard') as $val ) 
                <li>
                    {{$val}}
                </li>
            @endforeach
        </ul>
    </div>
    @php
        Session::forget('import_dashboard');
    @endphp
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-block">
        <div class="row">
            <div class="col-md-8">
                <p class="m-0">Terjadi Kesalahan</p>
            </div>
            <div class="col-md-4">
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
 @endif