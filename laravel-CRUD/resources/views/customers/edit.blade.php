<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-center">
                    <h4>
                        <i class="fa fa-user-pen"></i> EDIT CUSTOMER {{ $customer->firstname }}
                    </h4>
                </div>
            </div>
            <div>
                <form action="{{ route('customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <x-form-group type="text" id="firstname" name="firstname" placeholder="Enter First Name"
                        label="First Name:" :value="$customer->firstname ?? ''" />
                    <x-form-group type="text" id="lastname" name="lastname" placeholder="Enter Last Name"
                        label="Last Name:" :value="$customer->lastname ?? ''" />
                    <x-form-group type="email" id="email" name="email" placeholder="Enter email"
                        label="Email Address:" :value="$customer->email ?? ''" />
                    <x-form-group type="text" id="phone" name="phone" placeholder="Enter Phone Number"
                        label="Phone:" :value="$customer->phone ?? ''" />
                    {{-- <div class="form-group mb-3">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" value="{{ old('firstname') }}">
                    </div> --}}
                    {{-- @error('firstname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
                    {{-- <div class="form-group mb-3">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="{{ old('lastname') }}">
                    </div>
                    @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
                    {{-- <div class="form-group mb-3">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
                    {{-- <div class="form-group mb-3">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}
                    <div class="form-group mb-3">
                        <label for="profile_picture">Profile Picture:</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                            placeholder="Upload Photo">
                        <div class="my-2">
                            @if (!empty($customer->profile_picture))
                                <img class="border rounded" src="{{ asset('storage/' . $customer->profile_picture) }}"
                                    alt="customer_photo" width="200">
                            @else
                                <img class="border rounded" src="{{ asset('images/Default.png') }}" alt="customer_photo"
                                width="200">
                            @endif
                        </div>
                    </div>
                    @error('profile_picture')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="status">Status:</label>
                        <select class="form-select" id="status" name="status" aria-label="Default select example">
                            <option value="">SELECT</option>
                            <option value="1" @if (old('status', $customer->status ?? '') == '1') selected @endif>Active</option>
                            <option value="0" @if (old('status', $customer->status ?? '') == '0') selected @endif>Inactive</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-outline-warning"><i class="fa fa-pen"></i> Update</button>
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-dark"><i class="fa fa-arrow-left"></i> Back</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
