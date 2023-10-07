@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> PO Internal</h4>

        {{-- Form PO Internal --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="po_internal" class="form-label">No PO Internal</label>
                        <input type="text" class="form-control" id="po_internal" name="po_internal"
                            placeholder="POI/PNK/08/001" required>
                    </div>
                    <div class="col-md-5">
                        <label for="name_customer" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="name_customer" name="name_customer"
                            placeholder="PT Mito Energi Indonesia" required>
                    </div>
                    <div class="col-md">
                        <label for="date_po_in" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date_po_in" name="date_po_in" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create PO In</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- End Form PO Internal --}}

        {{-- Table SPPB --}}
        <div class="card">
            <h5 class="card-header">Data PO Internal</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No PO</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>POI/PNK/01/01</td>
                                <td>PDAM Bengkalis</td>
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
        <!--End Table PO Internal -->
    </div>
@endsection