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
        <a href="{{route('them_moi_phong_ban')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách phòng ban</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tên phòng ban</th>
                    <th scope="col">Trưởng phòng</th>
                    <th scope="col">Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($phongBans as $phongBan)
                <tr>
                    <td>{{ $phongBan->ten_phong_ban}}</td>
                    <td>{{ $phongBan->user->ho_ten}}</td>
                    <td>
                        <a href="{{route('cap_nhat_phong_ban',['id' => $phongBan->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('xoa_phong_ban',['id' => $phongBan->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>

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