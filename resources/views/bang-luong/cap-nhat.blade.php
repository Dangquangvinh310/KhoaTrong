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
                <form class="forms-sample" action="{{route('xl_cap_nhat_phong_ban',['id' => $phongBan->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                                <label class="form-label">Tên nhân viên</label>
                                <input type="text" class="form-control" id="user" name="user" value="{{$luong->user->ho_ten}}">
                        </div>
                        <div class="col-6">
                                <label class="form-label">Tổng số ngày làm trong tháng</label>
                                <input type="text" class="form-control" id="tong_ngay_lam" name="tong_ngay_lam" placeholder="Nhập số ngày làm" >
                        </div>
                        <div class="col-6">
                                <label class="form-label">Phụ cấp</label>
                                <input type="text" class="form-control" id="phu_cap" name="phu_cap" placeholder="Nhập phụ cấp" >
                        </div>
                        <div class="col-6">
                                <label class="form-label">Tạm ứng</label>
                                <input type="text" class="form-control" id="tam_ung" name="tam_ung" placeholder="Nhập tạm ứng lương" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection