@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product
@endsection

@section('content')
  <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Store Settings</h2>
                <p class="dashboard-subtitle">Make store that profitable</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">


                    <form action="{{ route('dashboard-myAccount-redirect','dashboard-settings-store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card">
                        <div class="card-body p-3">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="storeName">Store Name</label>
                                <input type="text" class="form-control" id="storeName" aria-describedby="emailHelp" name="store_name" value="{{ $user->store_name }}" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="category">Category</label>
                                
                                <select name="categories_id" id="category" class="form-control">
                                  <option value="{{ $user->categories_id }}">Tidak Diganti</option>
                                  
                                    @foreach ($categories as $category)
                                          <option value="{{ $category->id }}">
                                              {{$category->name }}
                                          </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="is_store_open">Store Status</label>
                                <p class="text-muted">Apakah saat ini toko Anda buka?</p>
                                <div class="form-check form-check-inline">
                                  <input
                                    type="radio"
                                    class="custom-control-input"
                                    name="store_status"
                                    id="openStoreTrue"
                                    value="1"
                                    {{ $user->store_status == 1 ? 'checked' : '' }}
                                  />
                                  <label
                                    for="openStoreTrue"
                                    class="custom-control-label"
                                  >
                                    Buka
                                  </label>
                                </div>

                                <div class="form-check form-check-inline">
                                  <input
                                    type="radio"
                                    class="custom-control-input"
                                    name="store_status"
                                    id="openStoreFalse"
                                    value="0"
                                    {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}
                                  />
                                  <label
                                    for="openStoreFalse"
                                    class="custom-control-label"
                                  >
                                    Sementara Tutup
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-end">
                              <button type="submit" class="btn btn-success px-5">Save Now</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection