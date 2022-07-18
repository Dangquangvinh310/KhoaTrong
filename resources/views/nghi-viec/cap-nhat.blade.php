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
            <h5 class="card-header">Cập nhật nghĩ việc</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_cap_nhat_nghi_viec',['id' => $nghiViec->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                            <label class="form-label" for="ten">Tên nhân viên<span class="required"> *</span></label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{$nghiViec->user->ho_ten}}" readonly>
                        </div>
                        <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                            <label class="form-label" for="ten">Ngày Nghĩ việc<span class="required"> *</span></label>
                            <input type="date" class="form-control" id="ngay_nghi" name="ngay_nghi"
                            required value="{{$nghiViec->ngay_nghi}}">
                        </div>
                      
                        <div class="col-6">
                            <label class="form-label">Chọn đơn xin nghỉ</label>
                            <input type="file" class="form-control" id="don_xin_nghi" name="don_xin_nghi" >
                        </div>
                        <div class="col-6">
                            <label class="form-label">Lý do</label>
                            <input type="text" class="form-control" id="ly_do" name="ly_do" value="{{$nghiViec->ly_do}}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection