<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    @stack('addon-style')
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <div class="border-end" id="sidebar-wrapper">
          <div class="sidebar-heading text-center">
            <img src="/images/admin.png" alt="" width="100px" class="my-4" />
          </div>

          <div class="list-group list-group-flush">
            <a href="{{ route('admin-dashboard') }}" class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : '' }}  ">Dashboard</a>

            <a href="{{ route('product.index') }}" 
            class="list-group-item list-group-item-action 
            {{ (request()->is('admin/product')) ? 'active' : '' }}"> Products</a>

            <a href="{{ route('product-gallery.index') }}" 
            class="list-group-item list-group-item-action 
            {{ (request()->is('admin/product-gallery*')) ? 'active' : '' }}">Galleries</a>

            <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action 
            {{ (request()->is('admin/category*')) ? 'active' : '' }} "> Category</a>

            <a href="{{ route('transaction.index') }}" class="list-group-item list-group-item-action 
            {{ (request()->is('admin/transaction*')) ? 'active' : '' }}"> Transactions </a>

            <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action 
            {{ (request()->is('admin/user*')) ? 'active' : '' }} "> Users </a>

            <a href="" class="list-group-item list-group-item-action"> Sign Out </a>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <nav class="navbar navbar-store navbar-expand-lg navbar-light" data-aos="fade-down" style="z-index: 999">
            <button class="btn btn-secondary d-md-none me-auto ms-3" id="menu-toggle">&laquo; Menu</button>

            <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto me-5 d-none d-lg-flex bg-light">
                <li class="nav-item dropdown me-2 ">
                  <a class="nav-link  " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <img src="/images/icon_user.png" alt="" class="rounded-circle  me-3 profile-picture" /> Hi, {{ Auth::user()->name }}</a>

                  <ul class="dropdown-menu ">
                    
                    <li><a class="dropdown-item" href="/">Logout</a></li>
                  </ul>
                </li>


                
              </ul>
              <!-- Mobile Menu -->
              <ul class="navbar-nav d-block d-lg-none mt-3 ms-3">
                <li class="nav-item ">
                  <a class="nav-link" href="#"> Hi, {{ Auth::user()->name }} </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-inline-block" href="#"> Cart </a>
                </li>
              </ul>
            </div>
          </nav>

          {{-- Content --}}
          @yield('content')
        </div>
        <!-- /#page-content-wrapper -->
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


    

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>

    <script src="/script/navbar-scroll.js"></script>
    @stack('addon-script')
  </body>
</html>
