<x-layout>
        <div class="container my-5">
            <div class="breadcrumbs">
                <ul>
                    @if(Session::has('breadcrumbs'))
                        @foreach (Session::get('breadcrumbs') as $crumb)
                            <li><a href="{{ $crumb['url'] }}">{{ $crumb['title'] }}</a> /</li>
                        @endforeach
                    @endif
                  </ul>
            </div>
            <div class="row mt-6 d-flex justify-content-center">
                <div class="col-12 col-sm-10 col-md-6 mb-5 mb-lg-0">
                    <div class="card border-dark text-center">
                        <div class=" profile-thumbnail mx-auto mt-6">
                            @if (!empty($customer->profile_picture))
                                <img class="card-img-top border-0 rounded-circle" src="{{ asset('storage/'.$customer->profile_picture) }}"
                                    alt="customer_photo">
                            @else
                                <img class="card-img-top border-0 rounded-circle" src="{{ asset('images/Default.png') }}" alt="customer_photo"
                                    style="width:40%;">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-2">{{ $customer->firstname }} {{ $customer->lastname}}</h5>
                            <span class="card-subtitle text-gray font-weight-normal"><i class="fa fa-envelope"> </i> {{ $customer->email }}</span>
                            <p><strong><i class="fa fa-phone"></i> Phone:</strong>{{ $customer->phone }}</p>
                            <p><strong>Status:</strong>{{ $customer->status }}</p>
                            <a href="{{ route('customers.index') }}" class="btn btn-outline-dark"><i class="fa fa-arrow-left"></i>  Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>

