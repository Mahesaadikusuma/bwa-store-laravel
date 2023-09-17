@extends('layouts.dashboard')

@section('title')
    Store Dashboard Transactions
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">Big result start from the small one</p>
              </div>

              <div class="dashboard-content">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="sell-tab" data-bs-toggle="pill" data-bs-target="#sell" type="button" role="tab" aria-controls="sell" aria-selected="true">Sell Product</a>
                  </li>

                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="buy-tab" data-bs-toggle="pill" data-bs-target="#buy" type="button" role="tab" aria-controls="buy" aria-selected="false">Buy Product</a>
                  </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="sell" role="tabpanel" aria-labelledby="sell-tab" tabindex="0">
                    <div class="row mt-3">
                      <div class="col-12 mt-2">

                        @foreach ($sellTransactions as $transactions)
                        <a class="card card-list d-block" href="{{ route('dashboard-transactions-details', $transactions->id) }}">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-1">
                                <img src="{{ Storage::url($transactions->product->galleries->first()->photos ?? '' ) }}" class="w-75" />
                              </div>
                              <div class="col-md-4">{{$transactions->product->name}}</div>
                              <div class="col-md-3">{{$transactions->product->user->store_name}}</div>
                              <div class="col-md-3">{{$transactions->created_at->isoFormat('D MMMM Y')}}</div>
                              <div class="col-md-1 d-none d-md-block">
                                <img src="/images/dashboard-arrow-right.svg" alt="" />
                              </div>
                            </div>
                          </div>
                        </a>
                        @endforeach
                        

                        <div class="row">
                          <div class="col-12 mt-5  pagination justify-content-center">
                            {{ $sellTransactions->links() }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="buy" role="tabpanel" aria-labelledby="buy-tab" tabindex="0">
                    <div class="row mt-3">
                      <div class="col-12 mt-2">
                        
                        @foreach ($buyTransactions as $transactions)
                        <a class="card card-list d-block" href="{{ route('dashboard-transactions-details', $transactions->id) }}">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-1">
                                <img src="{{ Storage::url($transactions->product->galleries->first()->photos ?? '' ) }}" class="w-75" />
                              </div>
                              <div class="col-md-4">{{$transactions->product->name}}</div>
                              <div class="col-md-3">{{$transactions->product->user->store_name}}</div>
                              <div class="col-md-3">{{$transactions->created_at->isoFormat('D MMMM Y')}}</div>
                              <div class="col-md-1 d-none d-md-block">
                                <img src="/images/dashboard-arrow-right.svg" alt="" />
                              </div>
                            </div>
                          </div>
                        </a>
                        @endforeach

                        <div class="row">
                          <div class="col-12 mt-5  pagination justify-content-center">
                            {{ $buyTransactions->links() }}
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection