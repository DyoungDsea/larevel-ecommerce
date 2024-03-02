@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <!--breadcrumb-->
    <div class="row">
        <div class="col-md-8">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">All Brands</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Brands</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <div class="col-md-4 text-right">
            <a href="{{route('add.brand')}}" class="btn btn-primary">New Brand</a>
        </div>
    </div>
    <!--end breadcrumb-->


    <div class="card radius-10 mt-3">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Brands</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S/N</th>
                            <th>Image</th>
                            <th>Brand</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if(!empty($brands))
                            @foreach($brands as $key => $row)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{url($row->brand_image)}} " alt="">
                                        </div>

                                    </div>
                                </td>
                                <td>{{$row->brand_name}}</td>
                                <td>
                                    <a href="{{route('edit.brand',$row->id)}}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{route('delete.brand',$row->id)}}" id="delete" class="btn btn-danger btn-sm">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="4">Brand Table is empty</td>

                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection