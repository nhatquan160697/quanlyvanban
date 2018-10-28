

@extends('templates.quanlyvanban.master')
@section('NoiDung')
<script type="text/javascript">
   $(document).ready(function(){
       $("#DonVi").hide();
       $("#Chon").prop('checked',false);
   });
   function NS_Click(){
     $("#DonVi").hide();
     $("#NhanSu").show();
   }
   function DV_Click(){
     $("#NhanSu").hide();
     $("#DonVi").show();
   }
   function TC_Click(){
     $("#NhanSu").hide();
     $("#DonVi").hide();
   }
  
</script>
@php
  $maBieuMau = $id;
  $tenBieuMau = $thongTinBieuMau->TEN_NHOM_BIEU_MAU;
  $donViBanHanh = $thongTinBieuMau->DON_VI_BAN_HANH;
  $ngayBanHanh = $thongTinBieuMau->NGAY_BAN_HANH;
  $trichYeuNoiDung = $thongTinBieuMau->TRICH_YEU_NOI_DUNG;
  $nguoiKyDuyet = $thongTinBieuMau->NGUOI_KY_DUYET;
  $ngayGui = $thongTinBieuMau->NGAY_GUI;
@endphp
<div style="margin: 5%;">
<h2>Chỉnh sửa biểu mẫu</h2>
   <form method="post" action="{{route('quanlyvanban.bieumau.postsuabieumau')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="MaBieuMau" value="{{$maBieuMau}}">
   <div class="form-group">
      <label class="lbl_ThemCongVan">Tên/nhóm biểu mẫu (<font color="red">*</font>) :</label>
      <input type="text" name="TenBieuMau" class="form-control" value="{{$tenBieuMau}}">
      @if($errors->has('TenBieuMau'))
         <b><font color="red">{{$errors->first('TenBieuMau')}}!</font></b>
      @endif
   </div>
      <div class="form-group">
      <label class="lbl_ThemCongVan">Đơn vị ban hành :</label>
      <select name="DonViBanHanh" class="form-control" selected="{{$donViBanHanh}}">
        @foreach($dsDonVi as $donVi)
          <option value="{{$donVi->MA_DON_VI}}">{{$donVi->TEN_DON_VI}}</option>
        @endforeach
      </select>
   </div>
   <div class="form-group">
      <label class="lbl_ThemCongVan">Ngày ban hành(<font color="red">*</font>) :</label>
      <input type="date" name="NgayBanHanh" class="form-control" value="{{$ngayBanHanh}}">
      @if($errors->has('NgayBanHanh'))
         <b><font color="red">{{$errors->first('NgayBanHanh')}}!</font></b>
      @endif
   </div>

   <div class="form-group">
      <label class="lbl_ThemCongVan">Trích yếu nội dung(<font color="red">*</font>) :</label>
      <textarea name="TrichYeuNoiDung" class="form-control" size="50x2">
        {{$trichYeuNoiDung}}
      </textarea>
      @if($errors->has('TrichYeuNoiDung'))
         <b><font color="red">{{$errors->first('TrichYeuNoiDung')}}!</font></b>
      @endif
   </div>
   <div class="form-group">
      <label class="lbl_ThemCongVan">Người ký duyệt(<font color="red">*</font>) :</label><br>
      <select name="NguoiKyDuyet" class="form-control" selected="$NguoiKyDuyet">
        @foreach($dsNhanSu as $nhanSu)
          <option value="{{$nhanSu->MA_NHAN_SU}}">{{$nhanSu->HO_VA_TEN}}</option>
        @endforeach
      </select>
   </div>
   <div class="form-group">
      <label class="lbl_ThemCongVan">File đính kèm(<font color="red">*</font>) :</label><br>
      <div class="form-group">

          <table class="table">
    <thead>
      <tr>
        <th>File đính kèm</th>
        <th><center>Xóa</center></th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($dsFile as $file)
      <tr>
        <td>{{$file->FILE_DINH_KEM}}</td>
        <td><input type="checkbox" name="XoaFileDinhKem[]" value="{{$file->FILE_DINH_KEM}}"></td>
      </tr>
            
          @endforeach
    </tbody>
  </table>

      </div>
      <input type="file" name="FileDinhKem[]" multiple="true" class="form-control-file">
      @if($errors->has('FileDinhKem'))
         <b style="float: left;"><font color="red">{{$errors->first('FileDinhKem')}}!</font></b>
      @endif
   </div>
   <input type="submit" name="SuaBieuMau" value="Cập nhật" class="btn btn-primary">
   <a href="{{route('quanlyvanban.bieumau.danhsachbieumau')}}" class="btn btn-default"> Hủy</a>

   </form>

</div>
@endsection

