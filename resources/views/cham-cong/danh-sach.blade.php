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
        <a href="{{route('them_moi_cham_cong')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách chấm công</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Ngày làm</th>

                  </tr>
                </thead>
                <tbody>
                @forelse($chamCongs as $chamCong)
                <tr>
                    <td>{{ $chamCong->user->ho_ten}}</td>
                    <td>{{ $chamCong->ngay_lam}}</td>
                    <td>
                        @if(Carbon\Carbon::now()->format('m-Y') == Carbon\Carbon::parse($chamCong->ngay_lam)->format('m-Y') )
                        <a href="{{route('cap_nhat_cham_cong',['id' => $chamCong->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('cap_nhat_cham_cong',['id' => $chamCong->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>
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