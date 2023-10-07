@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity /</span> Deals</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form New Deals --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-create" novalidate action="{{ route('deal.store') }}"
                    method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="quotation_id" name="quotation_id">
                    <div class="col-md-4">
                        <label for="prospect_id" class="form-label">Code Prospect</label>
                        <select class="form-select select2-bootstrap-5" id="prospect_id" name="prospect_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($prospects as $prospect)
                                <option value="{{ $prospect->id }}">{{ $prospect->code_prospect }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="no_po" class="form-label">No PO</label>
                        <input type="text" class="form-control" id="no_po" name="no_po" required>
                    </div>
                    <div class="col-md-3">
                        <label for="date_deal" class="form-label">Date Deal</label>
                        <input type="date" class="form-control" id="date_deal" name="date_deal" required>
                    </div>
                    <div class="col-12">
                        <label for="remark" class="form-label">Remarks</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="remark" style="height: 90px" name="remark"
                                required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submit-input">New Deal</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form New Quotation --}}

        {{-- Detail Quotation | Prospect --}}
        <div class="card mb-4" id="card-content-detail">
            {{-- <div class="card-header">Additional Information</div>

            <div class="card-body mb-0">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-10">
                        <div class="row g-3">
                            <div class="col-sm-5">
                                <input type="text" class="form-control" placeholder="Name Customer" title="Name Customer">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" placeholder="Phone Number" title="Phone Number Customer">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" placeholder="PIC Customer" title="PIC Customer">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Quotation</label>
                    <div class="col-sm-10">
                        <div class="row g-3">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" placeholder="No Quo" title="No Quo">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" placeholder="No SP" title="No SP">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" placeholder="Category Quotation" title="Category Quotation">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" placeholder="Payment" title="Payment">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 col-form-label">Sales</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control">
                    </div>
                </div>
            </div>

            <div class="card-header mt-0">Product Deals</div>
            <div class="card-body">
                <table class="table table-bordered table-branches" id="table" style="width:100%">
                    <thead>
                        <tr>
                            <th data-priority="0">#</th>
                            <th data-priority="1">Product</th>
                            <th data-priority="2">Packaging</th>
                            <th data-priority="3">QTY</th>
                            <th data-priority="4">Unit</th>
                            <th data-priority="5">Unit/Price</th>
                            <th data-priority="6">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#</td>
                            <td>Meichem SC 01</td>
                            <td>25Kg/zak</td>
                            <td>23</td>
                            <td>Kg</td>
                            <td>Rp. 1000</td>
                            <td>Rp. 10000</td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
        </div>

        {{-- Table Deal --}}
        <div class="card">
            <h5 class="card-header">Data Deals</h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-branches" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="1">Deal</th>
                                <th data-priority="4">Quotation</th>
                                <th data-priority="5">Prospect</th>
                                <th data-priority="6">No PO</th>
                                <th data-priority="7">Remark</th>
                                <th data-priority="2">Status </th>
                                <th data-priority="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
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
            allowClear: true
        });

        $('#prospect_id').on('change', function(e) {
            if($(this).val()) {
                $.ajax({
                    type: "GET",
                    url: "/quotation/" + $(this).val() + "/show",
                    success: res => {
                        $('#quotation_id').val(res.quotation.id);
                        $('#card-content-detail').append(`
                        <div class="card-header">
                            Additional Information
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Customer</label>
                                <div class="col-sm-10">
                                    <div class="row g-3">
                                        <div class="col-sm-5">
                                            <input type="text" readonly class="form-control" placeholder="Name Customer" title="Name Customer" value="${res.prospect.customer.name_customer}">
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" readonly class="form-control" placeholder="Phone Number" title="Phone Number Customer" value="${res.prospect.cp_customer}">
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" readonly class="form-control" placeholder="PIC Customer" title="PIC Customer" value="${res.prospect.customer.pic_customer}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Quotation</label>
                                <div class="col-sm-10">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" readonly placeholder="No Quo" title="No Quo" value="${res.quotation.code_quotation}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control" placeholder="No SP" title="No SP" value="${res.quotation.no_sp}">
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" readonly class="form-control" placeholder="Category Quotation" title="Category Quotation" value="${res.quotation.category_quotation}">
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" readonly placeholder="Payment" title="Payment" value="${res.quotation.payment}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Sales</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control form-control" value="${res.prospect.pic_sales}">
                                </div>
                            </div>

                        </div>

                        <h5 class="card-header">Product Deals</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive" id="table">
                                <thead>
                                    <tr>
                                        <th data-priority="0">#</th>
                                        <th data-priority="1">Product</th>
                                        <th data-priority="2">Packaging</th>
                                        <th data-priority="3">QTY</th>
                                        <th data-priority="4">Unit</th>
                                        <th data-priority="5">Unit/Price</th>
                                        <th data-priority="6">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${res.quotationItem.map((value, index) => `
                                        <tr>
                                            <td>${index+1}</td>
                                            <td>${value.stock.code_stock}</td>
                                            <td>${value.packaging}</td>
                                            <td>${value.qty}</td>
                                            <td>${value.unit}</td>
                                            <td>${value.unit_price}</td>
                                            <td>${value.total_price}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                            </div>
                            
                        </div>
                        
                        `);
                    },
                    error: function() {
                        alert('Error occurred during the AJAX request.');
                    }
                })
            } else {
                $('#card-content-detail').empty();
            }
        })
    </script>
@endpush
