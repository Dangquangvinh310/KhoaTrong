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
            <h5 class="card-header">Thêm mới kỷ luật</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_them_ky_luat')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                    <div class="col-6">
                            <label class="form-label">Tên nhân viên</label>
                            <select class="form-select " 
                                id="user_id" name="user_id">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->ho_ten }}</option>
                                @endforeach
                            </select>
                       </div>
                        <div class="col-6">
                            <label class="form-label">Lý do</label>
                            <input type="text" class="form-control" id="ly_do" name="ly_do" placeholder="Nhập lý do kỷ luật" required>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Số tiền thưởng</label>
                            <input type="text" class="form-control" id="so_tien" name="so_tien" placeholder="Nhập số tiền kỷ luật" required>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection