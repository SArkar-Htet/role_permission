@extends('layouts.adminLTE')
@section('title', 'Users Edit')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              @if (count($errors) > 0)
                <div class="card-header alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
              @endif
              <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST"  id="userEdit">
                  @method('PUT')
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-2">Name</div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                      <p id="nameError" class="text-danger error"></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Email</div>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                      <p id="emailError" class="text-danger error"></p>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-2">Roles</div>
                  </div>
                  <div class="form-group row">
                    @foreach ($roles as $key => $value)
                    <div class="col-sm-2">
                      @if ($user->isRole($user->id, $key) == 1)
                      <div class="form-check">
                        <input class="form-check-input role[]" type="checkbox" value="{{ $key }}" name="role" checked>
                        <label class="form-check-label" for="gridCheck1">
                          {{ $value }}
                        </label>
                      </div>
                      @else
                        <div class="form-check">
                          <input class="form-check-input role" type="checkbox" value="{{ $key }}" name="role[]">
                          <label class="form-check-label" for="gridCheck1">
                            {{ $value }}
                          </label>
                        </div>
                      @endif
                      
                      <p id="roleError" class="text-danger error"></p>
                    </div>
                    @endforeach
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-2">
                      <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                    </div>
                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-primary">Save</button>
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

@push('scripts')
  <script>
    $(document).ready(function(){
      $('#userEdit').submit(function () {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm = $('#confirm').val();
        if (!name) {
          $('#name').focus();
          $('#nameError').show();
          $('#nameError').html('<i class="fas fa-exclamation-circle"></i> Enter a name');
          event.preventDefault();
        } else if(!email) {
          $('#email').focus();
          $('#emailError').show();
          $('#emailError').html('<i class="fas fa-exclamation-circle"></i> Enter an email');
          event.preventDefault();
        } 
      });

      $('#name').on('keyup', function () {
        $('#nameError').hide();
      });

      $('#email').on('keyup', function () {
        $('#emailError').hide();
      });
    });
  </script>
@endpush  