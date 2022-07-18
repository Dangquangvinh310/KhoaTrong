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
                            <select class="form-select" name="ten_chuc_vu" required>
                                @foreach($dsChucVu as $cv)
                                    @if($cv->id == $chucVu->id)
                                    <option value="{{$cv->ten_chuc_vu}}" selected>{{$cv->ten_chuc_vu}}</option>
                                    @else
                                    <option value="{{$cv->ten_chuc_vu}}">{{$cv->ten_chuc_vu}}</option>
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