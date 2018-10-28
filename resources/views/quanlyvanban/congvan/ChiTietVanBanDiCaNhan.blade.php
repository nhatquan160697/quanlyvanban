@extends('templates.quanlyvanban.master')
@section('NoiDung')
<div style="margin: 3%;">
<style type="text/css">
   .AnhDaiDien{
      width: 180px;
      height: 240px;
      
   }
   .ThongTinNhanSu{
      width: 520px;
      float: left;
      text-align: left;
   }
</style>
<a style="float: left;" href="{{route('quanlyvanban.congvan.danhsachcongvandinhansu')}}"><span class="glyphicon glyphicon-arrow-left"></span> Quay về</a>
   <h2>Chi tiết văn bản</h2><br>
   <div class="ThongTinNhanSu">
      <p style="margin-left: 10%;">
        @php
            $capDoQuanTrong = $thongTinCongVan->CAP_DO_QUAN_TRONG == 1 ? 'Khẩn' : 'bình thường';
            $trangThaiXem = $thongTinCongVan->DA_XEM == 1 ? 'Đã xem' : 'Chưa xem';
        @endphp
         <label>Số công văn:</label> {{$thongTinCongVan->SO_CONG_VAN}} <br>
         <label>Loại văn bản:</label> {{$thongTinCongVan->TEN_L_NVANBAN}} <br>
         <label>Ngày ban hành:</label> {{$thongTinCongVan->NGAY_BAN_HANH}} <br>
         <label>Ngày gửi:</label> {{$thongTinCongVan->NGAY_GUI}} <br>
         <label>Cấp độ quan trọng:</label> {{$capDoQuanTrong}} <br>
         <label>Về việc:</label> {{$thongTinCongVan->TRICH_YEU_NOI_DUNG}} <br>
         <label>Người ký duyệt:</label> {{$thongTinCongVan->HO_VA_TEN}} <br>
         <label>Trạng thái xem:</label> {{$trangThaiXem}}
      </p>  
   </div><br>
   <div>
      <table class="table table-hover">
         <thead>
            <th>File đính kèm</th>
         </thead>
         <tbody>
            @if(count($dsFile) <= 0)
                <tr>
                    <td>Không có file đính kèm.</td>
                </tr>
            @else
            @foreach($dsFile as $file)
            @php
                $tenFile = $file->FILE_DINH_KEM;
            @endphp
            <tr>
               <td>{{$tenFile}}</td>
               <td><a href='{{url("file/$tenFile")}}' download>Click để tải về</a></td>
            </tr>
            @endforeach
            @endif
         </tbody>
      </table>
   </div>
   </div>
@endsection
