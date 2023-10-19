@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Authentication / Users / </span> Edit</h4>

        {{-- Form Edit User --}}
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Form User</h5>
                <small class="text-muted float-end">Fill information user</small>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="needs-validation form-edit">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name">Bio</label>
                        <div class="col-sm-10">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Full Name" id="name" value="{{ old('name', $user->name)}}" name="name" title="Full Name" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Nickname" name="nickname" value="{{ old('nickname', $user->nickname)}}" title="Nickname" required>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-select" name="gender" required>
                                        <option value="">Choose gender</option>
                                        <option value="Male" {{ $user->gender == "Male" ? "selected" : "" }}>Male</option>
                                        <option value="Female" {{ $user->gender == "Female" ? "selected" : "" }}>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="employee_id">Employee</label>
                        <div class="col-sm-10">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Employee ID" id="employee_id" name="employee_id" value="{{ old('employee_id', $user->employee_id)}}" title="Employee ID" required>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select select2-bootstrap-5" id="position_id" name="position_id"
                                        data-placeholder="Type for search..." required>
                                        <option></option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}" {{ $position->id == $user->position_id ? "selected" : "" }}>{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Email" name="email" title="Email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="phone_number">Account User</label>
                        <div class="col-sm-10">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Phone Number" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number)}}" title="Phone Number" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username', $user->username)}}" title="Username" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" placeholder="Password" name="password" title="Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Back</a>
                            <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form Edit User --}}
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