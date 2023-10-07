@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Partner / Customers / </span> Detail</h4>

        {{-- Form Customer --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-5">
                        <label for="name_customer" class="form-label">Name Customer</label>
                        <input type="text" class="form-control" id="name_customer" value="{{ $customer->name_customer }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="stock_name" class="form-label">Type Bussiness</label>
                        <input type="text" class="form-control" id="stock_name" value="{{ $customer->type_bussiness }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" class="form-control" id="npwp" value="{{ $customer->npwp }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" value="{{ $customer->contact }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="pic_customer" class="form-label">PIC Customer</label>
                        <input type="text" class="form-control" id="pic_customer" value="{{ $customer->pic_customer }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="pic_status" class="form-label">PIC Status</label>
                        <input type="text" class="form-control" id="pic_status" value="{{ $customer->pic_status }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" value="{{ $customer->email }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="branch" class="form-label">Branch</label>
                        <input type="text" class="form-control" id="branch" value="{{ $customer->branch->name_branch }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="pic_sales" class="form-label">PIC Sales</label>
                        <input type="text" class="form-control" id="pic_sales" value="{{ $customer->pic_sales }}" readonly>
                    </div>
                    <div class="col-md">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" value="{{ $customer->address }}" readonly>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="about_customer" class="form-label">About Customer</label>
                        <textarea class="form-control" id="about_customer" readonly rows="5">{{ $customer->about_customer }}</textarea>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Customer --}}
    </div>
@endsection
