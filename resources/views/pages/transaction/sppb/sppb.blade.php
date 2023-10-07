@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> SPPB</h4>

        {{-- Form SPPB --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="no_sppb" class="form-label">No SPPB</label>
                        <input type="text" class="form-control" id="no_sppb" name="no_sppb"
                            placeholder="SPPB/PNK/08/001" required>
                    </div>
                    <div class="col-md-5">
                        <label for="name_customer" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="name_customer" name="name_customer"
                            placeholder="PT Mito Energi Indonesia" required>
                    </div>
                    <div class="col-md">
                        <label for="po_customer" class="form-label">PO Customer</label>
                        <input type="text" class="form-control" id="po_customer" name="po_customer" placeholder="POI/PKU/23/09/002" required
                            data-bs-toggle="tooltip"
                            data-bs-offset="0,14"
                            data-bs-placement="top"
                            data-bs-html="true"
                            title="Anda dapat mengisikan PO Customer maupun PO Internal"
                        >
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create SPPB</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form SPPB --}}

        {{-- Table SPPB --}}
        <div class="card">
            <h5 class="card-header">Data SPPB</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. SPPB</th>
                                <th>PO Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SPPB/PNK/01/01</td>
                                <td>PO-CUS/01/01</td>
                                <td>20/09/2023</td>
                                <td>
                                    <div class="badge bg-label-success">Done</div>
                                </td>
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
        <!--End Table SPPB -->
    </div>
@endsection