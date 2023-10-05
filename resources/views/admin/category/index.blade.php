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
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>#ID</th>
                  <th>Product</th>
                  <th>Parent Category</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $i)
                <tr>
                    <td>#{{ $loop->index }}</td>
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <div class="product-box border">
                           <img src='http://127.0.0.1:8000/admin_assets/images/products/11.png' alt="">
                        </div>
                        <div class="product-info">
                          <h6 class="product-name mb-1">{{ $i->name }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>{{ $i->parent->name }}</td>
                    <td>{{ $i->description }}</td>
                    <td>{{  $i->created_at }}</td>
                    <td>
                      <div class="d-flex align-items-center gap-3 fs-6">
                        <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                        <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                        <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@stop






