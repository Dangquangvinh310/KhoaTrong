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
        <a href="{{route('them_moi_tuyen_dung')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách tuyển dụng</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nhân viên tuyển dụng</th>
                    <th scope="col">Họ tên người được tuyển</th>
                    <th scope="col">CV</th>
                    <th scope="col">Ngày tuyển</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($tuyenDungs as $tuyenDung)
                <tr>
                    <td>{{ $tuyenDung->user->ho_ten}}</td>
                    <td>{{ $tuyenDung->ho_ten}}</td>
                    <td><a href="{{url('/fileCV', $tuyenDung->cv)}}" download>CV người được phỏng vấn</td>
                    <td>{{ $tuyenDung->ngay_tuyen}}</td>
                    <td>
                        @if($tuyenDung->trang_thai == "Rớt")
                            <span class="badge bg-warning" style="width:150px">{{$tuyenDung->trang_thai}}</span>
                        @elseif($tuyenDung->trang_thai == "Đậu")
                            <span class="badge bg-info" style="width:150px">{{$tuyenDung->trang_thai}}</span>
                        @else
                            <span class="badge bg-success" style="width:150px">Chưa phỏng vấn</span>
                        @endif
                    </td>
                    <td>
                        @if($tuyenDung->trang_thai == "Rớt")
                            <a class="btn btn-info" href="{{route('tuyen_dung_dau',['id' => $tuyenDung->id])}}">Đậu</a>
                        @elseif($tuyenDung->trang_thai == "Đậu")
                            <span class="badge bg-success">Đã thêm nhân viên này</span>
                        @else
                            <a class="btn btn-danger" href="{{route('tuyen_dung_rot',['id' => $tuyenDung->id])}}">Rớt</a>
                            <a class="btn btn-info" href="{{route('tuyen_dung_dau',['id' => $tuyenDung->id])}}">Đậu</a>
                        @endif
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