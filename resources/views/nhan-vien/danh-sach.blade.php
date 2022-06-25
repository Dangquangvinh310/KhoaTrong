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
        <a href="{{route('them_moi_nhan_vien')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Họ tên</th>
                    <th scope="col">CMND/CCCD</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Ngày nhận chức</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->ho_ten}}</td>
                    <td>{{ $user->cmnd}}</td>
                    <td>{{ $user->ngay_sinh}}</td>
                    <td>{{ $user->so_dien_thoai}}</td>
                    <td>{{ $user->dia_chi}}</td>
                    <td>{{ $user->chucVu->ten_chuc_vu}}</td>
                    <td>{{ $user->ngay_nhan_chuc}}</td>
                    <td>{{ $user->phongBan->ten_phong_ban}}</td>
                    <td>
                        <a href="{{route('cap_nhat_nhan_vien',['id' => $user->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="" class="ms-3"><i class="bx bx-trash"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection