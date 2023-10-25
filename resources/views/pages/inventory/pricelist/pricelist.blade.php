@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Inventory /</span> Pricelist</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form Pricelist --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-create" novalidate action="{{ route('pricelist.store') }}"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="col-md-3">
                        <label for="code_branch" class="form-label">Code Branch</label>
                        <input type="text" class="form-control" id="code_branch" name="code_branch" placeholder="PKU"
                            required>
                    </div>

                    <div class="col-md-5">
                        <label for="name_branch" class="form-label">Name Branch</label>
                        <input type="text" class="form-control" id="name_branch" name="name_branch"
                            placeholder="Pekanbaru" required>
                    </div>

                    <div class="col-md-4">
                        <label for="npwp_branch" class="form-label">NPWP</label>
                        <input type="text" class="form-control" id="npwp_branch" name="npwp_branch"
                            placeholder="00.000.000.0-000.000" required>
                    </div>
                    <div class="col-md-3">
                        <label for="contact_branch" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact_branch" name="contact_branch"
                            placeholder="(+62) 822 7060 3131" required>
                    </div>
                    <div class="col-md-3">
                        <label for="pic_branch" class="form-label">PIC Branch</label>
                        <input type="text" class="form-control" id="pic_branch" name="pic_branch"
                            placeholder="Tn. Taufan" required>
                    </div>
                    <div class="col-md">
                        <label for="address_branch" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address_branch" name="address_branch"
                            placeholder="Jl. Riau No. 16C" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submit-input">Create Branch</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Pricelist --}}

        {{-- Table Branch --}}
        <div class="card">
            <h5 class="card-header">Data Branches</h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-branches" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code Branch</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>NPWP</th>
                                <th>PIC Branch</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($branches as $key => $branch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $branch->code_branch }}</td>
                                    <td>{{ $branch->name_branch }}</td>
                                    <td>
                                        @if ($branch->contact_branch == 'Unavailable')
                                            <span class="badge bg-secondary">{{ $branch->contact_branch }}</span>
                                        @else
                                        {{ $branch->contact_branch }}
                                        @endif
                                    </td>
                                    <td>{{ $branch->npwp_branch }}</td>
                                    <td>{{ $branch->pic_branch }}</td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-primary" href="{{ route('branch.show', $branch->id) }}">
                                            <span class="tf-icons bx bx-info-circle"></span>
                                        </a>

                                        <a class="btn btn-icon btn-outline-primary" href="{{ route('branch.edit', $branch->id) }}">
                                            <span class="tf-icons bx bx-message-square-edit"></span>
                                        </a>

                                        <form action="{{ route('branch.destroy', $branch->id) }}" class="d-inline-block form-destroy" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-outline-danger">
                                                <span class="tf-icons bx bx-trash-alt"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Table Branch -->

    </div>
@endsection
