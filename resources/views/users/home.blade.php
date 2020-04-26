@extends('layouts.adminLTE')
@section('title', 'Users List')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Users</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        @can('role-create')
        <a class="btn btn-success float-sm-right" href="{{ route('users.create') }}"> Add User</a>
        @endcan
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
        @if ($message = Session::get('success'))
          <div class="card-header alert alert-success">
              <p>{{ $message }}</p>
          </div>
        @endif
        <div class="card">
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Roles</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>
                        @forelse ($user->roles as $role)
                          <button class="btn btn-outline-primary btn-sm">{{ $role->name }}</button>
                        @empty
                            
                        @endforelse
                      </td>
                      <td>
                        <form action="/admin/users/{{ $user->id }}" method="POST">
                          @method('DELETE')
                          @csrf
                          {{-- <a href="#" class="btn btn-primary btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                          </a> --}}
                          @can('role-edit')
                          <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                            {{-- Edit --}}
                          </a>
                          @endcan
                          @can('role-delete')
                          <button class="btn btn-danger btn-sm" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                            {{-- Delete --}}
                          </button>
                          @endcan
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td class="text-center" colspan="3">
                        -No Data-
                      </td>
                    </tr>
                  @endforelse
                </tbody>
                <tfoot>
                <tr>
                  
                </tr>
                </tfoot>
              </table>
              <div class="mt-4">
                {{ $users->links() }}
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
    </div>

  </div>
</section>
@endsection