<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;
class CongVan extends Model
{
    public function danhSachCongVanDen(){ 
        return DB::table('dscongvanden')->where('MA_CVNS',Session::get('maNhanSu'))->orWhere('MA_CVDV',Session::get('maDonVi'))->where('LOAI_GUI',Session::get('chucVu'))->orWhere('LOAI_GUI',3)->paginate(3);
    }
    public function congVanByID($soCongVan){
        return DB::table('congvan')->where('SO_CONG_VAN',$soCongVan)->first();
    }
    public function danhSachCongVanDenDonVi(){ 
        return DB::table('congvan_donvi')->select('congvan.SO_CONG_VAN','TEN_DON_VI','TRICH_YEU_NOI_DUNG','NGAY_BAN_HANH','CAP_DO_QUAN_TRONG')->join('congvan','congvan.SO_CONG_VAN','=','congvan_donvi.SO_CONG_VAN')->join('donvi','congvan.DON_VI_BAN_HANH','=','donvi.MA_DON_VI')->where('congvan_donvi.MA_DON_VI',Session::get('maDonVi'))->where('congvan.DON_VI_BAN_HANH','!=',Session::get('maDonVi'))->paginate(3);
    }
    public function danhSachCongVanDenCaNhan(){ 
        return DB::table('congvan_nhansu')->select('congvan.SO_CONG_VAN','TEN_DON_VI','TRICH_YEU_NOI_DUNG','NGAY_BAN_HANH','CAP_DO_QUAN_TRONG','DA_XEM')->join('congvan','congvan.SO_CONG_VAN','=','congvan_nhansu.SO_CONG_VAN')->join('nhansu','congvan_nhansu.MA_NHAN_SU','=','nhansu.MA_NHAN_SU')->join('donvi','congvan.DON_VI_BAN_HANH','=','donvi.MA_DON_VI')->where('congvan_nhansu.MA_NHAN_SU',Session::get('maNhanSu'))->paginate(3);
    }
    public function fileDinhKem($soCongVan){
        return DB::table('congvan_filedinhkem')->select('FILE_DINH_KEM')->where('SO_CONG_VAN',$soCongVan)->get();
    }
    public function danhSachCongVanDi(){
        return DB::table('congvan')->join('donvi','donvi.MA_DON_VI','=','congvan.DON_VI_BAN_HANH')->where('NGUOI_GUI',Session::get('maNhanSu'))->paginate(3);
    }
    public function danhSachCongVanDiDonVi(){
        return DB::table('congvan')->join('congvan_donvi','congvan_donvi.SO_CONG_VAN','=','congvan.SO_CONG_VAN')->where('NGUOI_GUI',Session::get('maNhanSu'))->paginate(3);
    }
    public function danhSachCongVanDiCaNhan(){
        return DB::table('congvan')->join('congvan_nhansu','congvan_nhansu.SO_CONG_VAN','=','congvan.SO_CONG_VAN')->where('NGUOI_GUI',Session::get('maNhanSu'))->paginate(3);
    }

    public function xoaCongVanDiCaNhan($soCongVan, $maNhanSu){
        DB::table('congvan_filedinhkem')->where('SO_CONG_VAN',$soCongVan)->update(['FILE_KHA_DUNG'=>'0']);
        DB::table('congvan_nhansu')->where(['SO_CONG_VAN'=>$soCongVan,'MA_NHAN_SU'=>$maNhanSu])->delete();
        DB::table('congvan')->where(['NGUOI_GUI'=>Session::get('maNhanSu'),'SO_CONG_VAN'=>$soCongVan])->delete();
    }

