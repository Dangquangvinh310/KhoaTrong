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
            <h5 class="card-header">Thêm mới khen thưởng hoặc kỷ luật</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_them_khenthuong_kyluat')}}" method="post" enctype="multipart/form-data">
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
                            <label class="form-label">Khen thưởng hoặc kỷ luật</label>
                            <select class="form-select " 
                                id="khenthuong_kyluat" name="khenthuong_kyluat">
cz                                @endforeach
                            </select>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Lý do</label>
                            <input type="text" class="form-control" id="ly_do" name="ly_do" placeholder="Nhập nội dung">
                       </div>
                    <div class="row mb-3">

                       
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection