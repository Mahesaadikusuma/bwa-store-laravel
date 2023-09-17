@extends('layouts.app')


@section('title')
    Store Details Page
@endsection


@section('content')
    <!-- page content -->
    <div class="page-contents page-details">
        <section class="store-breadcumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].url" class="w-100 main-image"
                                alt="" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-4 mt-lg-2" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }}</h1>
                            <div class="owner">By {{ $product->user->store_name }}</div>
                            <div class="price">$ {{ number_format($product->price) }}</div>
                        </div>

                        <div class="col-lg-3 d-grid gap-2 d-lg-block" data-aos="zoom-in">
                            @auth
                                <form action="{{ route('detail-add', $product->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-success px-5  text-center text-white  mb-3">Add to
                                        Carts 
                                    </button>
                                </form>
                            @else
                                <a href="{{ Route('login') }}" class="btn btn-success px-5  text-center text-white  mb-3">Sig In
                                    To Add </a>
                            @endauth

                        </div>


                    </div>

                </div>
            </section>

            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-5">
                            <h5 class="mb-5">Customer Review (3)</h5>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-center mb-4 ">
                                        <div class="flex-shrink-0 media">
                                            <img src="/images/icon-review.png" class="rounded-circle me-3" alt="">

                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5>Hazza Risky</h5>
                                            I thought it was not good for living room. I really happy
                                            to decided buy this product last week now feels like homey.
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-shrink-0 media">
                                            <img src="/images/icon-review-2.png" class="rounded-circle me-3" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5>Anna Sukkirata</h5>
                                            Color is great with the minimalist concept. Even I thought it was
                                            made by Cactus industry. I do really satisfied with this.
                                        </div>

                                    </div>

                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-shrink-0 media">
                                            <img src="/images/icon-review-3.png" class="rounded-circle me-3" al">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5>Dakimu Wangi</h5>
                                            When I saw at first, it was really awesome to have with.
                                            Just let me know if there is another upcoming product like this.
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photos) }}",
                        },
                    @endforeach
                ],
            },

            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>
@endpush
