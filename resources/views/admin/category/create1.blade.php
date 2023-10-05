@extends('admin.master')

@section('title' , 'Admin | Category')
@section('content')


<div class="row">
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header bg-transparent">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">Recent Orders</h5>
            </div>
            <div class="col">
              <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                <div class="dropdown">
                  <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                    </li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
           </div>
        </div>
        <div class="card-body">
             @if ($errors->any())

                <ul>
                    @foreach ($errors->all() as $e)
                       <li>{{ $e }}</li>
                    @endforeach
                </ul>
             @endif


          <div class="table-responsive">
               <form id="formcreate" enctype="multipart/form-data" >
               @csrf
               
               <input name="_token" type="hidden" value="{{  csrf_token() }}">
                   <div class="mb-3">
                      <label>Name</label>
                      <input id="name" class="form-control" name="name" placeholder="Category Name">
                   </div>
                   <div class="mb-3">
                    <label>Parent</label>
                    <select id="parent" class="form-control" name="parent" >
                        <option selected disabled>Select Category Parent</option>
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

                 <button type="submit" class="btn btn-info w-100">Submit</button>
               </form>
          </div>
        </div>
      </div>
    </div>



<!-- <div class="list_">

    @foreach($categories as $category)
    <div class='col'>
      <div class='card'>
        <div class='row g-0'>
          <div class='col-md-4'>
            <img src="{{ asset('uploads/' . $category->image)}}" alt="" class="card-img">
          </div>



          <div class="col-md-8">

          <div class="card-body">
            <h5 class="card=title">{{$category->name }}</h5>

            <p class="card-text">{{$category->description}}</p>
            <p class="card-text"><small class="text-muted">{{$category->parent->name}}</small>
          
          
          </div>
          </div>
        </div>
      </div>
    </div>
@endforeach

</div>-->



   <div class="list_">
      @include('admin.parts.list-categories')
   </div>
 


@stop
@section('js')
<script>
    $('#formcreate').submit(function(e){
         // alert('aknkdvs ') ;
        e.preventDefault();
        /* var name = $('#name').val() ;
         var desc = $('#desc').val() ;
         var parent = $('#parent').val() ;
         var image = $('#image').val() ;


         in data ajax =  {
              "name": name ,
              "_token": "{{ csrf_token() }}" ,
              "description": desc ,
              "parent": parent ,
              "image": image
            }


         */
              // console.log(name);
// let cant modify it . var can modify 

        let formdata = new FormData(this)   // FormData is a class , this -> form that we built later
        
      

       $.ajax({
            url: "{{ route('admin.category.category.store') }}" ,
            method: 'POST' ,
            contentType: false  , //means  browser specify the shape of data
            processData: false   ,
            data: formdata,
            success: function(res){
              // console.log(res);
               $('.list_').html(res)
               $('#formcreate').trigger('reset'); // to reset changes (as inputs at form)
            },
            error: function(er){
               alert(er);

            }
        })
    });
</script>


@stop





