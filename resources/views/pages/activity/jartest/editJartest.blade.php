@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity / Jartest /</span> Edit</h4>

        {{-- Form Edit Jartest --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-edit" novalidate action="{{ route('jartest.update', $jartest->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <label for="prospect_id" class="form-label">Code Prospect</label>
                        <select class="form-select select2-bootstrap-5" id="prospect_id" name="prospect_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($prospects as $prospect)
                                <option value="{{ $prospect->id }}" {{ $jartest->prospect_id == $prospect->id ? 'selected' : ''}} {{ old('prospect_id') == $prospect->id ? 'selected' : ''}}>{{ $prospect->code_prospect }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="stock_id" class="form-label">Product Jartest</label>
                        <select class="form-select select2-bootstrap-5" id="stock_id" name="stock_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}" {{ $jartest->stock_id == $stock->id ? 'selected' : ''  }} {{ old('stock_id') == $stock->id ? 'selected' : '' }}>{{ $stock->name_stock }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md">
                        <label for="date_jartest" class="form-label">Date Jartest</label>
                        <input type="date" class="form-control" id="date_jartest" name="date_jartest" value="{{ old('date_jartest', $jartest->date_jartest->format('Y-m-d')) }}" required>
                    </div>

                    <div class="col-12">
                        <label for="remark" class="form-label">Remarks</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="remark" style="height: 140px" name="remark"
                                required>{{ old('remark', $jartest->remark) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('jartest.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" id="submit-input">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Edit Jartest --}}



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
