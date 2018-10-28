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
<a style="float: left;" href=""><span class="glyphicon glyphicon-arrow-left"></span> Quay về</a>
   <h2>Chi tiết văn bản</h2><br>
   <div class="ThongTinNhanSu">
      <p style="margin-left: 10%;">
         <label>Số công văn:</label> <br>
         <label>Loại văn bản:</label>  <br>
         <label>Ngày ban hành:</label>  <br>
         <label>Don vị ban hành:</label>  <br>
         <label>Tình trạng:</label>  <br>
         <label>Về việc:</label>  <br>
         <label>Người ký duyệt:</label> 
      </p>  
   </div><br>
   <div>
      <table class="table table-hover">
         <thead>
            <th>File đính kèm</th>
         </thead>
         <tbody>
            <tr>
               <td>Tên file. đuôi</td>
               <td><a href="">Click để tải về</a></td>
            </tr>
         </tbody>
      </table>
   </div>
   </div>
@endsection
