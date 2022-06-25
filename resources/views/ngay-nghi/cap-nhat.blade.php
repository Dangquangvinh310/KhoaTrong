@extends('master')
@section('main-content')
@if(session('status'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {{session('error')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Cập nhật phòng ban</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_cap_nhat_ngay_nghi',['id' => $NgayNghi->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Tên nhân viên<span class="required"> *</span></label>
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{$NgayNghi->user->ho_ten}}" readonly>
                                    <div id="error-parley-select-nbd" class="error-date"></div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Ngày bắt đầu<span class="required"> *</span></label>
                                    <input type="date" class="form-control" id="ngay_bat_dau_nghi" name="ngay_bat_dau_nghi"
                                    data-parsley-required-message="Vui lòng nhập ngày bắt đầu"
                                    required value="{{$NgayNghi->ngay_bat_dau_nghi}}">
                                    <div id="error-parley-select-nbd" class="error-date"></div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Ngày kết thúc<span class="required"> *</span></label>
                                    <input type="date" class="form-control" id="ngay_di_lam_lai" name="ngay_di_lam_lai"
                                    data-parsley-required-message="Vui lòng nhập ngày kết thúc"
                                    required value="{{$NgayNghi->ngay_di_lam_lai}}">
                                    <div id="error-parley-select-fd" class="error-date"></div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Lí do<span class="required"> *</span></label>
                                    <input type="text" class="form-control" id="ly_do" name="ly_do" value="{{$NgayNghi->ly_do}}">
                                    <div id="error-parley-select-nbd" class="error-date"></div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Trạng thái<span class="required"> *</span></label>
                                    <input type="text" class="form-control" id="trang_thai" name="trang_thai" value="{{$NgayNghi->trang_thai}}" readonly>
                                    <div id="error-parley-select-nbd" class="error-date"></div>
                                </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection