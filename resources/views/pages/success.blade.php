@extends('layouts.success')

@section('title')
  Store Success Page
@endsection

@section('content')
    <!-- PAGE CONTENT -->
    <div class="page-content page-success">
      <section class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/success.svg" class="mb-4" alt="" />
              <h2>Transaction Processed!</h2>
              <p>
                Silahkan tunggu konfirmasi email dari kami dan <br />
                kami akan menginformasikan resi secept mungkin!
              </p>

              <div>
                <a href="{{ route("dashboard") }}" class="btn btn-success w-50 mt-5">My Dashboard</a>
                <a href="{{ route("home") }}" class="btn btn-signup w-50 mt-2">Go to Shopping</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection
