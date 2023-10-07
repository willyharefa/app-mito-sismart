@extends('components.app.layouts')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Inventory /</span> Stock Master</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Alert Errors --}}
        @foreach ($errors->all() as $message)
            <div class="alert alert-danger alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
        {{-- Alert Error --}}

        {{-- Form Stock --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('stocks.store') }}" method="POST" class="row g-3 needs-validation form-create">
                    @csrf
                    @method('POST')
                    <div class="col-md-3">
                        <label for="code_stock" class="form-label">Stock Code</label>
                        <input type="text" class="form-control" id="code_stock" name="code_stock"
                            placeholder="MEICHEM SC 02" required>
                    </div>
                    <div class="col-md-3">
                        <label for="name_stock" class="form-label">Stock Name</label>
                        <input type="text" class="form-control" id="name_stock" name="name_stock"
                            placeholder="Alkalinity Booster" required>
                    </div>
                    <div class="col-md">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Pcs" required>
                    </div>
                    <div class="col-md">
                        <label for="packaging" class="form-label">Packaging</label>
                        <input type="text" class="form-control" id="packaging" name="packaging" placeholder="25Kg/zak" required>
                    </div>
                    <div class="col-md">
                        <label for="branch_id" class="form-label">Bin</label>
                        {{-- <input type="text" class="form-control" id="branch_id" name="branch_id" placeholder="Pekanbaru" --}}
                            {{-- required> --}}
                        <select class="form-select" id="branch_id" name="branch_id" required>
                            <option selected value="">Choose Bin ...</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name_branch }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create Stock</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Stock --}}


        {{-- Table Stock --}}
        <div class="card">
            <h5 class="card-header">Data stock</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Stock Code</th>
                                <th>Stock Name</th>
                                <th>Unit</th>
                                <th>Packaging</th>
                                <th>Bin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stock->code_stock }}</td>
                                    <td>{{ $stock->name_stock }}</td>
                                    <td>{{ $stock->unit }}</td>
                                    <td>{{ $stock->packaging }}</td>
                                    <td>{{ $stock->branch->name_branch }}</td>
                                    <td>
                                        <a class="btn btn-icon btn-outline-primary" href="{{ route('stocks.edit', $stock->id) }}">
                                            <span class="tf-icons bx bx-message-square-edit"></span>
                                        </a>

                                        <form action="{{ route('stocks.destroy', $stock->id) }}" class="d-inline-block form-destroy" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-outline-danger">
                                                <span class="tf-icons bx bx-trash-alt"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Table Stock -->
    </div>
@endsection
