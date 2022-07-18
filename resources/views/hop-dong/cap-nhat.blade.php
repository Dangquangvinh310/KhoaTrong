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
            <h5 class="card-header">Cập nhật hợp đồng</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_cap_nhat_hop_dong',['id' => $hopDong->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                       <div class="col-6">
                            <label class="form-label">Nhân viên</label>
                            <select class="form-select " 
                                id="user_id" name="user_id">
                                @foreach($users as $user)
                                    @if($user->id==$hopDong->user_id)
                                        <option value="{{ $user->id}} " selected>{{ $user->ho_ten }}</option>
                                    @else
                                        <option value="{{ $user->id}}">{{ $user->ho_ten }}</option>
                                    @endif
                                @endforeach
                            </select>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Ngày kí hợp đồng</label>
                            <input type="date" class="form-control" id="ngay_ki_hop_dong" name="ngay_ki_hop_dong" required
                            value="{{$hopDong->ngay_ki_hop_dong}}">
                       </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau" required
                            value="{{$hopDong->ngay_bat_dau}}">
                       </div>
                       <div class="col-6">
                            <label class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc"
                            value="{{$hopDong->ngay_ket_thuc}}">
                       </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Nội dung</label>
                            <select class="form-select" name="noi_dung" id="noi_dung" required>
                                @if($hopDong->noi_dung == 'Có thời hạn')
                                <option value="Có thời hạn" selected>Cóthời hạn</option>
                                <option value="Không thời hạn">Không thời hạn</option>
                                @else
                                <option value="Có thời hạn">Có thời hạn</option>
                                <option value="Không thời hạn" selected>Không thời hạn</option>
                                @endif
                                
                            </select>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Lương</label>
                            <input type="number" class="form-control" id="luong" name="luong" placeholder="Nhập lương"
                            value="{{$hopDong->luong}}">
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