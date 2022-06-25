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
            <h5 class="card-header">Thêm mới nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_them_nhan_vien')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Mã nhân viên</label>
                            <input type="text" class="form-control" placeholder="Nhập mã nhân viên" id="ma_nhan_vien" name="ma_nhan_vien" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ tên" id="ho_ten" name="ho_ten" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" placeholder="Nhập tên đăng nhập" id="username" name="username" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password"  required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">CCCD/CMND</label>
                            <input type="text" class="form-control" placeholder="Nhập CMND/CCCD" id="cmnd" name="cmnd">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select"
                                id="gioi_tinh" name="gioi_tinh">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ" id="dia_chi" name="dia_chi">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="so_dien_thoai" name="so_dien_thoai">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Nhập email" id="email" name="email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Mã BHXH</label>
                            <input type="text" class="form-control" placeholder="Nhập mã bhxh" id="ma_bhxh" name="ma_bhxh">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Ngày cấp</label>
                            <input type="date" class="form-control" id="ngay_cap" name="ngay_cap">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Ngày hết hạn</label>
                            <input type="date" class="form-control" id="ngay_het_han" name="ngay_het_han">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Phòng ban</label>
                            <select class="form-select " 
                                id="phong_ban_id" name="phong_ban_id">
                                @foreach($phongBans as $phongBan)
                                <option value="{{ $phongBan->id }}">{{ $phongBan->ten_phong_ban }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Chức vụ</label>
                            <select class="form-select " 
                                id="chuc_vu_id" name="chuc_vu_id">
                                @foreach($chucVus as $chucVu)
                                <option value="{{ $chucVu->id }}">{{ $chucVu->ten_chuc_vu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Ngày nhận chức</label>
                            <input type="date" class="form-control" id="ngay_nhan_chuc" name="ngay_nhan_chuc">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection