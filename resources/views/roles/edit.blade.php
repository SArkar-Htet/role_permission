@extends('layouts.adminLTE')
@section('title', 'Roles Edit')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Role</h1>
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
            <form action="{{ route('roles.update', $role->id) }}" method="POST" id="roleEdit">
              @method('PATCH')
              @csrf
              <div class="form-group row">
                <div class="col-sm-2">Role Name</div>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}">
                  <p id="nameError" class="text-danger error"><i class="fas fa-exclamation-circle"></i> Enter a name</p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-2">Role Description</div>
                <div class="col-sm-4">
                  <textarea name="description" class="form-control" id="description" cols="50" rows="5">{{ $role->description }}</textarea>
                  <p id="descriptionError" class="text-danger error"><i class="fas fa-exclamation-circle"></i> Enter this field</p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-2">
                  <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                </div>
                
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-primary">Update</button>
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
  $(document).ready(function () {
    $('#roleEdit').submit(function () {
      var name = $('#name').val();
      var description = $('#description').val();
      if (!name) {
        $('#name').focus();
        $('#nameError').show();
        event.preventDefault();
      } else if( !description ) {
        $('#description').focus();
        $('#descriptionError').show();
        event.preventDefault();
      }
    });

    $('#name').on('keyup', function () {
      $('#nameError').hide();
      $('#descriptionError').hide();
    })
  });
</script>
@endpush