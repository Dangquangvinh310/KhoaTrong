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
                            <select class="form-select" name="ly_do"  id="ly_do" required onchange="myFunction()">
                                <option value="Đi trễ">Đi trễ</option>
                                <option value="Không hoàn thành chỉ tiêu ngày">Không hoàn thành chỉ tiêu ngày</option>
                                <option value="Không hoàn thành chỉ tiêu tháng">Không hoàn thành chỉ tiêu tháng</option>
                                <option value="Không tắt điện">Không tắt điện</option>
                                <option value="Vệ sinh nơi làm không sạch sẽ">Vệ sinh nơi làm không sạch sẽ</option>
                                <option value="Không mặc đồng phục">Không mặc đồng phục</option>
                                <option value="Tự ý nghỉ việc">Tự ý nghỉ việc</option>
                            </select>
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
<script>
function myFunction() {
  var x = document.getElementById("ly_do").value;
  if(x== 'Đi trễ')
  {
    document.getElementById("so_tien").value = "100000";
  }
  if(x== 'Không hoàn thành chỉ tiêu ngày')
  {
    document.getElementById("so_tien").value = "100000";
  }
  if(x== 'Không hoàn thành chỉ tiêu tháng')
  {
    document.getElementById("so_tien").value = "300000";
  }
  if(x== 'Không tắt điện')
  {
    document.getElementById("so_tien").value = "100000";
  }
  if(x== 'Vệ sinh nơi làm không sạch sẽ')
  {
    document.getElementById("so_tien").value = "50000";
  }
  if(x== 'Không mặc đồng phục')
  {
    document.getElementById("so_tien").value = "200000";
  }
  if(x== 'Tự ý nghỉ việc')
  {
    document.getElementById("so_tien").value = "300000";
  }
}
</script>
<script>
window.onload = function() {
    var x = document.getElementById("ly_do").value;
  if(x== 'Đi trễ')
  {
    document.getElementById("so_tien").value = "100000";
  }
  if(x== 'Không hoàn thành chỉ tiêu ngày')
  {
    document.getElementById("so_tien").value = "100000";
  }
  if(x== 'Không hoàn thành chỉ tiêu tháng')
  {
    document.getElementById("so_tien").value = "300000";
  }
  if(x== 'Không tắt điện')
  {
    document.getElementById("so_tien").value = "100000";
  }
  if(x== 'Vệ sinh nơi làm không sạch sẽ')
  {
    document.getElementById("so_tien").value = "50000";
  }
  if(x== 'Không mặc đồng phục')
  {
    document.getElementById("so_tien").value = "200000";
  }
  if(x== 'Tự ý nghỉ việc')
  {
    document.getElementById("so_tien").value = "300000";
  }
};
</script>
@endsection