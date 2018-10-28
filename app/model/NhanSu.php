<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class NhanSu extends Model
{
    public function getAll(){
      return DB::table('nhansu')->get();
    }
    public function getAllExceptMe($maNhanSu){
      return DB::table('nhansu')->where('MA_NHAN_SU','!=',$maNhanSu)->get();
    }
    public function layDanhSachNhanSu(){
    	//return Cat::OrderBy('cat_id','desc')->get(); // lấy giảm dần
   	  return DB::table('nhansu')->distinct()->paginate(3);
    }
    public function getAllByID(Array $ar){
      return DB::table('nhansu')->whereIn('MA_NHAN_SU',$ar)->get();
    }
    public function getByMaDonVi($maDonVi){
      return DB::table('nhansu')->select('nhansu_thuocdonvi.MA_NHAN_SU','HO_VA_TEN','nhansu.SO_DIEN_THOAI','EMAIL')->join('nhansu_thuocdonvi','nhansu.MA_NHAN_SU','=','nhansu_thuocdonvi.MA_NHAN_SU')->where('MA_DON_VI',$maDonVi)->paginate(5);
    }
    public function getDanhSachChucVu($maNhanSu){
      return DB::table('nhansu_thuocdonvi')->select('TU_NGAY','DEN_NGAY','TEN_DON_VI','TEN_CHUC_VU')->join('donvi','donvi.MA_DON_VI','=','nhansu_thuocdonvi.MA_DON_VI')->join('chucvu','chucvu.MA_CHUC_VU','=','nhansu_thuocdonvi.MA_CHUC_VU')->where('nhansu_thuocdonvi.MA_NHAN_SU',$maNhanSu)->get();
    }

    public function getByMaNhanSu($maNhanSu){
      return DB::table('nhansu')->select('nhansu_thuocdonvi.MA_NHAN_SU','HO_VA_TEN','NAM_SINH','GIOI_TINH','DIA_CHI','nhansu.SO_DIEN_THOAI','EMAIL')->join('nhansu_thuocdonvi','nhansu.MA_NHAN_SU','=','nhansu_thuocdonvi.MA_NHAN_SU')->where('nhansu.MA_NHAN_SU',$maNhanSu)->paginate(5);
    }

    public function themNhanSu($id,$hoten,$namsinh,$gioitinh,$diachi,$sodienthoai,$email){
   	  return DB::table('nhansu')->insert(['MA_NHAN_SU' => $id ,'HO_VA_TEN' => $hoten,'NAM_SINH' => $namsinh,'GIOI_TINH' => $gioitinh,'DIA_CHI' => $diachi,'SO_DIEN_THOAI' => $sodienthoai,'EMAIL' => $email]);
    }

    public function getItem($id){
      return DB::table('nhansu')->where('MA_NHAN_SU',$id)->first();
    }

    public function getItemConditon($id,$name){
      return DB::table('nhansu')->where('MA_NHAN_SU','LIKE','%'.$id.'%')->orwhere('HO_VA_TEN','LIKE','%'.$name.'%')->paginate(3);
    }
    
    public function getByIdDonVi($idDonVi){
      return DB::table('nhansu')->select("nhansu.MA_NHAN_SU","HO_VA_TEN")->join("nhansu_thuocdonvi","nhansu.MA_NHAN_SU","=","nhansu_thuocdonvi.MA_NHAN_SU")->where("nhansu_thuocdonvi.MA_DON_VI",$idDonVi)->get();
    }
}
