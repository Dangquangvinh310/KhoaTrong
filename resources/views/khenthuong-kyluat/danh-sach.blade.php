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
        <a href="{{route('them_moi_khenthuong_kyluat')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách hợp đồng</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nhân viên</th>
                    <th scope="col">Ngày kí hợp đồng</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($khenThuongKyLuats as $khenThuongKyLuat)
                <tr>
                    <?php
                    $key=0;
                    ?>
                    <td>{{ $khenThuongKyLuat->ho_ten}}</td>
                    <!-- <td>{{ $khenThuongKyLuat->khenThuongKyLuat[$key]->ngay_ki_hop_dong}}</td>
                    <td>{{ $khenThuongKyLuat->khenThuongKyLuat[$key]->ngay_bat_dau}}</td>
                    <td>{{ $khenThuongKyLuat->khenThuongKyLuat[$key]->ngay_ket_thuc}}</td>
                    <td>{{ $khenThuongKyLuat->khenThuongKyLuat[$key]->noi_dung}}</td> -->
                    <td>
                        <a href="{{route('cap_nhat_hop_dong',['id' => $khenThuongKyLuat->khenThuongKyLuat[$key]->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('xoa_hop_dong',['id' => $khenThuongKyLuat->khenThuongKyLuat[$key]->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>
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