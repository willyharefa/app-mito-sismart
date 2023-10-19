@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Position</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Alert Error --}}
        @foreach ($errors->all() as $message)
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
        {{-- End Error --}}


        <div class="row">
            {{-- Form Title --}}
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Form position</h5>
                        <small class="text-muted float-end">Fill title for user form</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('position.store') }}" class="needs-validation form-create" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label" for="name_position">Name Position</label>
                                <div class="input-group">
                                    <input type="text" id="name_position" name="name" class="form-control"
                                        placeholder="Director" required title="Name position">
                                </div>
                                <div class="form-text">The title must be unique from databases</div>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Data</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Form Title --}}

            <div class="col-xl">
                {{-- Table Users --}}
                <div class="card">
                    <h5 class="card-header">Data Positions</h5>
                    <div class="card-body">
                        <div class="text-nowrap">
                            <table class="table table-bordered" id="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-priority="0">#</th>
                                        <th data-priority="1">Name Position</th>
                                        <th data-priority="2">Act.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($positions as $position)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $position->name }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-icon btn-outline-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-{{ $position->id }}">
                                                    <span class="tf-icons bx bx-message-square-edit"></span>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modal-edit-{{ $position->id }}"
                                                    tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('position.update', $position->id) }}"
                                                                class="needs-validation form-edit" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalCenterTitle">Form Edit
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col mb-3">
                                                                        <label for="name_position"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" id="name_position"
                                                                            name="name_edit" class="form-control"
                                                                            placeholder="Enter title"
                                                                            value="{{ $position->name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route('position.destroy', $position->id) }}"
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
                <!--End Table Users -->
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        new DataTable('#table', {
            responsive: true,
            aLengthMenu: [
                [5, 25, 50, 100, -1],
                [5, 25, 50, 100, "All"]
            ],
            iDisplayLength: 5,
        })
    </script>
@endpush

