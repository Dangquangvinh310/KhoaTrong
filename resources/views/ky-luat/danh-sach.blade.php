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
        <a href="{{route('them_moi_ky_luat')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách kỷ luật</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Ngày phạt</th>
                    <th scope="col">Lý do</th>
                    <th scope="col">Sô tiền</th>

                  </tr>
                </thead>
                <tbody>
                @forelse($kyLuats as $kyLuat)
                <tr>
                    <td>{{ $kyLuat->user->ho_ten}}</td>
                    <td>{{ $kyLuat->ngay}}</td>
                    <td>{{ $kyLuat->ly_do}}</td>
                    <td>{{ $kyLuat->so_tien}}</td>
                    <td>
                        <a href="{{route('cap_nhat_ky_luat',['id' => $kyLuat->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('xoa_ky_luat',['id' => $kyLuat->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>

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