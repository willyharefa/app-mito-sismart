@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity / Quotation /</span> Edit</h4>

        {{-- Form Edit Quotation --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-edit" novalidate action="{{ route('quotation.update', $quotation->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <label for="prospect_id" class="form-label">Code Prospect</label>
                        <select class="form-select select2-bootstrap-5" id="prospect_id" name="prospect_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($prospects as $prospect)
                                <option value="{{ $prospect->id }}" {{ $quotation->prospect_id == $prospect->id ? 'selected' : '' }} {{ old('prospect_id') == $prospect->id ? 'selected' : '' }}>{{ $prospect->code_prospect }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="no_sp" class="form-label">No SP</label>
                        <input type="text" class="form-control" id="no_sp" name="no_sp" value="{{ old('no_sp', $quotation->no_sp) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option selected value="">Choose Category</option>
                            <option value="Franco" {{ $quotation->category_quotation == 'Franco' ? 'selected' : '' }}>Franco</option>
                            <option value="Loco" {{ $quotation->category_quotation == 'Loco' ? 'selected' : '' }}>Loco</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="payment" class="form-label">Payment</label>
                        <select class="form-select" id="payment" name="payment" required>
                            <option selected value="">Choose Payment</option>
                            <option value="Cash" {{ $quotation->payment == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="TOP 30 Hari" {{ $quotation->payment == 'TOP 30 Hari' ? 'selected' : '' }}>TOP 30 Hari</option>
                            <option value="TOP 60 Hari" {{ $quotation->payment == 'TOP 60 Hari' ? 'selected' : '' }}>TOP 60 Hari</option>
                            <option value="TOP 90 Hari" {{ $quotation->payment == 'TOP 90 Hari' ? 'selected' : '' }}>TOP 90 Hari</option>
                        </select>
                    </div>

                    <div class="col-md">
                        <label for="date_quotation" class="form-label">Date Quotation</label>
                        <input type="date" class="form-control" id="date_quotation" name="date_quotation" value="{{ old('date_quotation', $quotation->date_quotation->format('Y-m-d')) }}" required>
                    </div>

                    <div class="col-12">
                        <label for="remark" class="form-label">Remarks</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="remark" style="height: 140px" name="remark"
                                required>{{ old('remark', $quotation->remark) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('quotation.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" id="submit-input">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Edit Quotation --}}



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
@endpush
