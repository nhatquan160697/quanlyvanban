<div class="sidenav">
            <button class="dropdown-btn">VĂN BẢN</button>
            <div class="dropdown-container">
               <a href="{{route('quanlyvanban.congvan.danhsachcongvanden',['page'=>1])}}">Văn bản đến</a>
               <a href="{{route('quanlyvanban.congvan.danhsachcongvandi',['page'=>1])}}">Văn bản đi</a>
               <a href="{{route('quanlyvanban.congvan.taomoicongvan')}}">Tạo mới và lưu văn bản</a>
            </div>
            
            <button class="dropdown-btn">BIỂU MẪU </button>
            <div class="dropdown-container">
               <a href="{{route('quanlyvanban.bieumau.danhsachbieumau',['page'=>1])}}">Biểu mẫu</a>
            </div>
            <button class="dropdown-btn">NHÂN SỰ </button>
            <div class="dropdown-container">
               <a href="{{url('/DanhSachNhanSu')}}">Danh sách nhân sự</a>
               <a href="{{url('/FormThemNhanSu')}}">Thêm mới nhân sự</a>
               <a href="{{url('/FormThemNhanSu')}}">Tiếp nhận nhân sự</a>
            </div>
            <button class="dropdown-btn">KẾ HOẠCH  </button>
            <div class="dropdown-container">
               <a href="#">Thời khóa biểu</a>
               <a href="#">Lịch công tác tuần trường</a>
               <a href="#">Lịch công tác cơ sở</a>
            </div>
            <button class="dropdown-btn">HỘP THƯ CÁ NHÂN </button>
            <div class="dropdown-container">
               <a href="#">Hộp thư đến</a>
               <a href="#">Thư đã gửi</a>
            </div>
            <button class="dropdown-btn">THÔNG TIN KHÁC </button>
            <div class="dropdown-container">
               <a href="#">Sổ địa chỉ các đơn vị</a>
               <a href="#">Các ngày lễ, ngày nghỉ trong năm</a>
            </div>
         </div>