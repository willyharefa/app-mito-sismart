@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Projects /</span> Prospect</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form New Prospect --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-create" novalidate action="{{ route('prospect.store') }}"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-md-5">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-select select2-bootstrap-5" id="customer_id" name="customer_id"
                            data-placeholder="Choose customer..." required>
                            <option></option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name_customer }}</div></option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="pic_customer" class="form-label">PIC Customer</label>
                        <input type="text" class="form-control" id="pic_customer" name="pic_customer" placeholder="Toni"
                            required>
                    </div>

                    <div class="col-md-3">
                        <label for="cp_customer" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="cp_customer" name="cp_customer"
                            placeholder="(+62) 822 9090 2920" required>
                    </div>
                    <div class="col-md-3">
                        <label for="date_start" class="form-label">Date Start</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" required>
                    </div>
                    <div class="col-md-5">
                        <label for="type_service" class="form-label">Type Service</label>
                        <input type="text" class="form-control" id="type_service" name="type_service"
                            placeholder="General Chemical" required>
                    </div>
                    <div class="col-md-4">
                        <label for="user_id" class="form-label">PIC Sales</label>
                        <select class="form-select select2-bootstrap-5" id="user_id" name="user_id"
                            data-placeholder="Choose sales..." required>
                            <option></option>
                            @foreach ($sales as $item)
                                <option value="{{ $item->id }}" {{ old('user_id') == $item->position_id ? "selected" : "" }}>{{ $item->nickname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submit-input">Create Prospect</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form New Prospect --}}

        {{-- Table Project --}}
        <div class="card">
            <h5 class="card-header">Data Prospect</h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="2">ID Project</th>
                                <th data-priority="1">Customer</th>
                                <th data-priority="9">Type Service</th>
                                <th data-priority="3">Date Start</th>
                                <th data-priority="4">CP Customer</th>
                                <th data-priority="5">PIC Sales</th>
                                <th data-priority="6">Status</th>
                                <th data-priority="7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prospects as $key => $prospect)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prospect->code_prospect }}</td>
                                    <td>{{ $prospect->customer->name_customer }}</td>
                                    <td>{{ $prospect->type_service }}</td>
                                    <td>{{ date('d/m/Y', strtotime($prospect->date_start)) }}</td>
                                    <td>{{ $prospect->cp_customer }}</td>
                                    <td>{{ $prospect->user->name }}</td>
                                    <td>
                                        @if ($prospect->status_prospect == 'Progress')
                                            <span class="badge bg-warning">{{ $prospect->status_prospect }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $prospect->status_prospect }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-primary" href="{{ route('prospect.show', $prospect->id) }}" title="Open">
                                            <span class="tf-icons bx bx-info-circle"></span>
                                        </a>

                                        <a class="btn btn-icon btn-outline-primary" href="{{ route('prospect.edit', $prospect->id) }}" title="Edit">
                                            <span class="tf-icons bx bx-message-square-edit"></span>
                                        </a>

                                        <form action="{{ route('prospect.destroy', $prospect->id) }}" class="d-inline-block form-destroy" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-outline-danger">
                                                <span class="tf-icons bx bx-trash-alt"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Table Project -->



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
