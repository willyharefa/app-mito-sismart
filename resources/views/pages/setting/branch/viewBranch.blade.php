@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings / Branches / </span> View</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form Branch --}}
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Branch</h5>
                    <small class="text-muted float-end">Information for branch</small>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="code-branch">Code Branch</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge disabled">
                                <span class="input-group-text">
                                    <i class='bx bx-barcode'></i>
                                </span>
                                <input type="text" readonly class="form-control" id="code-branch" value="{{ $branch->code_branch }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name-branch">Name</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge disabled">
                                <span class="input-group-text">
                                    <i class="bx bx-buildings"></i>
                                </span>
                                <input type="text" id="name-branch" readonly class="form-control" value="{{ $branch->name_branch }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="npwp-branch">NPWP</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge disabled">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="npwp-branch" class="form-control" readonly value="{{ $branch->npwp_branch }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="contact-branch">Phone No</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge disabled">
                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input type="text" id="contact-branch" class="form-control phone-mask" readonly value="{{ $branch->contact_branch }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="address-branch">Address Branch</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge disabled">
                                <span id="contact-branch" class="input-group-text">
                                    <i class="bx bx-pin"></i>
                                </span>
                                <input type="text" id="address-branch" class="form-control" readonly value="{{ $branch->address_branch }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="pic-branch">PIC Branch</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge disabled">
                                <span id="contact-branch" class="input-group-text">
                                    <i class="bx bx-user"></i>
                                </span>
                                <input type="text" id="pic-branch" class="form-control phone-mask" readonly value="{{ $branch->pic_branch }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                          <a href="{{ route('branch.index') }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Form Branch --}}

    </div>
@endsection
