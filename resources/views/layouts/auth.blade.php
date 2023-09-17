<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    {{-- style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
  </head>
  <body>
    {{-- Navbar --}}
    @include('includes.navbar-auth')

    <!-- PAGE CONTENT -->
    @yield('content')

    {{-- footer --}}
     @include('includes.footer')

    {{-- script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
    @push('addon-script')
      <script src="/vendor/vue/vue.js"></script>
      <script>
        var gallery = new Vue({
          el: "#gallery",
          mounted() {
            AOS.init();
          },
          data: {
            activePhoto: 1,
            photos: [
              {
                id: 1,
                url: "/images/product-details-1.jpg",
              },

              {
                id: 2,
                url: "/images/product-details-2.jpg",
              },

              {
                id: 3,
                url: "/images/product-details-3.jpg",
              },

              {
                id: 4,
                url: "/images/product-details-4.jpg",
              },

              {
                id: 5,
                url: "/images/product-details-5.jpg",
              },
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
  </body>
</html>
