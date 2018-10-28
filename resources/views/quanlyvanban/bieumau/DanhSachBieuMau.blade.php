@extends('templates.quanlyvanban.master')
@section('NoiDung')
	<h2>Danh sách biểu mẫu đã gửi</h2> <a href="{{route('quanlyvanban.bieumau.taomoibieumau')}}"><span class="glyphicon glyphicon glyphicon-plus"></span> Tạo mới biểu mẫu</a><br>
	<div style="margin-left: 5%;margin-top: 3%;">
	@foreach($dsBieuMau as $bieuMau)
    @php
        $maBieuMau = $bieuMau->MA_BIEU_MAU;
        $trichYeuNoiDung = $bieuMau->TRICH_YEU_NOI_DUNG;
    @endphp
		<p style='text-align: left;'>
                        Tên biểu mẫu: {{$bieuMau->TEN_NHOM_BIEU_MAU}} - {{$bieuMau->TEN_DON_VI}} 
                        <br>
                        Về việc: {{str_limit($trichYeuNoiDung,80)}}  - <i>{{$bieuMau->NGAY_BAN_HANH}}</i>. 
                          <a href="" title="xóa biểu mẫu" style="float: right;margin-right: 5%;" class="fa fa-trash" data-toggle="modal" data-target="#XoaBieuMau" onclick="xoaBieuMau('{{$maBieuMau}}')"></a>
                          <a href="{{route('quanlyvanban.bieumau.getsuabieumau',['id'=>$maBieuMau])}}" title="sửa biểu mẫu" style="float: right;margin-right: 5%;" class="fa fa-edit" ></a>
                        <br>
                            File đính kèm:
                            @if(count($dsFile[$maBieuMau])==0)
                              <i>Không có file nào.</i>
                            @else
                            @foreach($dsFile[$maBieuMau] as $file)
                                <a href='{{url("file/$file->FILE_DINH_KEM")}}' download>{{$file->FILE_DINH_KEM}}</a>
                            @endforeach
                            @endif
        </p>
        <hr>
	@endforeach
	{{$dsBieuMau->links()}}
	</div>
<script type="text/javascript">
    function xoaBieuMau($id){
        $('#MaBieuMau').val($id);
    }
</script>
<!--Modal -->
<div id="XoaBieuMau" class="modal fade" role="dialog">
   <div class="modal-dialog">
        </p>
      <form method="post" action="{{route('quanlyvanban.bieumau.xoabieumau')}}">
        {{csrf_field()}}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Xóa biểu mẫu</h4>
            </div>
            <div class="modal-body">
                  <input type="hidden" class="form-control" id="MaBieuMau" name="MaBieuMau" size="30" />
                  <label>Bạn có chắc chắn muốn xóa biểu mẫu này?</label><br>
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