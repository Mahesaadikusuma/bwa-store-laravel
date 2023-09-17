@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
<!-- Section Content -->
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Category</h2>
            <p class="dashboard-subtitle">
                List of Categories
            </p>
        </div>

        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{  route('category.create') }}" class="btn btn-primary mb-3">
                                + Tambah Kategori Baru
                            </a>
                            
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Foto</th>
                                        <th>Slug</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>c
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

                { data: 'name', name: 'name' },
                { data: 'photo', name: 'photo' },
                { data: 'slug', name: 'slug' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    width: '15%'
                },
            ]
        });
    </script>
@endpush









{{-- @extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">List Of Category</p>
              </div>
              <div class="dashboard-content">
               <div class="row">
                    <div class="col-md-12">
                         <div class="card">
                              <div class="card-body">
                                   <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">
                                        + Tambah Category Baru
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