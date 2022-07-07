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
<style>
    input[type="search"] {
  padding-right: 1.5em;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none" stroke="black" stroke-width="2"><circle cx="7" cy="7" r="6" /><path d="M11 11 L15 15" /></svg>');
  background-size: 0.7em;
  background-repeat: no-repeat;
  background-position: right 0.5em center;
}

input[type="search"]::-webkit-search-cancel-button {
  display: none;
}

/**
 * Unrelated Styles
 */


form {
 width: 100%;
}

input,
select {
  width: 100%;
  border: 1px solid currentColor;
  border-radius: 3px;
  padding-top: .25rem;
  padding-bottom: .25rem;
  background-color: transparent;
}
.div-search{
    width: 100%;
    padding-right: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.btn-search{
    color: #fff;
    background-color: #696cff;
    border-color: #696cff;
    /* box-shadow: 0 0.125rem 0.25rem 0 rgb(105 108 255 / 40%); */
    border: none;
    height: 100%;
    padding: 5px 15px;
    border-radius: 5px ;
    white-space: nowrap !important;
    margin-left: 10px;
}
    </style>
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{route('them_moi_nhan_vien')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    
    <div class="col-12">
        <div class="card">
            
            <div class="row d-flex justify-content-center align-items-center">
            <div class="col-4">
            <h4 class="card-header" style="white-space:nowrap">Danh sách nhân viên</h4>
            </div>
            <div class="col-8">
            <form action="{{route('xl_tim_kiem_nhan_vien')}}" method="POST">
                @csrf
                <label for="search" class="div-search">
                  
                    <input type="search" id="search" name="search">
                    <button class="btn-search">Tìm kiếm</button>
                </label>

                </form>
            </div>
       
            
                </div>

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
                    @if($user->phongBan != null)
                    
                    <td>{{ $user->phongBan->ten_phong_ban}}</td>
                    @else
                    <td></td>
                    @endif
                    <td>
                        <a href="{{route('cap_nhat_nhan_vien',['id' => $user->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('xoa_nhan_vien',['id' => $user->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection