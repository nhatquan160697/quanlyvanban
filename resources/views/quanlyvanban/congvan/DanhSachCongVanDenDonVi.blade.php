

@extends('templates.quanlyvanban.master')
@section('NoiDung')
<link rel="stylesheet" href="{{url('css/chosen.min.css')}}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="{{url('js/choosen.jquery.min.js')}}"></script>
<script type="text/javascript">
  var data = new Object();
   $(document).ready(function(){
       $("#DonVi").hide();
       $("#Chon").prop('checked',false);
       $(".livesearch").chosen(); 
   });
</script>
<style type="text/css">
.form-group {
  text-align: left;
  position: relative;
}
.form-control {
  position: absolute;
width:40%;
left: 50%;

top: 0%;
}
.chosen-container .chosen-container-multi .chosen-with-drop .chosen-container-active{
  width: 300px;
}
.chosen-container .chosen-container-multi{
  width: 300px;
}
</style>
<h2>Công văn gửi đến cho đơn vị</h2>
<div style="margin: 3%;">
   @foreach($dsCongVan as $congVan)
   <p style='text-align: left;'>
      Số ký hiệu văn bản: {{$congVan->SO_CONG_VAN}} - {{$congVan->TEN_DON_VI}} @php 
          echo $congVan->CAP_DO_QUAN_TRONG=='0'?"<i><font color='red'>Khẩn</font></i>":''; 
       @endphp<br>
      Về việc: {{$congVan->TRICH_YEU_NOI_DUNG}}  - <i>{{$congVan->NGAY_BAN_HANH}}</i>.<a href='{{route('quanlyvanban.congvan.phanhoicongvan',['soCongVan'=>$congVan->SO_CONG_VAN])}}' style='color: red;'>Phản hồi văn bản</a> hoặc chuyển tiếp đến <a href="" onclick="chuyenTiepDonVi('{{$congVan->SO_CONG_VAN}}');" data-toggle="modal" data-target="#ChuyenDonVi">Đơn vị</a> | <a href="" onclick="chuyenTiepCaNhan('{{$congVan->SO_CONG_VAN}}');" data-toggle="modal" data-target="#ChuyenCaNhan">Cá nhân</a><br>
      File đính kèm:
      @foreach($dsFile[$congVan->SO_CONG_VAN] as $file)
      <a href='{{url("file/$file->FILE_DINH_KEM")}}' download>{{$file->FILE_DINH_KEM}}</a>
      @endforeach
   <hr>
   </p>
   @endforeach
   {{$dsCongVan->links()}}
   <div id="timkiemtheo" class="TimKiem" style="margin-top: 3%;">
      <form action="{{route('quanlyvanban.congvan.danhsachcongvanden')}}">
         {{csrf_field()}}
         <strong>Tìm kiếm theo</strong>
         <select name="LoaiTimKiem" id="LoaiTimKiem" onchange="timKiem();">
            <option value="1">Số ký hiệu văn bản</option>
            <option value="2">Trích yếu nội dung</option>
            <option value="3">Đơn vị ban hành</option>
         </select>
         <input type="text" name="keyword" id="KeyWord" placeholder="Nhập từ khóa tìm kiếm">
         <select name="DSDonVi" id="DSDonVi" style="display: none;">
            @foreach($dsDonVi as $donVi)
            <option value="{{$donVi->MA_DON_VI}}">{{$donVi->TEN_DON_VI}}</option>
            @endforeach
         </select>
         <input type="submit" name="TimKiemVanBanDen" value="Tìm">
      </form>
      <a href="{{ route('quanlyvanban.congvan.danhsachcongvanden') }}">Hủy tìm</a> | <a href="{{route('quanlyvanban.congvan.danhsachcongvanden.timkiemnangcao')}}"> Tìm kiếm năng cao</a>
   </div>
</div>
<script type="text/javascript">
   function timKiem(){
       var keyword = $("#LoaiTimKiem").val();
       if(keyword==3){
         $('#KeyWord').css('display','none');
         $('#DSDonVi').css('display','inline');
       }
       else{
         $('#KeyWord').css('display','inline');
         $('#DSDonVi').css('display','none');   
       }
   }
</script>
<script type="text/javascript">
  $(".livesearch").chosen();
   var _gaq = _gaq || [];
   _gaq.push(['_setAccount', 'UA-36251023-1']);
   _gaq.push(['_setDomainName', 'jqueryscript.net']);
   _gaq.push(['_trackPageview']);
  
   (function() {
     var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
     ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
   })();
</script>
<!--Form chuyen tiep-->
<!--Modal chuyển tiếp -->
<div id="ChuyenCaNhan" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form method="post" action="{{route('quanlyvanban.congvan.chuyentiep.canhan')}}">
        {{csrf_field()}}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Chuyển tiếp văn bản</h4>
            </div>
            <div class="modal-body">
               
                  <input type="hidden" class="form-control" id="SoVanBanc" name="SoVanBan" size="30" />
                  <label>Tên người nhận</label>:
                  <select class="livesearch" name="ChuyenTiepCaNhan[]" multiple="" >
                    @foreach($dsNhanSu as $nhanSu )
                    <option value="{{$nhanSu->MA_NHAN_SU}}">{{$nhanSu->HO_VA_TEN}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="modal-footer">
               <input type="submit" name="submit" value="Chuyển tiếp" class="btn btn-primary">
               <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
         </div>
      </form>
   </div>
</div>
<!--Form chuyen tiep cho don vi-->
<div id="ChuyenDonVi" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form method="post" action="{{route('quanlyvanban.congvan.chuyentiep.donvi')}}">
        {{csrf_field()}}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Chuyển tiếp văn bản</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <input type="hidden" class="form-control" id="SoVanBand" name="SoVanBan" size="30" />
                  
                  <label>Các đơn vị nhận</label>:
                  <select class="livesearch" name="ChuyenTiepDonVi[]" multiple="" >
                    @foreach($dsDonVi as $donVi)
                    <option value="{{$donVi->MA_DON_VI}}">{{$donVi->TEN_DON_VI}}</option>
                    @endforeach
                  </select>
                  <br>

                  <select name="LoaiGui" class="form-control">
                    <option value="1">Trưởng đơn vị</option>
                    <option value="2">Phó đơn vị</option>
                    <option value="3">Tất cả thành viên</option>
                  </select>

                  </div>
            </div>
            <div class="modal-footer">
               <input type="submit" name="submit" value="Chuyển tiếp" class="btn btn-primary">
               <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
         </div>
      </form>
   </div>
</div>
<script type="text/javascript">
  function chuyenTiepCaNhan($id){
    $('#SoVanBanc').val($id);
  }
  function chuyenTiepDonVi($id){
    $('#SoVanBand').val($id);
  }
</script>
@endsection

