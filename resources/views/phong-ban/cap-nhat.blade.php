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
                    <div class="col-6 mb-3">
                        <select class="form-select" name="ten_phong_ban" required>
                                @foreach($dsPhongBan as $pb)
                                    @if($pb->id == $phongBan->id)
                                    <option value="{{$pb->ten_phong_ban}}" selected>{{$pb->ten_phong_ban}}</option>
                                    @else
                                    <option value="{{$pb->ten_phong_ban}}">{{$pb->ten_phong_ban}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                       <div class="col-6 mb-3">
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
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection