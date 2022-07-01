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
            <h5 class="card-header">Thêm mới hợp đồng</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_them_hop_dong')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                       <div class="col-6">
                            <label class="form-label">Nhân viên</label>
                            <select class="form-select " 
                                id="user_id" name="user_id">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->ho_ten }}</option>
                                @endforeach
                            </select>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Ngày kí hợp đồng</label>
                            <input type="date" class="form-control" id="ngay_ki_hop_dong" name="ngay_ki_hop_dong" required>
                       </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau" required>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc" required>
                       </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Nội dung</label>
                            <input type="text" class="form-control" id="noi_dung" name="noi_dung" placeholder="Nhập nội dung">
                       </div>
                       <div class="col-6">
                            <label class="form-label">Lương</label>
                            <input type="number" class="form-control" id="luong" name="luong" placeholder="Nhập lương">
                       </div>
                       <div class="col-6">
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection