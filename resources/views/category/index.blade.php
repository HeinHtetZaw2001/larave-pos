@extends('layouts.master')
@section('title','category')
@section('content')
   <section>
       <div class="container-fluid">
           <div class="row align-items-center justify-content-center">

               <div class="col-12 col-md-6 ">
                   <div class="card">
                       <div class="card-header">
                           <strong>Category List</strong>
                           <a href="{{route('category.create')}}" class=" float-right btn btn-sm btn-outline-info">
                               create
                           </a>

                       </div>
                       <div class="card-body">
                           <table class="table" id="category-table" style="width:100%">
                               <thead>
                               <tr class="text-center">
                                   <th class="no-sort"></th>
                                   <th class="no-sort">No</th>
                                   <th>Category Name</th>
                                   <th>Created At</th>
                                   <th class="no-sort">Action</th>
                               </tr>
                               </thead>

                           </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
@endsection
@section('script')
    <script>
      $(document).ready(function(){
        let table=  $('#category-table').DataTable({
              responsive: true,
              processing: true,
              serverSide: true,
              ajax: '{!! route('categorySSD') !!}',
              columns: [
                  { data: 'plus-icon', name: 'plus-icon',class:"text-center" },
                  { data: 'id', name: 'id',class:"text-center" },
                  { data: 'name', name: 'name',class:"text-center" },
                  { data: 'created_at', name: 'created_at',class:"text-center" },
                  { data: 'action', name: 'action',class:"text-center" },

              ],
              columnDefs: [
                  {
                      "targets": [ 0 ],
                      "orderable": false
                  },
                  {
                      "targets": [ 0 ],
                      "class": "control"
                  },
                  {
                      "targets": 'no-search',
                      "searchable":false
                  },
                  {
                      'targets': 'no-sort',
                      "orderable":false
                  },
                  {
                      "targets": 'hidden',
                      "visible":false
                  },

              ],
              language: {
                  "paginate": {
                      "next": "<i class='fas fa-arrow-circle-right'></i>",
                      "previous": "<i class='fas fa-arrow-circle-left'></i>"
                  },
                  "processing": "<img src='/image/loading.gif'><p>Loading...</p>",
              }
          });

          $(document).on('click','.delete-category',function(e){

              e.preventDefault();
              var id=$(this).data('id');
              console.log(id);
              swal({

                  text: "Are you sure want to delete!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
                  .then((willDelete) => {
                      if (willDelete) {
                          $.ajax({
                              method: "DELETE",
                              url: `/category/${id}`,
                              success:function(){
                                  table.ajax.reload();
                              }

                          });
                      } else {
                          swal("Your imaginary file is safe!");
                      }
                  });

          });
      })

    </script>
@endsection
