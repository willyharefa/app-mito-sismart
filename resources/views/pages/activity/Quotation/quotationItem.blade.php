@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity / Quotation / </span> Items</h4>

        @foreach ($errors->all() as $message)
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Detail Quotation --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Quotation Data</h5>
                <small class="text-muted float-end">Information Quotation</small>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-4">
                        <label for="customer" class="form-label">Customer</label>
                        <input type="text" readonly class="form-control" id="customer"
                            value="{{ $quotation->prospect->customer->name_customer }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="prospect_id" class="form-label">Code Prospect</label>
                        <input type="text" readonly class="form-control"
                            value="{{ $quotation->prospect->code_prospect }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="no_sp" class="form-label">No SP</label>
                        <input type="text" readonly class="form-control" id="no_sp" value="{{ $quotation->no_sp }}"
                            required>
                    </div>
                    <div class="col-md-4">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" readonly class="form-control" id="category"
                            value="{{ $quotation->category_quotation }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="payment" class="form-label">Payment</label>
                        <input type="text" readonly class="form-control" id="payment" value="{{ $quotation->payment }}"
                            required>
                    </div>
                    <div class="col-md-4">
                        <label for="date_quotation" class="form-label">Date Quotation</label>
                        <input type="text" readonly class="form-control" id="date_quotation"
                            value="{{ $quotation->date_quotation->format('d/m/Y') }}" required>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('quotation.index') }}" class="btn btn-secondary">
                            Back Home
                        </a>
                        @if ($quotationItems->isNotEmpty() && $quotation->status_quotation == 'Draf')
                            <form action="{{ route('updateStatusQuotation', ['quotationId' => $quotation->id]) }}"
                                class="d-inline form-submit-quotation" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-info">
                                    <span class="tf-icons bx bx-check"></span> Submit Quotation
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Quotation Detail --}}

        {{-- Form New Quotation --}}
        @if ($quotation->status_quotation == 'Draf')
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row g-3 needs-validation form-create" novalidate
                        action="{{ route('quotation-item.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="{{ $quotation->id }}" name="quotation_id">
                        <div class="col-md-4">
                            <label for="stock_id" class="form-label">Product</label>
                            <select class="form-select select2-bootstrap-5" id="stock_id" name="stock_id"
                                data-placeholder="Type for search..." required>
                                <option></option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->id }}">{{ $stock->code_stock }} |
                                        {{ $stock->name_stock }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="packaging" class="form-label">Packaging</label>
                            <input type="text" class="form-control" id="packaging" readonly name="packaging"
                                placeholder="25Kg/Sak" required>
                        </div>

                        <div class="col-md-4">
                            <label for="unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="unit" readonly name="unit"
                                placeholder="Kg" required>
                        </div>
                        <div class="col-md-4">
                            <label for="qty" class="form-label">QTY</label>
                            <input type="number" class="form-control numericInput" id="qty" name="qty"
                                value="0" required>
                        </div>
                        <div class="col-md-4">
                            <label for="unit_price" class="form-label">Unit/Price</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control numericInput" id="unit_price" value="0"
                                name="unit_price" placeholder="10.000" required>
                            </div>
                                  
                        </div>
                        <div class="col-md-4">
                            <label for="total_price" class="form-label">Total Price</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control numericInput" readonly id="total_price" value="0"
                                name="total_price" placeholder="10.000" value="0" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" id="submit-input">Add Item</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        {{-- Form New Quotation --}}

        {{-- Table Quotation Items --}}
        <div class="card">
            <h5 class="card-header">Quotation Items</h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-branches" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="8">Quotation ID</th>
                                <th data-priority="1">Product</th>
                                <th data-priority="2">Packaging</th>
                                <th data-priority="6">QTY</th>
                                <th data-priority="6">Unit</th>
                                <th data-priority="4">Price</th>
                                <th data-priority="5">Total Price</th>
                                <th data-priority="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotationItems as $key => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->quotation->code_quotation }}</td>
                                    <td>{{ $item->stock->name_stock }}</td>
                                    <td>{{ $item->packaging }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ 'Rp '. number_format($item->unit_price, 2, ',', '.')}}</td>
                                    <td>{{ 'Rp '. number_format($item->total_price, 2, ',', '.')}}</td>
                                    <td>
                                        @if ($quotation->status_quotation == 'Draf')
                                            <form action="{{ route('quotation-item.destroy', $item->id) }}"
                                                class="d-inline-block form-destroy" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-outline-danger">
                                                    <span class="tf-icons bx bx-trash-alt"></span>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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
        });
    </script>
    <script>
        var selectElement = $("#stock_id");
        $('#stock_id').change(function(e) {
            var selectedValue = $(this).val();
            $.ajax({
                type: "GET",
                url: "/product/" + selectedValue,
                success: res => {
                    $('#packaging').val(res.packaging);
                    $('#unit').val(res.unit);
                },
                error: function() {
                    alert('Error occurred during the AJAX request.');
                }
            })
        })
    </script>
    <script>
        let numericInput = document.querySelectorAll(".numericInput");
        numericInput.forEach(element => {
            element.addEventListener("input", function() {
                // Remove non-numeric and non-decimal point characters using a regular expression
                var sanitizedValue = element.value.replace(/[^0-9.]/g, '');

                // Ensure there's only one decimal point
                var decimalCount = sanitizedValue.split('.').length - 1;
                if (decimalCount > 1) {
                    sanitizedValue = sanitizedValue.substring(0, sanitizedValue.lastIndexOf('.'));
                }

                // Update the input field with the sanitized value
                element.value = sanitizedValue;
            });
        });
    </script>

    <script>
        var qtyInput = document.getElementById("qty");
        var unitPriceInput = document.getElementById("unit_price");
        var totalPriceInput = document.getElementById("total_price");

        // Function to calculate the total
        function calculateTotal() {
            var qty = parseFloat(qtyInput.value) || 0;
            var unitPrice = parseFloat(unitPriceInput.value) || 0;

            var total = qty * unitPrice;
            totalPriceInput.value = total.toFixed(2); // Display the total with two decimal places
        }

        // Add event listeners to qty and price inputs to trigger calculation
        qtyInput.addEventListener("input", calculateTotal);
        unitPriceInput.addEventListener("input", calculateTotal);
    </script>
@endpush
