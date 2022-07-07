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
            <h5 class="card-header">Thêm mới phòng ban</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_them_ngay_nghi')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Tên phòng ban</label>
                            <input type="text" class="form-control" id="ten_phong_ban" name="ten_phong_ban" placeholder="Nhập tên phòng ban" required>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Trưởng phòng</label>
                            <select class="form-select " 
                                id="user_id" name="user_id">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->ho_ten }}</option>
                                @endforeach
                            </select>
                       </div>
                    </div> -->
                    <td><a href="{{url('mau_don_xin_nghi.doc')}}" download>Đơn xin nghỉ mẫu</td>

                    <div class="row">
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Tên nhân viên<span class="required"> *</span></label>
                                    <select class="form-control"
                                            id="user_id" name="user_id">
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->ho_ten }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Ngày bắt đầu<span class="required"> *</span></label>
                                    <input type="date" class="form-control" id="ngay_bat_dau_nghi" name="ngay_bat_dau_nghi"
                                    data-parsley-required-message="Vui lòng nhập ngày bắt đầu"
                                    required>
                                    <div id="error-parley-select-nbd" class="error-date"></div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="margin-bottom:2%">
                                    <label class="form-label" for="ten">Ngày kết thúc<span class="required"> *</span></label>
                                    <input type="date" class="form-control" id="ngay_di_lam_lai" name="ngay_di_lam_lai"
                                    data-parsley-required-message="Vui lòng nhập ngày kết thúc"
                                    required>
                                    <div id="error-parley-select-fd" class="error-date"></div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Chọn đơn xin nghỉ</label>
                                    <input type="file" class="form-control" id="don_xin_nghi" name="don_xin_nghi" required>
                                </div>
                    </div>
                        
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection