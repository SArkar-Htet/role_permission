@extends('layouts.adminLTE')
@section('title', 'Roles Rermission')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <a class="btn btn-success float-sm-right" href="{{ route('roles.create') }}"> Add Role</a> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <form action="{{ route('roles.setPermission', $role->id) }}" method="get" id="rolePermission">
                  @method('GET')
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-2">Role Name</div>
                    <div class="col-sm-4">
                      {{ $role->name }}
                      <input type="hidden" name="name" value="{{ $role->name }}">
                    </div>
                  </div>
                  <div class="form-group row my-5">
                    <div class="col-sm-2">Role Description</div>
                    <div class="col-sm-4">
                      {{ $role->description }}
                      <input type="hidden" name="description" value="{{ $role->description }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6">Permission</div>
                  </div>
                  <div class="form-group row">
                    @foreach ($permissions as $permission)
                      <div class="col-sm-2">
                        <div class="form-check">
                          {{-- @forelse ($role->rolePermission as $value)
                            @if ($value->id == $permission->id)
                            <input class="form-check-input" type="checkbox" id="gridCheck1" value="{{ $permission->id }}" name="permission[]" checked>
                            <label class="form-check-label" for="gridCheck1">
                              {{ $permission->name }}
                            </label>
                            @endif
                          @empty --}}
                          @if ($role->isPermission($permission->id, $role->id) != 0)
                          <input class="form-check-input" type="checkbox" id="gridCheck1" value="{{ $permission->id }}" name="permission[]" checked>
                          <label class="form-check-label" for="gridCheck1">
                            {{ $permission->name }}
                          </label>
                          @else
                          <input class="form-check-input" type="checkbox" id="gridCheck1" value="{{ $permission->id }}" name="permission[]">
                          <label class="form-check-label" for="gridCheck1">
                            {{ $permission->name }}
                          </label>
                          @endif
                            {{-- {{ dd($role->permissions) }} --}}
                        </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="row mt-5">
                    <div class="col-sm-2">
                      <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                    </div>
                    <div class="col-sm-4">
                      <button class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            
          </div>
        </div>

      </div>
    </section>
@endsection