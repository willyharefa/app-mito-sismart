@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Partner / Customers / </span> Edit</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        @foreach ($errors->all() as $item)
            <div class="alert alert-danger">
                {{ $item }}
            </div>
        @endforeach

        {{-- Form Customer --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-edit" action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-5">
                        <label for="name_customer" class="form-label">Name Customer</label>
                        <input type="text" class="form-control @error('name_customer') 
                            is-invalid
                        @enderror" id="name_customer" name="name_customer"
                            placeholder="PT Mito Energi Indonesia" value="{{ old('name_customer', $customer->name_customer) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="stock_name" class="form-label">Type Bussiness</label>
                        <input type="text" class="form-control @error('type_bussiness')
                            is-invalid
                        @enderror" id="stock_name" name="type_bussiness" placeholder="Water Treatment" value="{{ old('type_bussiness', $customer->type_bussiness) }}" required
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,14"
                            data-bs-placement="top"
                            data-bs-html="true"
                            title="<div class='text-left'>Informasi</div><p>Isikan bidang atau jenis usaha customer</p>"
                        >
                    </div>
                    <div class="col-md">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control @error('city') 
                            is-invalid
                        @enderror" id="city" name="city"
                            placeholder="Pekanbaru City" value="{{ old('city', $customer->city) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" class="form-control @error('npwp')
                            is-invalid
                        @enderror" id="npwp" name="npwp" value="{{ old('npwp', $customer->npwp) }}" placeholder="00.000.000.0-000.000">
                    </div>
                    <div class="col-md-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control @error('contact')
                            is-invalid
                        @enderror" id="contact" name="contact" value="{{ old('contact', $customer->contact) }}" placeholder="(+62) 822 7060 3131">
                    </div>
                    <div class="col-md-3">
                        <label for="pic_customer" class="form-label">PIC Customer</label>
                        <input type="text" class="form-control @error('pic_customer')
                            is-invalid
                        @enderror" id="pic_customer" name="pic_customer" value="{{ old('pic_customer', $customer->pic_customer) }}" placeholder="John"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label for="pic_status" class="form-label">PIC Status</label>
                        <input type="text" class="form-control @error('pic_status')
                            is-invalid
                        @enderror" id="pic_status" name="pic_status" value="{{ old('pic_status', $customer->pic_status) }}" placeholder="Manager"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email')
                            is-invalid
                        @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="customer@example.com"
                            required>
                    </div>

                    <div class="col mb-3">
                        <label for="branch" class="form-label">Branch</label>
                        <select class="form-select @error('branch')
                            is-invalid
                        @enderror" id="branch" name="branch" aria-label="Default select example">
                          <option selected>Choose branch</option>
                          @foreach ($branches as $branch)
                              <option value="{{ $branch->id }}" {{ old('branch') == $customer->branch_id ? 'selected' : '' }} {{ $branch->id == $customer->branch_id ? 'selected' : '' }}>{{ $branch->name_branch }}</option>
                          @endforeach
                        </select>
                      </div>

                    <div class="col-md-3">
                        <label for="pic_sales" class="form-label">PIC Sales</label>
                        <input type="text" class="form-control @error('pic_sales')
                            is-invalid
                        @enderror" id="pic_sales" name="pic_sales" value="{{ old('pic_sales', $customer->pic_sales) }}" placeholder="Yudha"
                            required
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,14"
                            data-bs-placement="top"
                            data-bs-html="true"
                            title="<p>Isikan pic sales mito</p>"
                            >
                    </div>
                    <div class="col-md">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address')
                            is-invalid
                        @enderror" id="address" name="address" value="{{ old('address', $customer->address) }}" placeholder="Jl. Riau No. 16C"
                            required>
                    </div>
                    <div class="col-md-">
                        <label for="about_customer" class="form-label">About Customer</label>
                        <textarea class="form-control @error('about_customer')
                            is-invalid
                        @enderror" name="about_customer" id="about_customer" rows="3" required placeholder="This is about customer">{{ old('about_customer', $customer->about_customer) }}</textarea>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Customer --}}

    </div>
@endsection