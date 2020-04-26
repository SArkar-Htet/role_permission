@extends('layouts.adminLTE')
@section('title', 'Products Create')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Product</h1>
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
                <form action="{{ route('products.store') }}" method="POST"  id="productCreate">
                  @method('POST')
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-2">Product Name</div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                      <p id="nameError" class="text-danger error"></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Price</div>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="price" name="price">
                      <p id="priceError" class="text-danger error"></p>
                    </div>
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
      $('#productCreate').submit(function () {
        var name = $('#name').val();
        var price = $('#price').val();
        if (!name) {
          $('#name').focus();
          $('#nameError').show();
          $('#nameError').html('<i class="fas fa-exclamation-circle"></i> Enter a name');
          event.preventDefault();
        } else if(!price) {
          $('#price').focus();
          $('#priceError').show();
          $('#priceError').html('<i class="fas fa-exclamation-circle"></i> Enter price');
          event.preventDefault();
        } 
      });

      $('#name').on('keyup', function () {
        $('#nameError').hide();
      });

      $('#price').on('keyup', function () {
        $('#priceError').hide();
      });

    });
  </script>
@endpush  