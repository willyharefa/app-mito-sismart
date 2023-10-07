@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects / Prospect /</span> Edit</h4>

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
                <form class="row g-3 needs-validation form-edit" novalidate action="{{ route('prospect.update', $prospect->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-5">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-select select2-bootstrap-5" id="customer_id" name="customer_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $customer->id == $prospect->customer_id ? 'selected' : '' }}>{{ $customer->name_customer }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="pic_customer" class="form-label">PIC Customer</label>
                        <input type="text" class="form-control" id="pic_customer" name="pic_customer" placeholder="Toni" value="{{ old('pic_customer', $prospect->pic_customer) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="cp_customer" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="cp_customer" name="cp_customer"
                            placeholder="(+62 822 9090 2920)" value="{{ old('cp_customer', $prospect->cp_customer) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="date_start" class="form-label">Date Start</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" value="{{ old('date_start', $prospect->date_start) }}" required>
                    </div>
                    <div class="col-md-5">
                        <label for="type_service" class="form-label">Type Service</label>
                        <input type="text" class="form-control" id="type_service" name="type_service" placeholder="General Chemical" value="{{ old('type_service', $prospect->type_service) }}" required>
                    </div>
                    <div class="col-md">
                        <label for="pic_sales" class="form-label">PIC Sales</label>
                        <input type="text" class="form-control" id="pic_sales" name="pic_sales" placeholder="Dwi Purwanti" value="{{ old('pic_sales', $prospect->pic_sales) }}" required>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('prospect.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" id="submit-input">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form New Project --}}



    </div>
@endsection

@push('select2')
    <script>
        $('.select2-bootstrap-5').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endpush
