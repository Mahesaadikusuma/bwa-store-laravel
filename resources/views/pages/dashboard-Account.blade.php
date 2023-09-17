@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product
@endsection

@section('content')
 <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">My Account</h2>
                <p class="dashboard-subtitle">Update your current profile</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    
                    <form action="{{ route('dashboard-myAccount-redirect','dashboard-myAccount') }}" method="POST" enctype="multipart/form-data" id="Locations">
                      @csrf

                      <div class="card">
                        <div class="card-body">
                          <div class="row mb-2">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="name" class="mb-2">Your Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{ $user->name }}" autofocus />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="email" class="mb-2">Your Email</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{ $user->email }}" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="address_one" class="mb-2">Address 1</label>
                                <input type="text" class="form-control" id="address_one" aria-describedby="emailHelp" name="address_one" 
                                value="{{ $user->address_one }}" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="address_two" class="mb-2">Address 2</label>
                                <input type="text" class="form-control" id="address_two" aria-describedby="emailHelp" name="address_two"  value="{{ $user->address_two }}" />
                              </div>
                            </div>
                            

                            <div class="col-md-4 ">
                              <div class="form-group">
                                <label for="provinces_id" class=" mt-md-0">Province</label>
                                <select name="provinces_id" id="provinces_id" class="form-control form-select" v-if="provinces" v-model="provinces_id">
                                  <option v-for="province in provinces" :value="province.id" >
                                    @{{ province.name }} 
                                  </option>
                                </select>
                                <select v-else class="form-control"></select>
                              </div>
                            </div>

                            <div class="col-md-4 ">
                              <div class="form-group">
                                <label for="regencies_id" class=" mt-md-0">City</label>
                                <select name="regencies_id" id="regencies_id" class="form-control form-select" v-if="regencies" v-model="regencies_id">
                                  <option v-for="regency in regencies" :value="regency.id" >
                                    @{{regency.name }}
                                  </option>
                                </select>
                                <select v-else class="form-control"></select>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="postalCode" class="mb-2">Postal Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $user->zip_code }}" />
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="country" class="mb-2">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="mobile" class="mb-2">Mobile</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-right d-grid gap-2">
                              <button type="submit" class="btn btn-success">Save Now</button>
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

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
      var Locations = new Vue({
        el: "#Locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },

        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
            .then(function (responese) {
              self.provinces = responese.data;
            })
          },

          getRegenciesData() {
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
            .then(function (responese) 
            {
              self.regencies = responese.data;
            })
          },


        },
        watch: {
          provinces_id: function(val, oldVal) 
          {
            this.regencies_id = null;
            this.getRegenciesData();
          }
        }
      });
    </script>
@endpush