    public function chiTietCongVanDiCaNhan($soCongVan, $maNhanSu){
        return DB::table('congvan')->select('congvan.SO_CONG_VAN','TEN_L_NVANBAN','NGAY_BAN_HANH','NGAY_GUI','CAP_DO_QUAN_TRONG','TRICH_YEU_NOI_DUNG','HO_VA_TEN','DA_XEM')->join('l_vanban','congvan.LOAI_VAN_BAN','=','l_vanban.MA_L_NVANBAN')->join('congvan_nhansu','congvan_nhansu.SO_CONG_VAN','=','congvan.SO_CONG_VAN')->join('nhansu','congvan.NGUOI_KY_DUYET','=','nhansu.MA_NHAN_SU')->where(['NGUOI_GUI'=>Session::get('maNhanSu'),'congvan_nhansu.SO_CONG_VAN'=>$soCongVan,'congvan_nhansu.MA_NHAN_SU'=>$maNhanSu])->first();
    }
    public function taoMoiCongVan($soCongVan,$loaiVanBan,$ngayBanHanh,$donViBanHanh,$capDoQuanTrong,$trichYeuNoiDung,$nguoiGui,$nguoiKyDuyet,$loaiGui){
        DB::table('congvan')->insert(array('SO_CONG_VAN'=>$soCongVan,'LOAI_VAN_BAN'=>$loaiVanBan,'NGAY_BAN_HANH'=>$ngayBanHanh,'DON_VI_BAN_HANH'=>$donViBanHanh,'CAP_DO_QUAN_TRONG'=>$capDoQuanTrong,'TRICH_YEU_NOI_DUNG'=>$trichYeuNoiDung,'NGUOI_GUI'=>$nguoiGui,'NGUOI_KY_DUYET'=>$nguoiKyDuyet,'LOAI_GUI'=>$loaiGui));
    }

    public function timCongVanDenTheoSoCongVan($soCongVan){
        return DB::table('dscongvanden')->where('SO_CONG_VAN','LIKE','%'.$soCongVan.'%')->where('MA_CVNS',Session::get('maNhanSu'))->orWhere('MA_CVDV',Session::get('maDonVi'))->where('LOAI_GUI',Session::get('chucVu'))->paginate(3);
    }

    public function timCongVanDenTheoTrichYeuNoiDung($trichYeuNoiDung){
        return DB::table('dscongvanden')->where('TRICH_YEU_NOI_DUNG','LIKE','%'.$trichYeuNoiDung.'%')->where('MA_CVNS',Session::get('maNhanSu'))->orWhere('MA_CVDV',Session::get('maDonVi'))->where('LOAI_GUI',Session::get('chucVu'))->paginate(3);
    }

    public function timCongVanDenTheoDonViBanHanh($maDonVi){
    	return DB::table('dscongvanden')->where('DON_VI_BAN_HANH',$maDonVi)->where('MA_CVNS',Session::get('maNhanSu'))->orWhere('MA_CVDV',Session::get('maDonVi'))->where('LOAI_GUI',Session::get('chucVu'))->paginate(3);
    }

    public function timCongVanDiTheoSoCongVan($soCongVan){
        return DB::table('congvan')->join('donvi','donvi.MA_DON_VI','=','congvan.DON_VI_BAN_HANH')->where('SO_CONG_VAN','LIKE','%'.$soCongVan.'%')->where('NGUOI_GUI',Session::get('maNhanSu'))->paginate(3);
    }

    public function timCongVanDiTheoTrichYeuNoiDung($trichYeuNoiDung){
        return DB::table('congvan')->join('donvi','donvi.MA_DON_VI','=','congvan.DON_VI_BAN_HANH')->where('TRICH_YEU_NOI_DUNG','LIKE','%'.$trichYeuNoiDung.'%')->where('NGUOI_GUI',Session::get('maNhanSu'))->paginate(3);
    }

    public function guiCongVanNhanSu($soCongVan,$maNhanSu){
        DB::table('congvan_nhansu')->insert(array('SO_CONG_VAN'=>$soCongVan,'MA_NHAN_SU'=>$maNhanSu,'NGAY_NHAN'=>date('y-m-d')));
    }

    public function guiCongVanDonVi($soCongVan,$maDonVi,$loaiGui){
        DB::table('congvan_donvi')->insert(array('SO_CONG_VAN'=>$soCongVan,'MA_DON_VI'=>$maDonVi,'LOAI_GUI'=>$loaiGui,'NGAY_NHAN'=>date('y-m-d')));
    }
}
