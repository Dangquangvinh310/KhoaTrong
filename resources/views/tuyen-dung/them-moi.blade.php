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
        <div class="card mb-4">
        <h5 class="card-header">Basic</h5>
        <div class="card-body">
            <form class="forms-sample mb-3" action="{{route('xl_them_tuyen_dung')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Nhân viên tuyển dụng</label>
                        <select class="form-select " 
                            id="user_id" name="user_id">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->ho_ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Họ tên người được tuyển</label>
                        <input type="text" class="form-control" placeholder="Nhập họ tên" id="ho_ten" name="ho_ten" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Chọn CV</label>
                        <input type="file" class="form-control" id="cv" name="cv" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Ngày tuyển dụng</label>
                        <input type="date" class="form-control" id="ngay_tuyen" name="ngay_tuyen"  required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection