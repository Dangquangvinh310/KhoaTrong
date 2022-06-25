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
            <h5 class="card-header">Danh sách bảo hiểm của nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Mã BHXH</th>
                    <th scope="col">Ngày cấp</th>
                    <th scope="col">Ngày hết hạn</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->ma_nhan_vien}}</td>
                    <td>{{ $user->ho_ten}}</td>
                    @if($user->ma_bhxh == null)
                        <td>Chưa cập nhật</td>
                    @else
                        <td>{{ $user->ma_bhxh}}</td>
                    @endif
                    @if($user->ngay_cap == null)
                        <td>Chưa cập nhật</td>
                    @else
                        <td>{{ $user->ngay_cap}}</td>
                    @endif
                    @if($user->ngay_het_han == null)
                        <td>Chưa cập nhật</td>
                    @else
                        <td>{{ $user->ngay_het_han}}</td>
                    @endif
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