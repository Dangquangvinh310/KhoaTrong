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
            <h5 class="card-header">Cập nhật thông tin</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_cap_nhat_thong_tin')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Mã nhân viên</label>
                            <input type="text" class="form-control" id="ma_nhan_vien" name="ma_nhan_vien" placeholder="Nhập mã nhân viên" required readonly
                            value="{{$user->ma_nhan_vien}}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="ho_ten" name="ho_ten"placeholder="Nhập họ tên" required
                            value="{{$user->ho_ten}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">CCCD/CMND</label>
                            <input type="text" class="form-control" id="cmnd" name="cmnd" placeholder="Nhập CMND/CCCD"
                            value="{{$user->cmnd}}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                            value="{{$user->ngay_sinh}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select " 
                                id="gioi_tinh" name="gioi_tinh">
                                @if($user->gioi_tinh == 'Nam')
                                    <option value="Nam" selected>Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                @elseif($user->gioi_tinh == 'Nữ')
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ" selected>Nữ</option>
                                    <option value="Khác">Khác</option>
                                @elseif($user->gioi_tinh == 'Khác')
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác" selected>Khác</option>
                                @else
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="dia_chi" name="dia_chi" placeholder="Nhập địa chỉ"
                            value="{{$user->dia_chi}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại"
                            value="{{$user->so_dien_thoai}}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                            value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Mã BHXH</label>
                            <input type="text" class="form-control" id="ma_bhxh" name="ma_bhxh" placeholder="Nhập mã bhxh"
                            value="{{$user->ma_bhxh}}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Ngày cấp</label>
                            <input type="date" class="form-control" id="ngay_cap" name="ngay_cap"
                            value="{{$user->ngay_cap}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Ngày hết hạn</label>
                            <input type="date" class="form-control" id="ngay_het_han" name="ngay_het_han"
                            value="{{$user->ngay_het_han}}">
                        </div>
                    </div>
                    @if($thongTinChoCapNhat!==null && $thongTinChoCapNhat->trang_thai == '1')
                        <span class="btn btn-danger">Đang chờ duyệt</span>
                    @else
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @if($thongTinChoCapNhat != null && $thongTinChoCapNhat->trang_thai == '1')
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Thông tin chờ xác nhận</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="row">
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
            </div>
        </div>
    </div>
    @endif
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Cập nhật mật khẩu</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_doi_mat_khau')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-6">
                        <label class="form-label">Mật khẩu cũ</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu cũ" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nhập mật mới" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" id="enter_new_pass" name="enter_new_pass" placeholder="Nhập lại mật khẩu mới" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection