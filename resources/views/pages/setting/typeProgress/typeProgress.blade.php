@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Type Progress</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        <div class="row">
            <div class="col-xxl">
                {{-- Form Type Progress --}}
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Form</h5>
                        <small class="text-muted float-end">New type progress</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('type-progress.store') }}" method="POST"
                            class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name_progress">New Type</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-category'></i></span>
                                        <input name="name_progress" type="text" class="form-control" id="name_progress"
                                            placeholder="Mapping" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Create Type</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- Form Type Progress --}}
            </div>

            <div class="col-xxl">
                {{-- Table Type Progress --}}
                <div class="card">
                    <h5 class="card-header">Data Type Progress</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-custom" id="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($typeProgress as $key => $progress)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $progress->name_progress }}</td>
                                            <td>
                                                {{-- Button Edit Progress --}}
                                                <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalProgressEdit{{$loop->iteration}}">
                                                    <span class="tf-icons bx bx-message-square-edit"></span>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modalProgressEdit{{$loop->iteration}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('type-progress.update', $progress->id) }}" class="needs-validation form-edit" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Form Edit
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="name_progress_edit" class="form-label">Name Progress</label>
                                                                            <input type="text" id="name_progress_edit" name="name_progress_edit" class="form-control" placeholder="Mapping" value="{{ $progress->name_progress }}" required/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route('type-progress.destroy', $progress->id) }}" class="form-destroy needs-validation d-inline-block" method="POST">
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
                <!--End Table Type Progress -->
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
