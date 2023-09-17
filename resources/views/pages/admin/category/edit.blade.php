@extends('layouts.admin')

@section('title')
   Edit Category
@endsection

@section('content')
<!-- Section Content -->
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Category</h2>
            <p class="dashboard-subtitle">
                Edit Category
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
                           <form action="{{ route('category.update',$item->id) }}" method="POST" enctype="multipart/form-data" > 
                            @method('PUT')
                              @csrf

                              <div class="row">
                                   <div class="col-md-12">
                                        <div class="form-group mb-3">
                                             <label  class="mb-1">Nama Category</label>
                                             <input type="text" name="name" class="form-control"  placeholder="Nama" required  value="{{ old('name', $item->name) }}">
                                        </div>
                                   </div>

                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label  class="mb-1">Photo Category</label>
                                             <input type="file" name="photo" class="form-control" placeholder="Photo" >
                                        </div>
                                   </div>

                              </div>

                              <div class="row">
                                   <div class="col text-end mt-3">
                                        <button type="submit" class="btn btn-success px-4">Save Now</button>
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












