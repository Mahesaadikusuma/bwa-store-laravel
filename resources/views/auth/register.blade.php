@extends('layouts.auth')

@section('title')
  Store Register Page
@endsection

@section('content')
<div class="page-content page-auth" id="register">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row row-login align-items-center justify-content-center">
            <div class="col-lg-4">
              <h2>
                Memulai untuk jual beli <br />
                dengan cara terbaru
              </h2>
              @if (session('email'))
                    <div class="alert alert-success">
                        {{ session('email') }}
                    </div>
                  @endif
              <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                  <label class="form-label">Full Name</label>
                  <input id="name" v-model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                  <label class="form-label">Email Address</label>
      
                  <input id="email" v-model="email" @change="checkForEmailAvailability()" 
                  :class="{ 'is-invalid': this.email_unavailable }" 
                  type="email" class="form-control 
                  @error('email') is-invalid @enderror" 
                  name="email" value="{{ old('email') }}" 
                  required autocomplete="email">

                  

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

                <div class="form-group mt-3">
                  <label class="form-label">Password</label>
                  {{-- <input type="Password" class="form-control" /> --}}

                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                </div>

                <div class="form-group mt-3">
                  <label class="form-label">Konfirmasi Password</label>
                  {{-- <input type="Password" class="form-control" /> --}}

                  <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                  @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                </div>

                <div class="form-group mt-3">
                  <label class="form-label">Store</label>
                  <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  id="openStoreTrue" :value="true" v-model="is_store_open" name="is_store_open" />

                  <label class="form-check-label" for="openStoreTrue">Iya, boleh </label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"  id="openStoreFalse" :value="false" v-model="is_store_open" name="is_store_open" />
                  <label class="form-check-label" for="openStoreFalse">Enggak, makasih</label>
                </div>

                <div class="form-group mt-3" v-if="is_store_open">
                  <label class="form-label">Nama Toko</label>
                  <input type="text" 
                    class="form-control  @error('password_confirm') is-invalid @enderror" 
                    v-model="store_name" 
                    id="store_name"
                    name="store_name"
                    required
                    autocomplete
                    autofocus

                    @error('store_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    />
                </div>

                <div class="form-group mt-3" v-if="is_store_open">
                  <label class="form-label">Category</label>
                  <select class="form-control" name="categories_id" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
                </div>

                
                <button type="submit" class="btn btn-success w-100 border-0 mt-3"
                :disabled="this.email_unavailable">Sign Up Now</button>

                <a href="{{ route('login') }}" class="btn btn-signup w-100 border-0 mt-2">Back to Sign In</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>




{{-- <div class="container d-none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
          // this.$toasted.error("Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
          //   position: "top-center",
          //   className: "rounded",
          //   duration: 1000,
          // });
        },
        methods: {
            checkForEmailAvailability: function () {
                var self = this;
                axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: this.email
                        }
                    })
                    .then(function (response) {
                        if(response.data == 'Available') {
                            self.$toasted.show(
                                "Email anda tersedia! Silahkan lanjut langkah selanjutnya!", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                    
                                }
                            );
                            self.email_unavailable = false;
                        } else {
                            self.$toasted.error(
                                "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                }
                            );
                            self.email_unavailable = true;
                        }
                        // handle success
                        console.log(response.data);
                    });
            }
        },

        data() {
          return{
            name: "kenzie",
            email: "mahesaadi03@gmail.com",
            is_store_open: true,
            store_name: "",
            email_unavailable: false,
          }
        },
      });
    </script>
@endpush
