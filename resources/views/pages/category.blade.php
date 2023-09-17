@extends('layouts.app')


@section('title')
  Store Category Page
@endsection


@section('content')
    <div class="page-content page-home">
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5 class="mt-3 mb-5"><a class="nav-link" href="{{ route('categories') }}">All Categories</a></h5>
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
              <h5 class="py-4"><a class="nav-link" href="{{ route('categories') }}">All Products</a> </h5>
            </div>

            <div class="row">
              @php $incrementProduct = 0 @endphp
              @forelse ($produts as $product)
              <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementCategory += 100 }}">
                <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                  <div class="product-thumbnail">
                    <div class="product-image" style="
                      @if($product->galleries->count())
                        background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                      @else
                        background-color: #eee;
                      @endif
                    ">
                    </div>
                  </div>
                  <div class="product-text">{{ $product->name }}</div>

                  <div class="product-price">${{ $product->price }}</div>
                </a>
              </div>
              @empty
                  <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Not Found Product
                  </div>
              @endforelse
            </div>

            <div class="row">
              <div class="col-12 mt-4 pagination justify-content-end">
                {{ $produts->links() }}
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection