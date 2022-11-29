@extends('layouts.dashboard')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8"></div>
            <div class="col-lg-4">
                {{-- <div class="card">
                    <div class="card-header">
                        <h3>Add Permission</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="permission_name" class="form-control"
                                    placeholder="Add Permission">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <h3>Add Role</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="role_name" class="form-control" placeholder="Add Role">
                            </div>
                            <div class="form-group">
                                <h3>Permissions</h3>
                                @foreach ($permissions as $permission)
                                    <div class="mt-2">
                                        <input type="checkbox" name="permission[]" value="{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
