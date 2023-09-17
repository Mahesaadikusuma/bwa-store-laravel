@extends('layouts.admin')

@section('title')
   Create User
@endsection

@section('content')
<!-- Section Content -->
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">User</h2>
            <p class="dashboard-subtitle">
                Create New User
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
                           <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf

                              <div class="row">
                                   <div class="col-md-12">
                                        <div class="form-group mb-3">
                                             <label  class="mb-1">Nama User</label>
                                             <input type="text" name="name" class="form-control"  placeholder="Nama" required>
                                        </div>
                                   </div>  

                                   <div class="col-md-12">
                                        <div class="form-group mb-3">
                                             <label  class="mb-1">Email User</label>
                                             <input type="email" name="email" class="form-control"  placeholder="Email" required>
                                        </div>
                                   </div>

                                   <div class="col-md-12">
                                        <div class="form-group mb-3">
                                             <label  class="mb-1">Password User</label>
                                             <input type="password" name="password" class="form-control"  placeholder="Password" required>
                                        </div>
                                   </div>

                                   <div class="col-md-12">
                                        <div class="form-group mb-3">
                                             <label  class="mb-1">Roles</label>
                                             <select name="roles" required id="" class="form-control">
                                                <option selected>Open this select menu</option>
                                                <option value="ADMIN">Admin</option>
                                                <option value="USER">User</option>
                                             </select>
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












