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
            <h5 class="card-header">Cập nhật khen thưởng</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form class="forms-sample" action="{{route('xl_cap_nhat_khen_thuong',['id' => $khenThuong->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                    <div class="col-6">
                            <label class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Nhập lý do thưởng" value="{{$khenThuong->user->ho_ten }}" readonly>
                       </div>
                        <div class="col-6">
                            <label class="form-label">Lý do</label>
                            <select class="form-select" name="ly_do" id="ly_do" required onchange="myFunction()">
                                @foreach($dsKhenThuong as $kt)
                                    @if($kt->id == $khenThuong->id)
                                    <option value="{{$kt->ly_do}}" selected>{{$kt->ly_do}}</option>
                                    @else
                                    <option value="{{$kt->ly_do}}">{{$kt->ly_do}}</option>
                                    @endif
                                @endforeach
                            </select>
                       </div>
                       <div class="col-6">
                            <label class="form-label">Số tiền thưởng</label>
                            <input type="text" class="form-control" id="so_tien" name="so_tien" placeholder="Nhập số tiền thưởng" value="{{$khenThuong->so_tien }}" required>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("ly_do").value;
  if(x== 'Hoàn thành chỉ tiêu tuần')
  {
    document.getElementById("so_tien").value = "100000";
  }
  if(x== 'Đi làm đầy đủ')
  {
    document.getElementById("so_tien").value = "300000";
  }
  else
  {
    document.getElementById("so_tien").value = "";
  }
}
</script>
@endsection