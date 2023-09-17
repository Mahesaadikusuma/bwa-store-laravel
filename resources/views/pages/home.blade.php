@extends('layouts.app')


@section('title')
        Store Home
@endsection


@section('content')
    <div class="page-content page-home">
      <section class="store-carousel">
        <div class="container">
          <div class="col-lg-12" data-aos="zoom-in">
            <div id="storeCarousel" class="carousel slide" data-bs-ride="false">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#storeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

                <button type="button" data-bs-target="#storeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>

                <button type="button" data-bs-target="#storeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="images/banner.jpg" class="d-block w-100" alt="Carousel Image" />
                  <!-- <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                  </div> -->
                </div>
                <div class="carousel-item">
                  <img src="images/banner.jpg" class="d-block w-100" alt="Carousel Image" />
                  <!-- <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the 2 slide.</p>
                  </div> -->
                </div>
                <div class="carousel-item">
                  <img src="images/banner.jpg" class="d-block w-100" alt="Carousel Image" />
                </div>
              </div>

              <button class="carousel-control-prev" type="button" data-bs-target="#storeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>

              <button class="carousel-control-next" type="button" data-bs-target="#storeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </section>

      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5 class="mt-3 mb-5"><a class="nav-link" href="{{ route('categories') }}">Trend Categories</a> </h5>
            </div>

            <div class="row">
              @php $incrementCategory = 0 @endphp
              @forelse ($categories as $category)
              <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" 
              data-aos-delay="{{ $incrementCategory+= 100 }}">
                <a href="{{ Route('categories-details', $category->slug)}}" class="component-categories d-block">
                  <div class="categories-image">
                    <img src="{{ Storage::url($category->photo) }}" class="w-100" alt="" />
                  </div>
                  <p class="categories-text">{{ $category->name }}</p>
                </a>
              </div>
              @empty
                  <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Categories Not Found
                  </div>
              @endforelse

             
            </div>
          </div>
        </div>
      </section>

      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5 class="py-4">New Products</h5>
            </div>

            <div class="row">
              @php $incrementProduct = 0 @endphp
              @forelse ($produts as $product)
              <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementCategory += 100 }}">
                
                <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                  <div class="product-thumbnail">
                    <div class="product-image" style="
                      @if($product->galleries->count())
                        background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')z
                      @else
                        background-color: #eee;
                      @endif
                    ">
                    </div>
                  </div>
                  <div class="product-text">{{ $product->name }}</div>

                  <div class="product-price">${{ number_format($product->price) }}</div>
                </a>
              </div>
              @empty
                  <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Not Found Product
                  </div>
              @endforelse

              


            </div>
          </div>
        </div>
      </section>
    </div>
@endsection