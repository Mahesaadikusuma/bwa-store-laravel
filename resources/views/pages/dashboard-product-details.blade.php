@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Details
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">{{ $product->name }}</h2>
                <p class="dashboard-subtitle">Product Details</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  
                  <div class="col-12">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                        </div>
                    @endif

                    <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="{{ $product->name }}" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group ">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" aria-describedby="price" name="price" value="{{ $product->price }}" />
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group mb-3">
                                <label for="province" class=" mt-md-0">Province</label>
                                <select name="categories_id" id="province" class="form-control">
                                  <option value="{{ $product->categories_id }}" selected>
                                    Tidak Diganti ({{ $product->category->name }})
                                  </option>
                                  
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{$category->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="editor">
                                  {!! $product->description !!}
                                </textarea>
                              </div>
                            </div>

                            <div class="col d-grid gap-2 mt-3">
                              <button type="submit" class="btn btn-success  ">Update Product</button>
                            </div>

                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        
                        <div class="row">
                          @foreach ($product->galleries as $gallery)
                          <div class="col-md-4 mb-3 mt-lg-3 ">
                            <div class="gallery-container">
                              <img src="{{ Storage::url($gallery->photos ?? '') }}" alt="" class="w-100" />
                              
                              <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}"  class="delete-gallery">
                                <img src="/images/icon-delete.svg" alt="" />
                              </a>
                            </div>
                          </div>
                          @endforeach

                          
                      
              
                        </div>
                        <div class="col mt-3 d-grid mt-3">
                            <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="products_id">
                              <input  type="file"
                                    name="photos"
                                    id="file"
                                    style="display: none;"
                                    multiple
                                    onchange="form.submit()" />

                              <div class="col d-grid gap-2 mt-3">
                                <button type="button"
                                  class="btn btn-secondary btn-block mt-3"
                                  onclick="thisFileUpload()">Add Photo</button>
                              </div>
                            </form>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

    {{-- ini untuk bisa input file untuk ADD FOTO --}}
    <script>
      function thisFileUpload() {
        document.getElementById("file").click();
      }
    </script>

  {{-- END --}}
  
    <script>
      CKEDITOR.replace("editor");
    </script>
@endpush