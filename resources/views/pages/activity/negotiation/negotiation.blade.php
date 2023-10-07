@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity /</span> Negotiation</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form New Negotiation --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-create" novalidate action="{{ route('negotiation.store') }}"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-md-6">
                        <label for="prospect_id" class="form-label">Code Prospect</label>
                        <select class="form-select select2-bootstrap-5" id="prospect_id" name="prospect_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($prospects as $prospect)
                                <option value="{{ $prospect->id }}">{{ $prospect->code_prospect }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="date_negotiation" class="form-label">Date Negotiation</label>
                        <input type="date" class="form-control" id="date_negotiation" name="date_negotiation" required>
                    </div>

                    <div class="col-12">
                        <label for="remark" class="form-label">Remarks</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="remark" style="height: 140px" name="remark"
                                required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submit-input">New Negotiation</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form New Jartest --}}

        {{-- Table Negotiation --}}
        <div class="card">
            <h5 class="card-header">Data Negotiation</h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-branches" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="1">Code Nego</th>
                                <th data-priority="2">Code Prospect</th>
                                <th data-priority="3">Date Nego</th>
                                <th data-priority="6">Remarks</th>
                                <th data-priority="5">Status </th>
                                <th data-priority="4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($negotiations as $key => $negotiation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $negotiation->code_negotiation }}</td>
                                    <td>
                                        <a href="javascript:void(0)">
                                            {{ $negotiation->prospect->code_prospect }}
                                        </a>
                                        
                                    </td>
                                    <td>{{ $negotiation->date_negotiation->format('d/m/Y') }}</td>
                                    
                                    <td>{{ $negotiation->remark }}</td>
                                    <td>
                                        @if ($negotiation->status_negotiation == 'Progress')
                                            <span class="badge bg-warning">{{ $negotiation->status_negotiation }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $negotiation->status_negotiation }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-primary"
                                            href="javascript:void(0);" title="Open">
                                            <span class="tf-icons bx bx-info-circle"></span>
                                        </a>

                                        <a class="btn btn-icon btn-outline-primary"
                                            href="{{ route('negotiation.edit', $negotiation->id) }}" title="Edit">
                                            <span class="tf-icons bx bx-message-square-edit"></span>
                                        </a>

                                        <form action="{{ route('negotiation.destroy', $negotiation->id) }}"
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
