@extends('layouts.admin')

@section('title')
    Product Gallery
@endsection

@section('content')
<!-- Section Content -->
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Product Gallery</h2>
            <p class="dashboard-subtitle">
                List of Galleries
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{  route('product-gallery.create') }}" class="btn btn-primary mb-3">
                                + Tambah Gallery Baru
                            </a>
                            <div class="table-responsive ">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>photos</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('addon-script')
    <script>
        // AJAX DataTable
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            // scrollX: true,

            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                // { data: 'id', name: 'id' },

                //ini untuk idnya / nomernya berurutan 
                // kalo satu data yang dihapus akan berurutan
                // misal ada 5 data data ke 3 dihpaus makan akan terurut jadi 1234
                 { "data": null,"sortable": false, 
                     render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
                 },
                
                { data: 'product.name', name: 'product.name' },
                { data: 'photos', name: 'photos' },
            
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
@endpush









{{-- @extends('layouts.admin')

@section('title')
    Product
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">List Of Product</p>
              </div>
              <div class="dashboard-content">
               <div class="row">
                    <div class="col-md-12">
                         <div class="card">
                              <div class="card-body">
                                   <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                                        + Tambah Product Baru
                                   </a>

                                   <div class="table-responsive">
                                        <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                             <thead>
                                                  <tr>
                                                       <th>id</th>
                                                       <th>name</th>	
                                                       <th>photo</th>
                                                       <th>slug</th>
                                                  </tr>
                                             </thead>
                                             <tbody></tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
              </div>
            </div>
     </div>
@endsection


@push('addon-script')
    <script>
     // AJAX DataTable
      var datatable = $('#crudTable').DataTable({
          processing: true,
          serverSide: true,
          ordering: true,
          

          ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'photo', name: 'photo' },
                { data: 'slug', name: 'slug' },
                 {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
      });

          
        
    </script>
@endpush --}}