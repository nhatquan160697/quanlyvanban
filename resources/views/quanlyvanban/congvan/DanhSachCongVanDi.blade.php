

@extends('templates.quanlyvanban.master')
@section('NoiDung')
<h2>Danh sách công văn đi</h2>
@foreach($dsCongVanDi as $congVan)
<p style='text-align: left;''>
   Số ký hiệu văn bản: {{$congVan->SO_CONG_VAN}} - {{$congVan->TEN_DON_VI}}<br>
   Về việc: {{$congVan->TRICH_YEU_NOI_DUNG}}  - <i>{{$congVan->NGAY_BAN_HANH}}</i>.
   <a href="" title="Đơn vị đã xem" style="float: right;margin-right: 5%;" class="fa fa-users" ></a> <br>
   <a href='{{route('quanlyvanban.congvan.phanhoicongvan',['soCongVan'=>$congVan->SO_CONG_VAN])}}' style='color: red;'>Phản hồi văn bản.</a><br>
   File đính kèm:
   @foreach($dsFile[$congVan->SO_CONG_VAN] as $file)
   <a href='{{url("file/$file->FILE_DINH_KEM")}}' download>{{$file->FILE_DINH_KEM}}</a>
   @endforeach
<hr>
</p>
@endforeach
{{$dsCongVanDi->links()}}
<div id="timkiemtheo" class="TimKiem" style="margin-top: 3%;">
   <form action="{{route('quanlyvanban.congvan.danhsachcongvandi')}}">
      {{csrf_field()}}
      <strong>Tìm kiếm theo</strong>
      <select name="LoaiTimKiem">
         <option value="1">Số ký hiệu văn bản</option>
         <option value="2">Trích yếu nội dung</option>
      </select>
      <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
      <input type="submit" name="TimKiemVanBanDi" value="Tìm">
   </form>
   <a href="{{ route('quanlyvanban.congvan.danhsachcongvandi') }}">Hủy tìm</a> | <a href="{{route('quanlyvanban.congvan.danhsachcongvanden.timkiemnangcao')}}"> Tìm kiếm năng cao</a>
</div>
@endsection

