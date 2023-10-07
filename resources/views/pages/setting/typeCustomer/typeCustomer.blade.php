@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Type Customers</h4>

        <div class="row">
            <div class="col-xxl">
                {{-- Form Type Customer --}}
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Form</h5>
                      <small class="text-muted float-end">New type customer</small>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">New Type</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span id="basic-icon-default-fullname2" class="input-group-text"
                                ><i class='bx bx-category'></i></span>
                              <input
                                name="name_type_customer"
                                type="text"
                                class="form-control"
                                id="basic-icon-default-fullname"
                                placeholder="Water Treatment "
                              />
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
                {{-- Form Type Customer --}}
            </div>

            <div class="col-xxl">
                {{-- Table Branch --}}
                <div class="card">
                    <h5 class="card-header">Data Type Customer</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>PKU</td>
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
                <!--End Table Branch -->
            </div>
        </div>
    </div>
@endsection