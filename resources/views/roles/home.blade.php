@extends('layouts.adminLTE')
@section('title', 'Roles Listing')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            @can('role-create')
            <a class="btn btn-success float-sm-right" href="{{ route('roles.create') }}"> Add Role</a>
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
                    <th>Role Name</th>
                    <th>Role Descripton</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($roles as $role)
                      <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                          <form action="{{ route('roles.delete', $role->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            @can('role-edit')
                            <a href="/admin/roles/{{ $role->id }}/edit" class="btn btn-primary btn-sm" title="Edit">
                              <i class="fas fa-edit"></i>
                              {{-- Edit --}}
                            </a>
                            @endcan
                            @can('role-delete')
                            <button class="btn btn-danger btn-sm" title="Delete">
                              <i class="fas fa-trash-alt"></i>
                              {{-- Delete --}}
                            </button>
                            <a href="/admin/roles/{{ $role->id }}/permission" class="btn btn-primary btn-warning btn-sm" title="Permissions">
                              <i class="fas fa-users-cog"></i>
                              {{-- Permissions --}}
                            </a>
                            @endcan
                          </form>
                        </td>
                      </tr>
                    @empty
                     <tr>
                       <td colspan="3" class="text-center">-No Data-</td>
                     </tr>
                    @endforelse
                  </tbody>
                  <tfoot>
                  <tr>
                    
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>

      </div>
    </section>
@endsection