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
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Thông tin chờ xác nhận</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <form class="forms-sample" action="{{route('xl_duyet',['id' => $thongTinChoCapNhat->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                    <label class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="ho_ten" name="ho_ten"placeholder="Nhập họ tên" readonly
                    value="{{$thongTinChoCapNhat->ho_ten}}">
                </div>
                <div class="col-6">
                    <label class="form-label">CMND/CCCD</label>
                    <input type="text" class="form-control" id="cmnd" name="cmnd"placeholder="Nhập CMND/CCCD" readonly
                    value="{{$thongTinChoCapNhat->cmnd}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" readonly
                    value="{{$thongTinChoCapNhat->ngay_sinh}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Giới tính</label>
                    <input type="text" class="form-control" id="gioi_tinh" name="gioi_tinh"placeholder="Nhập giới tính" readonly
                    value="{{$thongTinChoCapNhat->gioi_tinh}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi"placeholder="Nhập địa chỉ" readonly
                    value="{{$thongTinChoCapNhat->dia_chi}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"placeholder="Nhập số điện thoại" readonly
                    value="{{$thongTinChoCapNhat->so_dien_thoai}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email"placeholder="Nhập email" readonly
                    value="{{$thongTinChoCapNhat->email}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Mã BHXH</label>
                    <input type="text" class="form-control" id="ma_bhxh" name="ma_bhxh"placeholder="Nhập mã bhxh" readonly
                    value="{{$thongTinChoCapNhat->ma_bhxh}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Ngày cấp</label>
                    <input type="date" class="form-control" id="ngay_cap" name="ngay_cap" readonly
                    value="{{$thongTinChoCapNhat->ngay_cap}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Ngày hết hạn</label>
                    <input type="date" class="form-control" id="ngay_het_han" name="ngay_het_han" readonly
                    value="{{$thongTinChoCapNhat->ngay_het_han}}"> 
                </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection