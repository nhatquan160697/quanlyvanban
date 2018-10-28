<?php

namespace App\Http\Controllers\quanlyvanban;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BieuMauRequest;
use Session;
use App\Model\BieuMau;
use App\DonVi;
use App\Model\NhanSu;
class BieuMauController extends Controller
{
    public function __construct(BieuMau $bieuMau,NhanSu $nhanSu,DonVi $donVi){
        $this->bieuMau = $bieuMau;
        $this->donVi = $donVi;
        $this->nhanSu = $nhanSu;
    }

    public function danhSachBieuMau(){
        if(!Session::has('username'))
            return redirect(url('/'));
    	$dsBieuMau = $this->bieuMau->getAll();
        //lấy danh sách file đính kèm cho từng biểu mẫu
        $dsFile = array();
        foreach($dsBieuMau as $bieuMau){
            $maBieuMau = $bieuMau->MA_BIEU_MAU;
            $dsFile[$maBieuMau] = $this->bieuMau->getExistFile($maBieuMau);
        }
        return view('quanlyvanban.bieumau.DanhSachBieuMau',compact('dsBieuMau','dsFile'));
    }
    public function getTaoMoiBieuMau(){
        if(!Session::has('username'))
            return redirect(url('/'));
    	$dsDonVi = $this->donVi->getAll();
    	$dsNhanSu = $this->nhanSu->getAll();
    	return view('quanlyvanban.bieumau.FormTaoMoiBieuMau',compact('dsDonVi','dsNhanSu'));
    }
    public function postTaoMoiBieuMau(BieuMauRequest $request){
        if(!Session::has('username'))
            return redirect(url('/'));
    	$tenBieuMau = $request->TenBieuMau;
    	$donViBanHanh = $request->DonViBanHanh;
    	$ngayBanHanh = $request->NgayBanHanh;
    	$ngayGui = date('y-m-d');
    	$trichYeuNoiDung = $request->TrichYeuNoiDung;
    	$nguoiKyDuyet = $request->NguoiKyDuyet;
    	$fileDinhKem = ($request->file('FileDinhKem')!==null)?$request->file('FileDinhKem'):array();
    	$values = array('TEN_NHOM_BIEU_MAU'=>$tenBieuMau,'NGAY_BAN_HANH'=>$ngayBanHanh,'DON_VI_BAN_HANH'=>$donViBanHanh,'NGAY_GUI'=>$ngayGui,'TRICH_YEU_NOI_DUNG'=>$trichYeuNoiDung,'NGUOI_KY_DUYET'=>$nguoiKyDuyet);
        $this->bieuMau->themMoi($values);
    	foreach ($fileDinhKem as $file) {
            //lấy mã biểu mẫu để làm ràng buộc thêm vào bảng bieumau_filedinhkem
            $tenFileMoi = time().$file->getClientOriginalName();
            $file->move('file_bieumau', $tenFileMoi);
            //them vao bang congvan_filedinhkem
            $this->bieuMau->themFileDinhKem(array('MA_BIEU_MAU'=>$maBieumau,'FILE_DINH_KEM'=>$tenFileMoi));
        }
    	return redirect()->route('quanlyvanban.bieumau.danhsachbieumau');
    }

    public function postXoaBieuMau(Request $request){
        $maBieuMau = $request->MaBieuMau;
        $this->bieuMau->xoaBieuMau($maBieuMau);
        return redirect()->route('quanlyvanban.bieumau.danhsachbieumau');
    }

    public function getSuaBieuMau($id){
        $dsDonVi = $this->donVi->getAll();
        $dsNhanSu = $this->nhanSu->getAll();
        $dsFile = $this->bieuMau->getExistFile($id);
        $thongTinBieuMau = $this->bieuMau->getById($id);
        return view('quanlyvanban.bieumau.FormSuaBieuMau',compact('dsDonVi','dsNhanSu','thongTinBieuMau','id','dsFile'));
    }
    
    public function postSuaBieuMau(Request $request){
        $maBieuMau = $request->MaBieuMau;
        $tenBieuMau = $request->TenBieuMau;
        $donViBanHanh = $request->DonViBanHanh;
        $ngayBanHanh = $request->NgayBanHanh;
        $trichYeuNoiDung = $request->TrichYeuNoiDung;
        $nguoiKyDuyet = $request->NguoiKyDuyet;
        $dsFileBiXoa = ($request->XoaFileDinhKem==null)?array():$request->XoaFileDinhKem;
        $fileDinhKem = ($request->file('FileDinhKem')!==null)?$request->file('FileDinhKem'):array();
        $values = array('TEN_NHOM_BIEU_MAU'=>$tenBieuMau,'NGAY_BAN_HANH'=>$ngayBanHanh,'DON_VI_BAN_HANH'=>$donViBanHanh,'TRICH_YEU_NOI_DUNG'=>$trichYeuNoiDung,'NGUOI_KY_DUYET'=>$nguoiKyDuyet);
        $this->bieuMau->suaBieuMau($maBieuMau,$values);
        $this->bieuMau->makeFileUnable($maBieuMau,$dsFileBiXoa);
        foreach ($fileDinhKem as $file) {
            //lấy timestamp gắn vào tên file để phân biệt
            $tenFileMoi = time().$file->getClientOriginalName();
            $file->move('file_bieumau', $tenFileMoi);
            //them vao bang congvan_filedinhkem
            $this->bieuMau->themFileDinhKem(array('MA_BIEU_MAU'=>$maBieumau,'FILE_DINH_KEM'=>$tenFileMoi));
        }
        return redirect()->route('quanlyvanban.bieumau.danhsachbieumau');
    }
}
