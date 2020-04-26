@extends('layouts.adminLTE')
@section('title', 'Users Create')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add User</h1>
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
                <form action="{{ route('users.store') }}" method="POST"  id="userCreate">
                  @method('POST')
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-2">Name</div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                      <p id="nameError" class="text-danger error"></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Email</div>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="email" name="email">
                      <p id="emailError" class="text-danger error"></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Password</div>
                    <div class="col-sm-4">
                      <input type="password" class="form-control" id="password" name="password">
                      <p id="passwordError" class="text-danger error"></p>
                      <input type="hidden" name="length" id="length">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Confirm Password</div>
                    <div class="col-sm-4">
                      <input type="password" class="form-control" id="confirm" name="Confirmpassword">
                      <p id="confirmError" class="text-danger error"></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Roles</div>
                  </div>
                  <div class="form-group row">
                    @foreach ($roles as $key => $value)
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input role" type="checkbox" value="{{ $key }}" name="role[]">
                        <label class="form-check-label" for="gridCheck1">
                          {{ $value }}
                        </label>
                      </div>
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
      $('#userCreate').submit(function () {
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
        } else if(!password) {
          $('#password').focus();
          $('#passwordError').show();
          $('#passwordError').html('<i class="fas fa-exclamation-circle"></i> Enter a password');
          $('#length').val(0);
          event.preventDefault();
        } else if(password.length < 6) {
          $('#password').focus();
          $('#passwordError').show();
          $('#passwordError').html('<i class="fas fa-exclamation-circle"></i> Use 6 characters or more for your password');
          $('#length').val(1);
          event.preventDefault();
        } else if(!confirm) {
          $('#confirm').focus();
          $('#confirmError').show();
          $('#confirmError').html('<i class="fas fa-exclamation-circle"></i> Confirm your password');
          event.preventDefault();
        } else if(confirm != password) {
          $('#confirm').focus();
          $('#confirmError').show();
          $('#confirmError').html('<i class="fas fa-exclamation-circle"></i> Password and confirm password must match');
          event.preventDefault();
        }
      });

      $('#name').on('keyup', function () {
        $('#nameError').hide();
      });

      $('#email').on('keyup', function () {
        $('#emailError').hide();
      });

      $('#password').on('keyup', function () {
        var password = $('#password').val();
        var length = $('#length').val();
        if (password && length == 0) {
          $('#passwordError').hide();
        }
        if (password && length == 1) {
          if (password.length >= 6) {
            $('#passwordError').hide(); 
          }
        }
      });
      
      $('#confirm').on('keyup', function () {
        var confirm = $('#confirm').val();
        if (confirm) {
          $('#confirmError').hide();
        }
      });
    });
  </script>
@endpush  