@extends('admin.master')






@section('title' , 'Admin | Category')
@section('content')
  {{-- create modal --}}
    <div id="modal-add" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formcreate" enctype="multipart/form-data" method="POST" action="{{ route('admin.category.category.store') }}" >
                        <input name="_token"  value="{{  csrf_token() }}">
                        <div class="mb-3">
                            <label>Name</label>
                            <input  class="form-control" name="name" placeholder="Category Name">
                        </div>
                        <div class="mb-3">
                            <label>Parent</label>
                            <select  class="form-control" name="parent" >
                                <option selected disabled>Select Category Parent</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea  class="form-control" name="description" placeholder="Category Description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input  class="form-control" type="file" name="image">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

  {{-- update modal --}}
    <div id="modal-update" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formupdate" enctype="multipart/form-data" >
                        <input name="_token" type="hidden" value="{{  csrf_token() }}">
                        <input id="id" name="id" type="hidden">
                        <div class="mb-3">
                            <label>Name</label>
                            <input id="name" class="form-control" name="name" placeholder="Category Name">
                        </div>
                        <div class="mb-3">
                            <label>Parent</label>
                            <select id="parent" class="form-control" name="parent" >
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea id="desc" class="form-control" name="description" placeholder="Category Description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input id="image" class="form-control" type="file" name="image">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <div class="card">
        <div class="card-body">
            <button data-bs-toggle="modal" data-bs-target="#modal-add"   class="btn w-100 mt-3 " style="background-color: #8E0909" type="submit"><span style="color: white">
                                Add
                             </span></button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>parent</th>
                        <th>description</th>
                        <th>date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>

      var table =  $('#datatable').DataTable({
                processing: true ,
                serverSide: true ,
                responsive: true ,

                ajax:{
                    url: "{{ route('admin.category.category.getdata') }}" ,
                },

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": 'image',
                        "name": 'image',
                        render: function (data, type, full, meta) {
                            return `<img src="{{ asset('uploads/${data}') }}" style="width:100px;height:100px;"  class="img-fluid img-thumbnail"> `;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                      data: "name" ,
                      name: "name" ,
                      orderable: true ,
                      searchable: true
                    },
                    {
                        data: "parent" ,
                        name: "parent" ,
                        orderable: true ,
                        searchable: true
                    },
                    {
                        data: "description" ,
                        name: "description" ,
                        orderable: true ,
                        searchable: true
                    },
                    {
                        data: "date" ,
                        name: "date" ,
                        orderable: true ,
                        searchable: true
                    },
                    {
                        data: "actions" ,
                        name: "actions" ,
                        orderable: false ,
                        searchable: false
                    },
                ]
            });


      $('#formcreate').submit(function (e){
          e.preventDefault() ;
          var data = new FormData(this)

          var url=$('#formcreate').attr('action');


          var method=$('#formcreate').attr('method');
          $.ajax({
              contentType: false ,
              processData: false ,
              method: 'POST' ,
              url: "{{ route('admin.category.category.store') }}",
              data: data ,
              success: function (res){
                  toastr.success(res.success)
                  $('#modal-add').modal('hide');
                  $('#formcreate').trigger('reset');
                  table.draw();
              },
          })
      });

      $('#formupdate').submit(function (e){
          e.preventDefault() ;
          var data = new FormData(this)
          $.ajax({
              contentType: false ,
              processData: false ,
              method: 'POST',
              url: "{{ route('admin.category.category.update') }}",
              data: data ,
              success: function (res){
                  toastr.success(res.success)
                  $('#modal-update').modal('hide');
                  $('#formupdate').trigger('reset');
                  table.draw();
              },
          })
      });

// 422 error laravel

      $(document).ready(function (){
          $(document).on('click' , '.edit_btn' , function (e){
              e.preventDefault();
              var button = $(this) ;

              var name = button.data('name');
              var parent = button.data('parent');
              var desc = button.data('desc');
              var id = button.data('id');

              $('#name').val(name);
              $('#parent').val(parent);
              $('#desc').val(desc)  ;
              $('#id').val(id);
          })
      });


      $(document).ready(function (){
          $(document).on('click' , '.delete_btn' , function (e){
              var button = $(this) ;
              var url = button.data('url');
              e.preventDefault() ;
               swal({
                   title: "Hello" ,
                   text: "Are You Sure ?!" ,
                   icon: "warning" ,
                   buttons: true ,
                   dangerMode: true
               }).then(function (willDelete){
                   if(willDelete){
                       $.ajax({
                           url: url ,
                           method: 'DELETE' ,
                           data:{
                               "_token" : "{{ csrf_token() }}" ,
                           },
                           success: function (res){
                               toastr.success("Deleted Successful");
                               table.draw();
                           }
                       });
                   }else{
                       toastr.error("error")
                   }
               })



          })
      })
    </script>


@stop








