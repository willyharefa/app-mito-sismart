@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Activity / Penetration / </span> Edit</h4>

        {{-- Form Edit Penetration --}}
        <div class="card mb-4">
            <div class="card-body">
                <form class="row g-3 needs-validation form-edit" novalidate action="{{ route('penetration.update', $penetration->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-5">
                        <label for="prospect_id" class="form-label">Code Prospect</label>
                        <select class="form-select select2-bootstrap-5" id="prospect_id" name="prospect_id"
                            data-placeholder="Type for search..." required>
                            <option></option>
                            @foreach ($prospects as $prospect)
                                <option value="{{ $prospect->id }}" {{ $penetration->prospect_id == $prospect->id ? 'selected' : '' }}>{{ $prospect->code_prospect }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="date_penetration" class="form-label">Date Penetration</label>
                        <input type="date" class="form-control" id="date_penetration" name="date_penetration" value="{{ old('date_penetration', $penetration->date_penetration->format('Y-m-d')) }}" required>
                    </div>

                    <div class="col-12">
                        <label for="remark" class="form-label">Remarks</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="remark" style="height: 100px" name="remark"
                                required>{{ old('remark', $penetration->remark) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('penetration.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" id="submit-input">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Edit Penetration --}}



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
