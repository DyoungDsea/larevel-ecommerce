@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin Change Password</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Change Password</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('admin.store.password')}}" method="post">
                                @csrf

                                @if(session('status'))
                                <div class="alert alert-success">{{session('status')}}</div>
                                @elseif(session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                                @endif

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Current Password</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="password" placeholder="********" class="form-control @error('old') is-invalid @enderror" name="old" id="current_password"  />
                                        @error('old')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">New Password</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="password" id="pass" placeholder="********" class="form-control @error('pass') is-invalid @enderror" name="pass"  />
                                        @error('pass')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Confirm Password</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="password" id="cpass" placeholder="********" class="form-control @error('cpass') is-invalid @enderror" name="cpass"  />
                                        @error('cpass')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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