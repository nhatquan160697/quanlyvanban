
@extends('templates.quanlyvanban.master')
@section('NoiDung')
<div style="margin: 5%;">
<h2>Danh sách công văn đi</h2>
@foreach($dsCongVanDi as $congVan)
@php
   $soCongVan = $congVan->SO_CONG_VAN;
   $trichYeuNoiDung = $congVan->TRICH_YEU_NOI_DUNG;
   $ngayGui = $congVan->NGAY_GUI;
   $maNhanSu = $congVan->MA_NHAN_SU;
@endphp
<p style='text-align: left;''>
   Số ký hiệu văn bản: {{$soCongVan}}<br>
   Về việc: {{$trichYeuNoiDung}}  - <i>{{$ngayGui}}</i>.
   <a href="{{route('quanlyvanban.congvan.chitietcongvandinhansu',['soCongVan'=>$soCongVan,'maNhanSu'=>$maNhanSu])}}" style="float: right;margin-right: 5%;">Chi tiết</a><a href="" style="float: right;margin-right: 1%;">Sửa</a><a href="" style="float: right;margin-right: 1%;" data-toggle="modal" data-target="#XoaCongVan" onclick="xoaCongVan('{{$soCongVan}}','{{$maNhanSu}}')">Xóa</a> <br>
   <a href='{{route('quanlyvanban.congvan.phanhoicongvan',['soCongVan'=>$soCongVan])}}' style='color: red;'>Phản hồi văn bản.</a><br>
   File đính kèm:
   @foreach($dsFile[$soCongVan] as $file)
   <a href='{{url("file/$file->FILE_DINH_KEM")}}' download>{{$file->FILE_DINH_KEM}}</a>
   @endforeach
<hr>
</p>
@endforeach
{{$dsCongVanDi->links()}}
<div id="timkiemtheo" class="TimKiem" style="margin-top: 3%;">
   <form action="{{route('quanlyvanban.congvan.xoacongvandinhansu')}}" method="post">
      {{csrf_field()}}
      <strong>Tìm kiếm theo</strong>
      <select name="LoaiTimKiem">
         <option value="1">Số ký hiệu văn bản</option>
         <option value="2">Trích yếu nội dung</option>
      </select>
      <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
      <input type="submit" name="TimKiemVanBanDi" value="Tìm">
   </form>
   <a href="">Hủy tìm</a> | <a href="{{route('quanlyvanban.congvan.danhsachcongvanden.timkiemnangcao')}}"> Tìm kiếm năng cao</a>
</div>
</div>
<script type="text/javascript">
    function xoaCongVan($soCongVan, $maNhanSu){
        $('#SoCongVan').val($soCongVan);
        $('#MaNhanSu').val($maNhanSu);
    }
</script>
<div id="XoaCongVan" class="modal fade" role="dialog">
   <div class="modal-dialog">
        </p>
      <form method="post" action="{{route('quanlyvanban.congvan.xoacongvandinhansu')}}">
        {{csrf_field()}}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Xóa công văn</h4>
            </div>
            <div class="modal-body">
                  <input type="hidden" class="form-control" id="SoCongVan" name="SoCongVan"/>
                  <input type="hidden" class="form-control" id="MaNhanSu" name="MaNhanSu"/>
                  <label>Bạn có chắc chắn muốn xóa công văn này?</label><br>
                  <small>Lưu ý: tác vụ sẽ không thể được hoàn tác, bạn có thể chỉnh sửa thông tin nếu cần thay đổi gì đó.</small>  
            </div>
            <div class="modal-footer">
               <input type="submit" name="submit" value="Xóa" class="btn btn-primary">
               <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection

