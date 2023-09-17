@extends('layouts.app')


@section('title')
     Store Category Page
@endsection

@section('content')
    <!-- page content -->
    <div class="page-contents page-cart">
      <section class="store-breadcumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
          <div class="row">
            <div class="col">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-cart">
        <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table class="table table-borderless table-cart" aria-describedby="Cart">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name &amp; Seller</th>
                    <th scope="col">Price</th>
                    <th scope="col">Menu</th>
                  </tr>
                  <tbody>

                  @php
                  $totalPrice= 0;    
                  @endphp
                  
                  @foreach ($carts as $cart)
                  <tr>
                    <td style="width: 25%;">
                      <img
                        src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                        alt=""
                        class="cart-image"
                      />
                    </td>

                    <td style="width: 35%;">
                      <div class="product-title">{{ $cart->product->name }}</div>
                      <div class="product-subtitle">by {{ $cart->product->user->store_name }}</div>
                    </td>

                    <td style="width: 35%;">
                      <div class="product-title">$ {{ number_format($cart->product->price) }}</div>
                      <div class="product-subtitle">USD</div>
                    </td>

                    <td style="width: 20%;">

                      <form action="{{ route('cart-delete', $cart->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-remove-cart">
                          Remove
                        </button>
                      </form>
                      
                    </td>
                  </tr>
                  @php
                      $totalPrice += $cart->product->price
                  @endphp
                  @endforeach

                  </tbody>
                </thead>
              </table>
            </div>
          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr>
            </div>

            <div class="col-12">
              <h2 class="mb-4">Shipping Details</h2>
            </div>
          </div>

          <form action="{{ route('checkout') }}" id="Locations" enctype="multipart/form-data" method="POST">
            @csrf

            <input type="hidden" name="total_price" value="{{ $totalPrice }}">

          <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-6">
              <div class="form-group">
                <label for="address_one" class="mb-2">Address 1</label>
                <input type="text" id="address_one" name="address_one" class="form-control" placeholder="Setra Duta Cemara" aria-label="Recipient's username" aria-describedby="basic-addon2">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="address_two" class="mb-2 mt-3 mt-md-0">Address 2</label>
                <input type="text" id="address_two" name="address_two" class="form-control" placeholder="Blok B2 No. 34" aria-label="Recipient's username" aria-describedby="basic-addon2">
              </div>
            </div>

            <div class="col-md-4 mt-3">
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

            <div class="col-md-4 mt-3">
              <div class="form-group">
                <label for="regencies_id" class=" mt-md-0">City</label>
                <select name="regencies_id" id="regencies_id" class="form-control form-select" v-if="regencies" v-model="regencies_id">
                  <option v-for="regency in regencies" :value="regency.id" >
                    @{{regency.name }}
                  </option>
                </select>
                <select v-else class="form-control"></select>


                {{-- <label for="regencies_id" class="  mt-md-0">City</label>
                <select name="regencies_id" id="regencies_id" class="form-control">
                  <option value="Bandung">Bandung</option>
                </select> --}}
              </div>
            </div>

            <div class="col-md-4 mt-2">
              <div class="form-group">
                <label for="zip_code" class="mt-2">Postal Code</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="123999" aria-label="Recipient's username" aria-describedby="basic-addon2">
              </div>
            </div>

            <div class="col-md-6 mt-3">
              <div class="form-group">
                <label for="country" class="mb-2">Country</label>
                <input type="text" id="country" name="country" class="form-control" placeholder="Indonesia" aria-label="Recipient's username" aria-describedby="basic-addon2">
              </div>
            </div>

            <div class="col-md-6 mt-3">
              <div class="form-group">
                <label for="phone_number" class="mb-2">Mobile</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="+628 2020 11111" aria-label="Recipient's username" aria-describedby="basic-addon2">
              </div>
            </div>

          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12 ">
              <hr class="mt-5">
            </div>

            <div class="col-12">
              <h2 class="mb-2">Payment Informations</h2>
            </div>
          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-4 col-md-2">
              <div class="product-title">$0</div>
              <div class="product-subtitle">Country Tax</div>
            </div>

            <div class="col-4 col-md-3">
              <div class="product-title">$0</div>
              <div class="product-subtitle">Product Insurance</div>
            </div>

            <div class="col-4 col-md-2">
              <div class="product-title">$0</div>
              <div class="product-subtitle">Ship to Jakarta</div>
            </div>

            <div class="col-4 col-md-2">
              <div class="product-title text-success">$ {{ number_format($totalPrice ?? 0) }}</div>
              {{-- jika totalprice itu gak ada datanya maka akan kosong atau 0 --}}
              <div class="product-subtitle">Total</div>
            </div>

            <div class="col-8 col-md-3 mt-3">
              <button type="submit" class="btn btn-success px-4 d-grid gap-2">Checkout Now</button>
            </div>
          </div>
          </form>
      </section>


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

