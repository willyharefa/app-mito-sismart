@extends('components.app.layouts')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Inventory / Stock Master / </span> Edit</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        @foreach ($errors->all() as $item)
            <div class="alert-danger">
                {{ $item }}
            </div>
        @endforeach

        {{-- Form Stock --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('stocks.update', $stock->id) }}" method="POST" class="row g-3 needs-validation form-edit">
                    @csrf
                    @method('PUT')
                    <div class="col-md-3">
                        <label for="code_stock" class="form-label">Stock Code</label>
                        <input type="text" class="form-control" id="code_stock" name="code_stock"
                            placeholder="MEICHEM SC 02" required value="{{ old('code_stock', $stock->code_stock) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="name_stock" class="form-label">Stock Name</label>
                        <input type="text" class="form-control" id="name_stock" name="name_stock"
                            placeholder="Alkalinity Booster" value="{{ old('name_stock', $stock->name_stock) }}" required>
                    </div>
                    <div class="col-md">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Pcs" value="{{ old('unit', $stock->unit) }}">
                    </div>
                    <div class="col-md">
                        <label for="packaging" class="form-label">Packaging</label>
                        <input type="text" class="form-control" id="packaging" name="packaging" placeholder="25Kg/zak" value="{{ old('packaging', $stock->packaging) }}">
                    </div>
                    <div class="col-md">
                        <label for="branch_id" class="form-label">Bin</label>
                        <select class="form-select" id="branch_id" name="branch_id" required>
                            <option selected value="">Choose Bin ...</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $stock->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name_branch }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Stock --}}
    </div>
@endsection
