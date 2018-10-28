@extends('templates.quanlyvanban.master')
@section('NoiDung')
<link rel="stylesheet" href="{{url('css/chosen.min.css')}}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="{{url('js/choosen.jquery.min.js')}}"></script>
<style type="text/css">
   label{
      float: left;
   }
</style>
<script type="text/javascript">
  var data = new Object();
   $(document).ready(function(){
       $(".livesearch").chosen(); 
   });
</script>
<div style="margin: 3%;">
   <h3>Chỉnh sửa thông tin văn bản</h3>
   <form method="post" action="">
      {{csrf_field()}}
      <div class="form-group">
         <label>Số công văn:</label>
         <input type="text" name="SoCongVan" class="form-control">
      </div>
      <div class="form-group">
         <label>Loại văn bản:</label>
         <select name="LoaiVanBan" class="form-control">
         </select>
      </div>
      <div class="form-group">
         <label>Ngày ban hành:</label>
         <input type="date" name="NgayBanHanh" class="form-control">
      </div>
      <div class="form-group">
         <label>Cấp độ quan trọng:</label>
         <select name="CapDoQuanTrong" class="form-control">
            <option value="1">Khẩn</option>
            <option value="0">Bình thường</option>
         </select>
      </div>
      <div class="form-group">
         <label>Trích yếu nội dung:</label>
         <textarea name="TrichYeuNoiDung" class="form-control">
         </textarea>
      </div>
      <div class="form-group">
         <label>Người ký duyệt:</label>
         <select name="NguoiKyDuyet" class="form-control">
            <option value="1">Khẩn</option>
            <option value="0">Bình thường</option>
         </select>
      </div>
      <div class="form-group">
        <label>File đính kèm: </label>
        <input type="file" name="FileDinhKem" >
     </div>
      <label>Danh sách file đã đính kèm trước đó:</label>            
      <table class="table table-striped">
       <thead>
         <tr>
           <th>Tên file</th>
           <th>Chọn để xóa file</th>
         </tr>
       </thead>
       <tbody>
         <tr>
           <td>Tên file . đuôi</td>
           <td><input type="checkbox" name="XoaFile[]"></td>
         </tr>
         <tr>
           <td>Mary</td>
           <td><input type="checkbox" name="XoaFile[]"></td>
         </tr>
       </tbody>
      </table>
     <button class="btn btn-default">Thoát</button>
     <input class="btn btn-primary" type="submit" name="submit" value="Lưu và thoát">
   </form>
</div>
@endsection
