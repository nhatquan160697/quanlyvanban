<div class="sidenav">
    <a style="text-decoration: none;border-bottom: 1px solid white; " href="{{route('quanlyvanban.congvan.index')}}">TRANG CHỦ</a>
   <button class="dropdown-btn">VĂN BẢN</button>
   <div class="dropdown-container">
      <a href="{{route('quanlyvanban.congvan.danhsachcongvandendonvi')}}">Văn bản gửi đến đơn vị</a>
      @if(Session::get('quyenTruyCap')==1)
      <a href="">Văn bản đã gửi</a>
      <a href="{{route('quanlyvanban.congvan.taomoicongvan')}}">Tạo mới và lưu văn bản</a>
      @endif
   </div>

   <button class="dropdown-btn">BIỂU MẪU </button>
   <div class="dropdown-container">
      <a href="{{route('quanlyvanban.bieumau.danhsachbieumau')}}">Biểu mẫu</a>
   </div>
   @if(Session::get('quyenTruyCap')==1)
   <button class="dropdown-btn">NHÂN SỰ </button>
   <div class="dropdown-container">
      <a href="{{Route('quanlyvanban.nhansu.nhansudonvi')}}">Nhân sự đơn vị</a>
      <a href="{{url('/FormThemNhanSu')}}">Ủy quyền</a>
   </div>
   @endif
   <button class="dropdown-btn">KẾ HOẠCH  </button>
   <div class="dropdown-container">
      <a href="#">Thời khóa biểu</a>
      <a href="#">Lịch công tác tuần trường</a>
      <a href="#">Lịch công tác cơ sở</a>
   </div>
   <button class="dropdown-btn">HỘP THƯ CÁ NHÂN </button>
   <div class="dropdown-container">
      <a href="{{route('quanlyvanban.congvan.danhsachcongvandennhansu')}}">Hộp thư đến</a>
      <a href="{{route('quanlyvanban.congvan.danhsachcongvandinhansu')}}">Thư đã gửi</a>
   </div>
   <button class="dropdown-btn">THÔNG TIN KHÁC </button>
   <div class="dropdown-container">
      <a href="#">Sổ địa chỉ các đơn vị</a>
      <a href="#">Các ngày lễ, ngày nghỉ trong năm</a>
      <a href="#">Tài sản đơn vị</a>
   </div>
   <button class="dropdown-btn">GỬI TIN NHẮN </button>
   <div class="dropdown-container">
      <a href="{{ route('quanlyvanban.guitinnhan.index') }}">Gửi tin nhắn</a>
      <a href="{{ route('quanlyvanban.guitinnhan.nhantinnhan') }}">Nhận tin nhắn</a>
   </div>
</div>