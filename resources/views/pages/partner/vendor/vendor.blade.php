@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Partner /</span> Vendor</h4>

        {{-- Form Vendor --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-5">
                        <label for="name_vendor" class="form-label">Name Vendor</label>
                        <input type="text" class="form-control" id="name_vendor" name="name_vendor"
                            placeholder="Mekari" required>
                    </div>
                    <div class="col-md-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Pekanbaru City" required>
                    </div>
                    <div class="col-md-4">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp" placeholder="00.000.000.0-000.000">
                    </div>
                    <div class="col-md-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="(+62) 822 7060 3131">
                    </div>
                    <div class="col-md-3">
                        <label for="pic_vendor" class="form-label">PIC Vendor</label>
                        <input type="text" class="form-control" id="pic_vendor" name="pic_vendor" placeholder="John (Optional)"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="customer@example.com"
                            required>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="branch" class="form-label">Branch</label>
                        <input type="text" class="form-control" id="branch" name="branch" placeholder="Pekanbaru"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label for="pic_purchaser" class="form-label">PIC Purchasing</label>
                        <input type="text" class="form-control" id="pic_purchaser" name="pic_purchaser" placeholder="Nurul"
                            required
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,14"
                            data-bs-placement="top"
                            data-bs-html="true"
                            title="<p>Isikan pic purchasing mito</p>"
                            >
                    </div>
                    <div class="col-md">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Jl. Riau No. 16C"
                            required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create Vendor</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Vendor --}}

        {{-- Table Vendor --}}
        <div class="card">
            <h5 class="card-header">Data Vendor</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>City</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mekari</td>
                                <td>Pekanbaru</td>
                                <td>(+62) 822 9230 3948</td>
                                <td>mekari@example.com</td>
                                <td>
                                    <button type="button" class="btn btn-icon btn-outline-primary">
                                        <span class="tf-icons bx bx-info-circle"></span>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-outline-primary">
                                        <span class="tf-icons bx bx-message-square-edit"></span>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-outline-danger">
                                        <span class="tf-icons bx bx-trash-alt"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Table Vendor -->
    </div>
@endsection