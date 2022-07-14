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
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('../assets/img/icons/unicons/wallet-info.png')}}" alt="chart success" class="rounded">
                    </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Số tin tức</span>
                    <h3 class="card-title mb-2">{{$countTinTuc}}</h3>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('../assets/img/icons/unicons/cc-primary.png')}}" alt="chart success" class="rounded">
                    </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Số nhân viên</span>
                    <h3 class="card-title mb-2">{{$countUser}}</h3>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('../assets/img/icons/unicons/paypal.png')}}" alt="chart success" class="rounded">
                    </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Số phòng ban</span>
                    <h3 class="card-title mb-2">{{$countPhongBan}}</h3>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('../assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
                    </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Số hợp đồng</span>
                    <h3 class="card-title mb-2">{{$countHopDong}}</h3>
                </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->chucVu->ten_chuc_vu != "Nhân viên")
    <div class="col-12 mb-3">
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
                  </tr>
                </thead>
                <tbody>
                @forelse($hopDongs as $hopDong)
                <tr>
                    <?php
                    $key=0;
                    ?>
                    <td>{{ $hopDong->ho_ten}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_ki_hop_dong}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_bat_dau}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_ket_thuc}}</td>
                    <td>{{ $hopDong->hopDong[$key]->noi_dung}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
    @if(auth()->user()->chucVu->ten_chuc_vu == "admin")
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Danh sách chờ duyệt thông tin</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nhân viên</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Xem</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($thongTinChoCapNhats as $thongTinChoCapNhat)
                <tr>
                    <td>{{ $thongTinChoCapNhat->user->ho_ten}}</td>
                    <td>{{ $thongTinChoCapNhat->phongBan->ten_phong_ban}}</td>
                    <td>{{ $thongTinChoCapNhat->chucVu->ten_chuc_vu}}</td>
                    <td>
                        <a href="{{route('thong_tin_cho_duyet',['id' => $thongTinChoCapNhat->id])}}" ><i class="bx bx-bullseye"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
    @endif
    @endif
    @if(auth()->user()->chucVu->ten_chuc_vu == "Nhân viên")
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Thông tin nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="row">
                    <div class="col-6">
                        
                    <label class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="ho_ten" name="ho_ten"placeholder="Nhập họ tên" readonly
                    value="{{auth()->user()->ho_ten}}">
                </div>
                <div class="col-6">
                    <label class="form-label">CMND/CCCD</label>
                    <input type="text" class="form-control" id="cmnd" name="cmnd"placeholder="Nhập CMND/CCCD" readonly
                    value="{{auth()->user()->cmnd}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" readonly
                    value="{{auth()->user()->ngay_sinh}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Giới tính</label>
                    <input type="text" class="form-control" id="gioi_tinh" name="gioi_tinh"placeholder="Nhập giới tính" readonly
                    value="{{auth()->user()->gioi_tinh}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi"placeholder="Nhập địa chỉ" readonly
                    value="{{auth()->user()->dia_chi}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"placeholder="Nhập số điện thoại" readonly
                    value="{{auth()->user()->so_dien_thoai}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email"placeholder="Nhập email" readonly
                    value="{{auth()->user()->email}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Mã BHXH</label>
                    <input type="text" class="form-control" id="ma_bhxh" name="ma_bhxh"placeholder="Nhập mã bhxh" readonly
                    value="{{auth()->user()->ma_bhxh}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Ngày cấp</label>
                    <input type="date" class="form-control" id="ngay_cap" name="ngay_cap" readonly
                    value="{{auth()->user()->ngay_cap}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Ngày hết hạn</label>
                    <input type="date" class="form-control" id="ngay_het_han" name="ngay_het_han" readonly
                    value="{{auth()->user()->ngay_het_han}}"> 
                </div>
                <div class="col-6">
                    <label class="form-label">Chức vụ</label>
                    <input type="text" class="form-control" id="chuc_vu_id" name="chuc_vu_id" readonly
                    value="{{auth()->user()->chucVu->ten_chuc_vu}}"> 
                </div>
                <div class="col-6">
                    <label class="form-label">Phòng ban</label>
                    <input type="text" class="form-control" id="phong_ban_id" name="phong_ban_id" readonly
                    value="{{auth()->user()->phongBan->ten_phong_ban}}"> 
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Hợp đồng của nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nhân viên</th>
                    <th scope="col">Ngày kí hợp đồng</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Nội dung</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($hopDongs as $hopDong)
                <tr>
                    <?php
                    $key=0;
                    ?>
                    <td>{{ $hopDong->ho_ten}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_ki_hop_dong}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_bat_dau}}</td>
                    <td>{{ $hopDong->hopDong[$key]->ngay_ket_thuc}}</td>
                    <td>{{ $hopDong->hopDong[$key]->noi_dung}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Thông tin phòng ban của nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tên phòng ban</th>
                    <th scope="col">Trưởng phòng</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $phongBan->ten_phong_ban}}</td>
                    @if(($phongBan->user_id != null))
                    <td>{{ $phongBan->user->ho_ten}}</td>
                    @else
                    <td></td>

                    @endif
                </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Danh sách khen thưởng của nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Ngày thưởng</th>
                    <th scope="col">Lý do</th>
                    <th scope="col">Sô tiền</th>

                  </tr>
                </thead>
                <tbody>
                @forelse($khenThuongs as $khenThuong)
                <tr>
                    <td>{{ $khenThuong->user->ho_ten}}</td>
                    <td>{{ $khenThuong->ngay}}</td>
                    <td>{{ $khenThuong->ly_do}}</td>
                    <td>{{ $khenThuong->so_tien}}</td>
                    <td>
                        <a href="{{route('cap_nhat_khen_thuong',['id' => $khenThuong->id])}}" ><i class="bx bx-message-square-add"></i></a>
                        <a href="{{route('xoa_khen_thuong',['id' => $khenThuong->id])}}" class="ms-3"><i class="bx bx-trash"></i></a>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <h5 class="card-header">Danh sách kỹ luật của nhân viên</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Ngày phạt</th>
                    <th scope="col">Lý do</th>
                    <th scope="col">Số tiền</th>

                  </tr>
                </thead>
                <tbody>
                @forelse($kyLuats as $kyLuat)
                <tr>
                    <td>{{ $kyLuat->user->ho_ten}}</td>
                    <td>{{ $kyLuat->ngay}}</td>
                    <td>{{ $kyLuat->ly_do}}</td>
                    <td>{{ $kyLuat->so_tien}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center">Không có dữ liệu</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
        </div>
    </div>
    @endif
    @if(auth()->user()->chucVu->ten_chuc_vu != "admin")
    <div class="col-12 mb-3">
        <div class="card">
            <h3 class="card-header" style="text-align:center">Tin tức mới</h3>
            <div class="card-body demo-vertical-spacing demo-only-element">
                @foreach($tinTucs as $tinTuc)
                <div class="mb-3">
                    <div class="card">
                        <h5 class="card-header" style="background-color:#03c3ec">{{$tinTuc->tieu_de}}</h5>
                        <div class="card-body" style="min-height: 200px">
                        <hr></hr>
                            <blockquote class="blockquote mb-0">
                                <p>
                                {{$tinTuc->noi_dung}}
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection