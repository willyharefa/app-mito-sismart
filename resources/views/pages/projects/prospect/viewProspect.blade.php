@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects / Prospect /</span> View</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form New Project --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-5">
                        <label for="customer_id" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="customer_id" readonly value="{{ $prospect->customer->name_customer }}">
                    </div>

                    <div class="col-md-4">
                        <label for="pic_customer" class="form-label">PIC Customer</label>
                        <input type="text" class="form-control" id="pic_customer" readonly value="{{ $prospect->pic_customer }}">
                    </div>

                    <div class="col-md-3">
                        <label for="cp_customer" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="cp_customer" readonly value="{{ $prospect->cp_customer }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date_start" class="form-label">Date Start</label>
                        <input type="date" class="form-control" id="date_start" readonly value="{{ $prospect->date_start }}">
                    </div>
                    <div class="col-md-5">
                        <label for="type_service" class="form-label">Type Service</label>
                        <input type="text" class="form-control" id="type_service" readonly value="{{ $prospect->type_service }}">
                    </div>
                    <div class="col-md mb-4">
                        <label for="pic_sales" class="form-label">PIC Sales</label>
                        <input type="text" class="form-control" id="pic_sales" readonly value="{{ $prospect->user->name }}">
                    </div>
                    <div class="col-12">
                        <a href="{{ route('prospect.index') }}" class="btn btn-outline-secondary" id="submit-input">Back</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form New Project --}}
    </div>
@endsection
