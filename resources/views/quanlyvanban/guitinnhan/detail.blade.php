@extends('templates.quanlyvanban.master')
@section('NoiDung')
<style type="text/css">
.chosen-container .chosen-container-multi .chosen-with-drop .chosen-container-active{
  width: 300px;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script type="text/javascript" src="{{url('js/choosen.jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#FormGuiTinNhan').css('display','none');
        $(".livesearch").chosen(); 
   });
</script>
<div style="margin: 5%;">
   <p>Người gửi: {{ $getTinNhan->NGUOI_GUI }}</p>
   <p>Ngày: {{ $getTinNhan->NGAY_GUI }}</p>
   <p>
      {{ $getTinNhan->NOI_DUNG }}
   </p>
   <button onclick="formGuiTinNhan();">Trả lời</button>
   <button>Chuyển tiếp</button>

   <div id="FormGuiTinNhan">
        <form action="{{Route('quanlyvanban.guitinnhan.index')}}" method="post" enctype="multipart/form-data">
   {{csrf_field()}}
   <div class="form-group">
      <label class="lbl_ThemCongVan">Nội dung tin nhắn(<font color="red">*</font>) :</label>
      <textarea name="NoiDungTinNhan" size="50x2" class="form-control"></textarea>
   </div><br>
   <div class="form-group">
      <label class="lbl_ThemCongVan">File đính kèm(<font color="red">*</font>) :</label>
      <input type="file" name="FileDinhKem[]" multiple="true" class="form-control-file">
   </div>
   <div style="float: left;">
</div>

<div style="margin-top: 5%;">
      <a onclick="dongFormGuiTinNhan();" class="btn btn-default">Hủy</a>
      <input type="submit" class="btn btn-primary" value="Gửi">
</div>
</form>
   </div>
</div>
<script type="text/javascript" src="{{url('js/jquery.validate.min.js')}}" ></script>
<script type="text/javascript">
     $(".livesearch").chosen();
</script>
<script type="text/javascript">
    function formGuiTinNhan(){
        $('#FormGuiTinNhan').css('display','inline');
    }
    function dongFormGuiTinNhan(){
        $('#FormGuiTinNhan').css('display','none');
    }
</script>
@endsection

