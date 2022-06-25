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
            <h5 class="card-header">Cập nhật chức vụ</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_cap_nhat_chuc_vu',['id' => $chucVu->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Tên chức vụ</label>
                            <input type="text" class="form-control" id="ten_chuc_vu" name="ten_chuc_vu" placeholder="Nhập tên chức vụ" required
                            value="{{$chucVu->ten_chuc_vu}}">
                       </div>
                       <div class="col-6">
                            <label class="form-label">Lương tháng</label>
                            <input type="number" class="form-control" id="luong" name="luong" placeholder="Nhập lương mỗi tháng" required
                            value="{{$chucVu->luong}}">
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection