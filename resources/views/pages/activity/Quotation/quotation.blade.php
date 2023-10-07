@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity /</span> Quotation</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form New Jartest --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-create" novalidate action="{{ route('quotation.store') }}"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-md-4">
                        <label for="prospect_id" class="form-label">Code Prospect</label>
                        <select class="form-select select2-bootstrap-5" id="prospect_id" name="prospect_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($prospects as $prospect)
                                <option value="{{ $prospect->id }}">{{ $prospect->code_prospect }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="no_sp" class="form-label">No SP</label>
                        <input type="text" class="form-control" id="no_sp" name="no_sp" required>
                    </div>

                    <div class="col-md-4">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option selected value="">Choose Category</option>
                            <option value="Franco">Franco</option>
                            <option value="Loco">Loco</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="payment" class="form-label">Payment</label>
                        <select class="form-select" id="payment" name="payment" required>
                            <option selected value="">Choose Payment</option>
                            <option value="Cash">Cash</option>
                            <option value="TOP 30 Hari">TOP 30 Hari</option>
                            <option value="TOP 60 Hari">TOP 60 Hari</option>
                            <option value="TOP 90 Hari">TOP 90 Hari</option>
                        </select>
                    </div>

                    <div class="col-md">
                        <label for="date_quotation" class="form-label">Date Quotation</label>
                        <input type="date" class="form-control" id="date_quotation" name="date_quotation" required>
                    </div>

                    <div class="col-12">
                        <label for="remark" class="form-label">Remarks</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="remark" style="height: 140px" name="remark"
                                required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submit-input">New Quotation</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form New Quotation --}}

        {{-- Table Quotation --}}
        <div class="card">
            <h5 class="card-header">Data Quotations</h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-branches" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="8">Code Quotation</th>
                                <th data-priority="1">Code Prospect</th>
                                <th data-priority="2">No SP</th>
                                <th data-priority="6">Category</th>
                                <th data-priority="4">Payment</th>
                                <th data-priority="5">Date Quo.</th>
                                <th data-priority="9">Remark</th>
                                <th data-priority="7">Status </th>
                                <th data-priority="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotations as $key => $quotation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $quotation->code_quotation }}</td>
                                    <td>
                                        <a href="javascript:void(0)">
                                            {{ $quotation->prospect->code_prospect }}
                                        </a>
                                        
                                    </td>
                                    <td>{{ $quotation->no_sp }}</td>
                                    <td>{{ $quotation->category_quotation }}</td>
                                    <td>{{ $quotation->payment }}</td>
                                    <td>{{ $quotation->date_quotation->format('d/m/Y') }}</td>
                                    <td>{{ $quotation->remark }}</td>
                                    <td>
                                        @if ($quotation->status_quotation == 'Progress'|| $quotation->status_quotation == 'Draf')
                                            <span class="badge bg-warning">{{ $quotation->status_quotation }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $quotation->status_quotation }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-info"
                                            href="{{ route('showItemsQuotation', ['quotationId' => $quotation->id]) }}" title="Add item">
                                            <span class="tf-icons bx bx-data"></span>
                                        </a>

                                        <a class="btn btn-icon btn-outline-primary"
                                            href="javascript:void(0);" title="Open">
                                            <span class="tf-icons bx bx-info-circle"></span>
                                        </a>

                                        <a class="btn btn-icon btn-outline-primary"
                                            href="{{ route('quotation.edit', $quotation->id) }}" title="Edit">
                                            <span class="tf-icons bx bx-message-square-edit"></span>
                                        </a>

                                        <form action="{{ route('quotation.destroy', $quotation->id) }}"
                                            class="d-inline-block form-destroy" method="POST">
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
        <!--End Table Penetration -->



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
