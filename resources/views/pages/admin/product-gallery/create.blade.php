@extends('layouts.admin')

@section('title')
   Create Product Gallery
@endsection

@section('content')
<!-- Section Content -->
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Product Gallery</h2>
            <p class="dashboard-subtitle">
                Create New Product Gallery
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                         <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                         </ul>
                         </div>
                    @endif
                    <div class="card">
                         <div class="card-body">
                         <form action="{{ route('product-gallery.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf

                              <div class="row">
                                   
                                   <div class="col-md-12">
                                        <div class="form-group mb-3">
                                             <label  class="mb-1">Product</label>
                                             <select name="products_id"  class="form-control">
                                                  <option value="" selected>
                                                       Pilih Product
                                                  </option>
                                                  @foreach ($products as $product)
                                                       <option data-bs-spy="scroll" data-bs-smooth-scroll="true" class="scrollspy-example" value="{{ $product->id }}">
                                                            {{ $product->name }}
                                                       </option>
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>  

                                   <div class="col-md-12">
                                        <div class="form-group mb-3">
                                             <label  class="mb-1">Foto Product</label>
                                             <input type="file" name="photos" class="form-control"  placeholder="Foto" required>
                                        </div>
                                   </div>

                                   

                                   
                                   
                              </div>

                              <div class="row">
                                   <div class="col text-end mt-3">
                                        <button type="submit" class="btn btn-success px-4">
                                             Save Now
                                        </button>
                                   </div>
                              </div>
                         </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection












