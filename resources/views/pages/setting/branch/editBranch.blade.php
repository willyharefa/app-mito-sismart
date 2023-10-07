@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings / Branches / </span> Edit</h4>

        {{-- Form Branch --}}
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Branch</h5>
                    <small class="text-muted float-end">Information for branch</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('branch.update', $branch->id) }}" method="POST" class="needs-validation form-edit">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="code_branch">Code Branch</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-barcode'></i></span>
                                    <input type="text" class="form-control @error('code_branch') is-invalid @enderror" id="code_branch" name="code_branch" value="{{ old('code_branch', $branch->code_branch) }}" required>
                                </div>
                                @error('code_branch')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name_branch">Name</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-buildings'></i></span>
                                    <input type="text" class="form-control @error('name_branch') is-invalid @enderror" id="name_branch" name="name_branch" value="{{ old('name_branch', $branch->name_branch) }}" required>
                                </div>
                                @error('name_branch')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="npwp_branch">NPWP</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                    <input type="text" class="form-control @error('npwp_branch') is-invalid @enderror" id="npwp_branch" name="npwp_branch" value="{{ old('npwp_branch', $branch->npwp_branch) }}" required>
                                </div>
                                @error('npwp_branch')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="contact_branch">Phone No</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-phone'></i></span>
                                    <input type="text" class="form-control @error('contact_branch') is-invalid @enderror" id="contact_branch" name="contact_branch" value="{{ old('contact_branch', $branch->contact_branch) }}" required>
                                </div>
                                @error('contact_branch')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="address_branch">Address Branch</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-pin'></i></span>
                                        <input type="text" class="form-control @error('address_branch') is-invalid @enderror" id="address_branch" name="address_branch" value="{{ old('address_branch', $branch->address_branch) }}" required>
                                    </div>
                                    @error('address_branch')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="pic_branch">PIC Branch</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                                        <input type="text" class="form-control @error('pic_branch') is-invalid @enderror" id="pic_branch" name="pic_branch" value="{{ old('pic_branch', $branch->pic_branch) }}" required>
                                    </div>
                                    @error('pic_branch')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                            <a class="btn btn-secondary" href="{{ route('branch.index') }}">Back</a>
                            <button class="btn btn-outline-primary" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Form Branch --}}

    </div>
@endsection
