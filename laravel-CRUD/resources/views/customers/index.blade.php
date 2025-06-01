<x-layout>
    <div class="container my-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h4>
                    <i class="fa fa-list"></i> Customer List
                    <a href="{{ url('customers/create') }}" class="btn btn-primary float-end"><i class="fa fa-plus"></i>
                        Add New Customer</a>
                </h4>
                <div class="card my-4">
                    <div class="card-header">
                        <strong><i class="fa fa-sort"></i> FILTER CUSTOMER</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.index') }}" method="GET">
                            <div class="row">
                                <div class="col form-group mb-3">
                                    <label for="firstname">First Name:</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter First Name" value="{{ request('firstname') }}">
                                </div>
                                <div class="col form-group mb-3">
                                    <label for="status">Status:</label>
                                    <select class="form-select" id="status" name="status"
                                        aria-label="Default select example">
                                        <option value="">SELECT</option>
                                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col form-group mb-3">
                                    <label for="sort"><i class="fa fa-arrows-up-down"></i>  Sort:</label>
                                    <select class="form-select" id="sort" name="sort"
                                        aria-label="Default select example">
                                        <option value="">SELECT</option>
                                        <option value="Ascending" {{ request('sort') == 'Ascending' ? 'selected' : '' }}> &uarr; Ascending</option>
                                        <option value="Descending" {{ request('sort') == 'Descending' ? 'selected' : '' }}>
                                           &darr; Descending
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-outline-success"><i class="fa fa-filter"></i>
                                    Apply</button>
                                <a href="{{ route('customers.index') }}" type="submit"
                                    class="btn btn-outline-primary"><i class="fa fa-refresh"></i> Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="my-5 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone No</th>
                            <th scope="col">Profile Picture</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($customers->isNotEmpty())
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->firstname }}</td>
                                    <td>{{ $customer->lastname }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td >{{ $customer->phone }}</td>
                                    <td>
                                        @if (!empty($customer->profile_picture))
                                            <img class="rounded"
                                                src="{{ asset('storage/' . $customer->profile_picture) }}"
                                                alt="customer_photo" style="width:40%;">
                                        @else
                                            <img class="rounded" src="{{ asset('images/Default.png') }}"
                                                alt="customer_photo" style="width:40%;">
                                        @endif
                                    </td>
                                    <td>{{ $customer->status? 'Active':'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info"><i
                                                class="fa fa-user"></i> Show</a>
                                        <a href="{{ route('customers.edit', $customer->id) }}"
                                            class="btn btn-warning"><i class="fa fa-user-pen"></i> Edit</a>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('are You sure You want to delete this record?')"
                                                class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan='8' class="text-center text-danger">No Customer Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            {{ $customers->links() }}
        </div>
    </div>
</x-layout>
