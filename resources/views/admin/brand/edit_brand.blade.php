@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Add New Brand</li> -->
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container mt-3">
        <div class="main-body">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('store.brand')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Brand Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{$brand->brand_name}}" placeholder="Brand Name" required name="brand_name"  />
                                        <input type="hidden" name="id"  value="{{$brand->id}}" >
                                        <input type="hidden" name="old"  value="{{$brand->brand_image}}" >
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Brand Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" id="image" required class="form-control" name="brand_image" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <img src="{{url('upload/admin_image')}}/no_image.jpg" alt="Admin" class="rounded p-1 bg-primary" id="showImage" width="110">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection