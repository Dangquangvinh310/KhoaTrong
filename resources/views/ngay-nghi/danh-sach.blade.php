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
        <a href="{{route('them_moi_ngay_nghi')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách đơn xin nghỉ/<a href="{{route('danh_sach_ngay_nghi_cho_duyet')}}">Danh sách đơn xin nghỉ chờ duyệt</a></h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Ngày bắt đầu nghỉ</th>
                    <th scope="col">Ngày đi làm lại</th>
                    <th scope="col">Lý do</th>
                    <th scope="col">Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($ngayNghis as $ngayNghi)
                <tr>
                    <td>{{ $ngayNghi->user->ho_ten}}</td>
                    <td>{{ $ngayNghi->ngay_bat_dau_nghi}}</td>
                    <td>{{ $ngayNghi->ngay_di_lam_lai}}</td>
                    <td>{{ $ngayNghi->ly_do}}</td>
                    <td>{{ $ngayNghi->trang_thai}}</td>

                    <td>
                        <a href="{{route('cap_nhat_ngay_nghi',['id' => $ngayNghi->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('xoa_ngay_nghi',['id' => $ngayNghi->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>
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