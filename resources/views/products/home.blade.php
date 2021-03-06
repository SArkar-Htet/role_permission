@extends('layouts.adminLTE')
@section('title', 'Products List')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Products</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          @can('product-create')
          <a class="btn btn-success float-sm-right" href="{{ route('products.create') }}"> Add Product</a>
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
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($products as $product)
                      <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                          <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            {{-- <a href="#" class="btn btn-primary btn-sm" title="View">
                              <i class="fas fa-eye"></i>
                            </a> --}}
                            @can('product-edit')
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm" title="Edit">
                              <i class="fas fa-edit"></i>
                              {{-- Edit --}}
                            </a>
                            @endcan
                            @can('product-delete')
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
                        <td colspan="3">--No Data--</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection