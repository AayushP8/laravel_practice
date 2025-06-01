<x-layout>
    <div class="container">
        <h1><i class="fa fa-home"></i> Dashboard</h1>
        <div class="row">
            {{-- <h3>Welcome {{ Auth::user()->name }}</h3> --}}
            <h3>  Welcome {{ $data->name }}</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>
                    Customer
                    <a href="{{ route('customers.index') }}" class="btn btn-primary float-end"><i class="fa fa-list"></i>  Customer List</a>
                </h4>
            </div>
        </div>
    </div>
</x-layout>
