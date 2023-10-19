@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Authentication /</span> Users</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Alert Errors --}}
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible text-black" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        {{-- End Alert Errors --}}

        {{-- Form New User --}}
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Form User</h5>
                <small class="text-muted float-end">Fill information user</small>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST" class="needs-validation form-create">
                    @csrf
                    @method('POST')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name">Bio</label>
                        <div class="col-sm-10">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Full Name" id="name" value="{{ old('name')}}" name="name" title="Full Name" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Nickname" name="nickname" value="{{ old('nickname')}}" title="Nickname" required>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-select" name="gender" required>
                                        <option value="">Choose gender</option>
                                        <option value="Male" {{ old('gender') == "Male" ? "selected" : "" }}>Male</option>
                                        <option value="Female" {{ old('gender') == "Female" ? "selected" : "" }}>Female</option>
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
                                    <input type="text" class="form-control" placeholder="Employee ID" id="employee_id" name="employee_id" value="{{ old('employee_id')}}" title="Employee ID" required>
                                </div>
                                {{-- <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Position" name="position" value="{{ old('position')}}" title="Position" required>
                                </div> --}}
                                <div class="col-md-4">
                                    <select class="form-select select2-bootstrap-5" id="position_id" name="position_id"
                                        data-placeholder="Type for search..." required>
                                        <option></option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? "selected" : "" }}>{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" title="Email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="phone_number">Account User</label>
                        <div class="col-sm-10">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Phone Number" id="phone_number" name="phone_number" value="{{ old('phone_number')}}" title="Phone Number" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username')}}" title="Username" required>
                                </div>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password')}}" title="Password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- Form New User --}}

        {{-- Table Users --}}
        <div class="card">
            <h5 class="card-header">Data Users</h5>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="4">Employee ID</th>
                                <th>Full Name</th>
                                <th data-priority="1">Nickname</th>
                                <th data-priority="5">Position</th>
                                <th data-priority="6">Email</th>
                                <th data-priority="7">Phone</th>
                                <th data-priority="3">Username</th>
                                <th>Gender</th>
                                <th data-priority="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->employee_id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->nickname }}</td>
                                    <td>{{ $user->position->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                              <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-2"></i> Delete</a>
                                            </div>
                                          </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Table Users -->



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
