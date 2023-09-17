@extends('layouts.success')


@section('title')
     Store Register Success Page
@endsection

@section('content')
    <!-- page content -->
    <div class="page-content page-success">
      <section class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/success.svg" class="mb-4" alt="" />

              <h2>Welcome to Store</h2>

              <p class="mt-3">
                Kamu sudah berhasil terdaftar <br />
                bersama kami. Let’s grow up now.
              </p>

              <div>
                <a href="/dashboard.html" class="btn btn-success w-50 mt-5">My Dashboard</a>
                <a href="/index.html" class="btn btn-signup w-50 mt-2">Go to Shopping</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection