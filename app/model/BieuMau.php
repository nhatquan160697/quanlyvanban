<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class BieuMau extends Model
{
    public function getAll(){    	
    	return DB::table('bieumau')->select('bieumau.*','TEN_DON_VI','HO_VA_TEN')->join('donvi','donvi.MA_DON_VI','=','bieumau.DON_VI_BAN_HANH')->join('nhansu','nhansu.MA_NHAN_SU','=','bieumau.NGUOI_KY_DUYET')->paginate(4);
    }
    //lấy thông tin biểu mẫu theo mã
    public function getById($id){
        return DB::table('bieumau')->select('NGAY_GUI','TEN_NHOM_BIEU_MAU','DON_VI_BAN_HANH','NGAY_BAN_HANH','TRICH_YEU_NOI_DUNG','NGUOI_KY_DUYET')->where('MA_BIEU_MAU',$id)->first();
    }
    //lấy tất cả file đính kèm còn khả dụng
    public function getExistFile($id){
        return DB::table('bieumau_filedinhkem')->where(['MA_BIEU_MAU'=>$id,'KHA_DUNG'=>1])->get();
    }
    //Thêm mới biểu mẫu
    public function themMoi(array $values){
    	DB::table('bieumau')->insert($values);
    }
    //Đặt lại tình trạng của file là không khả dụng
    public function makeFileUnable($id,array $values){
        DB::table('bieumau_filedinhkem')->where('MA_BIEU_MAU',$id)->whereIn('FILE_DINH_KEM',$values)->update(['KHA_DUNG'=>0]);
    }
    //Thêm mới vào table bieumau_filedinhkem
    public function themFileDinhKem(array $values){
    	DB::table('bieumau_filedinhkem')->insert($values);	
    }

    //sửa biểu mẫu
    public function suaBieuMau($id,array $values){
        DB::table('bieumau')->where('MA_BIEU_MAU',$id)->update($values);
    }

    //xóa biểu mẫu
    public function xoaBieuMau($id){
        DB::table('bieumau')->where('MA_BIEU_MAU',$id)->delete();
        DB::table('bieumau_filedinhkem')->where('MA_BIEU_MAU',$id)->update(['KHA_DUNG'=>0]);
    }
}
