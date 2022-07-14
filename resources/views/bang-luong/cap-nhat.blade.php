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
            <h5 class="card-header">Cập nhật phòng ban</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_cap_nhat_bang_luong',['id' => $luong->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                                <label class="form-label">Tên nhân viên</label>
                                <input type="text" class="form-control" id="user" name="user" value="{{$luong->user->ho_ten}}" readonly>
                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$luong->user_id}}" readonly>

                        </div>
                        <div class="col-6">
                                <label class="form-label">Tổng số ngày làm trong tháng</label>
                                <input type="text" class="form-control" id="tong_ngay_lam" name="tong_ngay_lam" readonly>
                        </div>
                        <div class="col-6">
                                <label class="form-label">Phụ cấp</label>
                                <input type="text" class="form-control" id="phu_cap" name="phu_cap" placeholder="Nhập phụ cấp" value="{{$luong->phu_cap}}" >
                        </div>
                        <div class="col-6">
                                <label class="form-label">Tạm ứng</label>
                                <input type="text" class="form-control" id="tam_ung" name="tam_ung" value="{{$luong->tam_ung}}" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection