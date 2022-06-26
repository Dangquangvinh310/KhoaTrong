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
            <h5 class="card-header">Danh sách hợp đồng mới</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nhân viên</th>
                    <th scope="col">Ngày kí hợp đồng</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Nội dung</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($hopDongs as $hopDong)
                <tr>
                    <td>{{ $hopDong->user->ho_ten}}</td>
                    <td>{{ $hopDong->ngay_ki_hop_dong}}</td>
                    <td>{{ $hopDong->ngay_bat_dau}}</td>
                    <td>{{ $hopDong->ngay_ket_thuc}}</td>
                    <td>{{ $hopDong->noi_dung}}</td>
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