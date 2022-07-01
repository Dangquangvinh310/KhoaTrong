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
    <div class="col-12 mb-3">
        <a href="{{route('them_moi_hop_dong')}}" class="btn btn-primary" >Thêm mới</a>
    </div>
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Danh sách hợp đồng</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nhân viên</th>
                    <th scope="col">Ngày kí hợp đồng</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Lương</th>
                    <th scope="col">Chức năng</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($hopDongs as $hopDong)
                <tr>
                    <?php
                        $key =-1;
                        foreach($hopDong->hopDong as $num)
                        {
                            $key++;
                        }
                    ?>
                    <td>{{ $hopDong->ho_ten}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_ki_hop_dong}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_bat_dau}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_ket_thuc}}</td>
                    <td>{{ $hopDong->hopDong[$key]->noi_dung}}</td>
                    <td>{{ $hopDong->hopDong[$key]->luong}}</td>
                    <td>
                        <a href="{{route('cap_nhat_hop_dong',['id' => $hopDong->hopDong[$key]->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('xoa_hop_dong',['id' => $hopDong->hopDong[$key]->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">Không có dữ liệu</td>
                </tr>
                <?php
                    $key++;
                    ?>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection