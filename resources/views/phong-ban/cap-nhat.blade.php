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
                <form class="forms-sample" action="{{route('xl_cap_nhat_phong_ban',['id' => $phongBan->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Tên phòng ban</label>
                            <input type="text" class="form-control" id="ten_phong_ban" name="ten_phong_ban" placeholder="Nhập tên phòng ban" required
                            value="{{$phongBan->ten_phong_ban}}">
                       </div>
                       <div class="col-6">
                            <label class="form-label">Trưởng phòng</label>
                            <select class="form-select " 
                                id="user_id" name="user_id">
                                <option></option>
                                @foreach($users as $user)
                                    @if($user->id==$phongBan->user_id)
                                        <option value="{{ $user->id}} " selected>{{ $user->ho_ten }}</option>
                                    @else
                                        <option value="{{ $user->id}}">{{ $user->ho_ten }}</option>
                                    @endif
                                @endforeach

                            </select>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection