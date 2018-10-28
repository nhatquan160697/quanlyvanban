<?php

namespace App\Http\Controllers\quanlyvanban;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\CongVan;
use App\Model\NhanSu;
use App\Model\DonVi;
class CongVanController extends Controller
{
    public function __construct(CongVan $congVan, NhanSu $nhanSu, DonVi $donVi){
        $this->congVan = $congVan;
        $this->nhanSu = $nhanSu;
        $this->donVi = $donVi;
    }
    
    public function danhSachCongVanDenDonVi(){
        $dsCongVan = $this->congVan->danhSachCongVanDenDonVi();
        $dsDonVi = $this->donVi->getAllExceptMe(Session::get('maDonVi'));
        $dsNhanSu = $this->nhanSu->getAllExceptMe(Session::get('maNhanSu'));
        $dsFile = array();
        foreach($dsCongVan as $congVan){
            $soCongVan = $congVan->SO_CONG_VAN;
            $dsFile[$soCongVan] = $this->congVan->fileDinhKem($soCongVan);
        }
        return view('quanlyvanban.congvan.DanhSachCongvanDenDonVi',compact('dsCongVan','dsDonVi','dsNhanSu','dsFile'));
    }
    public function danhSachCongVanDenCaNhan(){
        $dsCongVan = $this->congVan->danhSachCongVanDenCaNhan();
        $dsDonVi = $this->donVi->getAllExceptMe(Session::get('maDonVi'));
        $dsNhanSu = $this->nhanSu->getAllExceptMe(Session::get('maNhanSu'));
        $dsFile = array();
        foreach($dsCongVan as $congVan){
            $soCongVan = $congVan->SO_CONG_VAN;
            $dsFile[$soCongVan] = $this->congVan->fileDinhKem($soCongVan);
        }
        return view('quanlyvanban.congvan.DanhSachCongVanDenCaNhan',compact('dsCongVan','dsDonVi','dsNhanSu','dsFile'));
    }
    public function ChiTietVanBan(){
        return view('quanlyvanban.congvan.ChiTietVanBan');
    }
    //Danh sách công văn
    function danhSachCongvanDi(Request $request){
        if(!Session::has('username') || Session::get('quyenTruyCap')==3)
            return redirect()->route('quanlyvanban.auth.index');
        $dsCongVanDi = $this->congVan->danhSachCongVanDi();
        $dsDonVi = $this->donVi->getAll();
        //lay danh sach file dinh kem dua vao 1 mang voi index la socongvan va gia tri la mang file dinh kem theo socongvan do
        $dsFile = array();
        foreach($dsCongVanDi as $congVan){
            $soCongVan = $congVan->SO_CONG_VAN;
            $dsFile[$soCongVan] = $this->congVan->fileDinhKem($soCongVan);
        }
        $tuKhoa = '';
        $loaiTimKiem = '';
        //form tìm kiếm văn bản
        if(isset($request->all()['TimKiemVanBanDi'])){
            $loaiTimKiem = $request->all()['LoaiTimKiem'];
            $tuKhoa = $request->all()['keyword'];
            if($loaiTimKiem == 1){
                $dsCongVanDi = $this->congVan->timCongVanDiTheoSoCongVan($tuKhoa);
            }
            else if($loaiTimKiem == 2){
                $dsCongVanDi = $this->congVan->timCongVanDiTheoTrichYeuNoiDung($tuKhoa);
            }
        }
        return view('quanlyvanban.congvan.DanhSachCongvanDi',compact('dsCongVanDi','dsDonVi','dsFile'));
    }
    function danhSachCongVanDiNhanSu(){
        if(!Session::has('username') || Session::get('quyenTruyCap')==3)
            return redirect()->route('quanlyvanban.auth.index');
        $dsCongVanDi = $this->congVan->danhSachCongVanDiCaNhan();
        $dsDonVi = $this->donVi->getAll();
        //lay danh sach file dinh kem dua vao 1 mang voi index la socongvan va gia tri la mang file dinh kem theo socongvan do
        $dsFile = array();
        foreach($dsCongVanDi as $congVan){
            $soCongVan = $congVan->SO_CONG_VAN;
            $dsFile[$soCongVan] = $this->congVan->fileDinhKem($soCongVan);
        }
        return view('quanlyvanban.congvan.DanhSachCongvanDiCaNhan',compact('dsCongVanDi','dsDonVi','dsFile'));
    }
    function chiTietCongVanDiNhanSu($soCongVan,$maNhanSu){
        if(!Session::has('username') || Session::get('quyenTruyCap')==3)
            return redirect()->route('quanlyvanban.auth.index');
        $thongTinCongVan = $this->congVan->chiTietCongVanDiCaNhan($soCongVan,$maNhanSu);
        $dsFile = $this->congVan->fileDinhKem($soCongVan);
        return view('quanlyvanban.congvan.ChiTietVanBanDiCaNhan',compact('thongTinCongVan','dsFile'));
    }
    public function xoaCongVanDiNhanSu(Request $request){
        $soCongVan = $request->SoCongVan;
        $maNhanSu = $request->MaNhanSu;
        $this->congVan->xoaCongVanDiCaNhan($soCongVan,$maNhanSu);
        return redirect()->route('quanlyvanban.congvan.danhsachcongvandinhansu');
    }
    public function getSuaCongVanDiNhanSu($soCongVan,$maNhanSu){
        $thongTinCongVan = $this->congvan->congVanByID($soCongVan);
        return view('quanlyvanban.congvan.SuaVanBanDiCaNhan');
    }
    function danhSachCongVanDen(Request $request){
        if(!Session::has('username') || Session::get('quyenTruyCap')==3)
            return redirect()->route('quanlyvanban.auth.index');
        $dsDonVi = $this->donVi->getAllExceptMe(Session::get('maDonVi'));
        $dsNhanSu = $this->nhanSu->getAllExceptMe(Session::get('maNhanSu'));
        $dsCongVanDen = $this->congVan->danhSachCongVanDen();
        //lay danh sach file dinh kem dua vao 1 mang voi index la socongvan va gia tri la mang file dinh kem theo socongvan do
        $dsFile = array();
        foreach($dsCongVanDen as $congVan){
            $soCongVan = $congVan->SO_CONG_VAN;
            $dsFile[$soCongVan] = $this->congVan->fileDinhKem($soCongVan);
        }
        $tuKhoa = '';
        $loaiTimKiem = '';
        //form tìm kiếm văn bản 
        if(isset($request->all()['TimKiemVanBanDen'])){
            $loaiTimKiem = $request->all()['LoaiTimKiem'];
            $tuKhoa = $request->all()['keyword'];
            if($loaiTimKiem == 1){
                $dsCongVanDen = $this->congVan->timCongVanDenTheoSoCongVan($tuKhoa);
            }
            else if($loaiTimKiem == 2){
                $dsCongVanDen = $this->congVan->timCongVanDenTheoTrichYeuNoiDung($tuKhoa);
            }
            else if($loaiTimKiem == 3){
                $donViTimKiem = $request->all()['DSDonVi'];
                $dsCongVanDen = $this->congVan->timCongVanDenTheoDonViBanHanh($donViTimKiem);
            }
        }
        //var_dump($KeyWord);
        return view('quanlyvanban.congvan.DanhSachCongVanDen',compact('dsDonVi','dsCongVanDen','dsFile','dsNhanSu'));
    }

    public function danhSachCongVanDen_TimKiemnangCao(){
        if(!Session::has('username') || Session::get('quyenTruyCap')==3)
            return redirect()->route('quanlyvanban.auth.index');
        return view('quanlyvanban.congvan.DanhSachCongVanDen_TimKiemNangCao');
    }
    

    //---------------------------------------------------------------------------------------------------------------------------------
    //Tạo mới công văn
    public function getTaoMoiCongVan(){
        if(!Session::has('username') || Session::get('quyenTruyCap')==3)
            return redirect()->route('quanlyvanban.auth.index');
    	$dsLoaiVanBan = \DB::table('l_vanban')->get()->toArray();
    	$dsDonVi = \DB::table('donvi')->get()->toArray();
    	$dsNhanSu = \DB::table('nhansu')->get();
        $dsNguoiKyDuyet = $this->nhanSu->getByIdDonVi(Session::get("maDonVi"));
    	return view('quanlyvanban.congvan.frmTaoMoiCongVan',compact('dsNguoiKyDuyet','dsLoaiVanBan','dsDonVi','dsNhanSu'));
    }

    function postTaoMoiCongVan(Request $request){
    	$soCongVan = $request->SoCongVan;
    	$loaiVanBan = $request->LoaiVanBan;
    	$ngayBanHanh = $request->NgayBanHanh;
    	$capDoQuanTrong = isset($request->CapDoQuanTrong)?'1':'0';
    	$donViBanHanh = Session::get('maDonVi');
    	$trichYeuNoiDung = $request->TrichYeuNoiDung;
        $nguoiGui = session('maNhanSu');
        $nguoiKyDuyet = $request->NguoiKyDuyet;
    	$FileDinhKem = ($request->file('FileDinhKem')!==null)?$request->file('FileDinhKem'):array();
    	$loaiGui = $request->all()['LoaiGui'];
    	//them vao bảng congvan
    	\DB::table('congvan')->insert(array('SO_CONG_VAN'=>$soCongVan,'LOAI_VAN_BAN'=>$loaiVanBan,'NGAY_BAN_HANH'=>$ngayBanHanh,'DON_VI_BAN_HANH'=>$donViBanHanh,'CAP_DO_QUAN_TRONG'=>$capDoQuanTrong,'TRICH_YEU_NOI_DUNG'=>$trichYeuNoiDung,'NGUOI_GUI'=>$nguoiGui,'NGUOI_KY_DUYET'=>$nguoiKyDuyet,'LOAI_GUI'=>$loaiGui));
        foreach ($FileDinhKem as $file) {
            //lưu file vào thư mục public\file với định dạng tên timestamp+tên file
            $tenFileMoi = time().$file->getClientOriginalName();
            $file->move('file', $tenFileMoi);
            //them vao bang congvan_filedinhkem
            \DB::table('congvan_filedinhkem')->insert(array('SO_CONG_VAN'=>$soCongVan,'FILE_DINH_KEM'=>$tenFileMoi,'FILE_KHA_DUNG'=>'1'));
        }
        if($loaiGui==1){
            $dsNguoiNhan = $request->all()['GuiChoCaNhan'];
            //them vao db bang congvan_nhansu
            foreach ($dsNguoiNhan as $value) {
                \DB::table('congvan_nhansu')->insert(array('SO_CONG_VAN'=>$soCongVan,'MA_NHAN_SU'=>$value,'NGAY_NHAN'=>date('y-m-d')));    
            }
        }
        else if($loaiGui==2){
            $dsDonViNhan = $request->all()['GuiChoDonVi'];
            $guiCho = $request->all()['GuiCho'];
            //them vao db bang congvan_donvi
            foreach ($dsDonViNhan as $value){
            \DB::table('congvan_donvi')->insert(array('SO_CONG_VAN'=>$soCongVan,'MA_DON_VI'=>$value,'LOAI_GUI'=>$guiCho,'NGAY_NHAN'=>date('y-m-d')));
            }
        }
        else if($loaiGui == 3){
             $dsTatCaDonVi = \DB::table('donvi')->select('MA_DON_VI')->get()->toArray();
             foreach ($dsTatCaDonVi as $value) {
                \DB::table('congvan_donvi')->insert(array('SO_CONG_VAN'=>$soCongVan,'MA_DON_VI'=>$value->MA_DON_VI,'LOAI_GUI'=>'3','NGAY_NHAN'=>date('y-m-d')));    
             }
        }
    	return redirect()->route('quanlyvanban.congvan.danhsachcongvandi',['page'=>1]);
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    //Chỉnh sửa công văn


    //---------------------------------------------------------------------------------------------------------------------------------
    //Phản hồi công văn
    public function getPhanHoiCongVan($soCongVan){
        if(!Session::has('username') || Session::get('quyenTruyCap')==3)
            return redirect()->route('quanlyvanban.auth.index');
        $dsPhanHoi = \DB::table('congvan_phanhoi')->select('NOI_DUNG_PHAN_HOI','TEN_DON_VI','congvan_phanhoi.MA_DON_VI','congvan_phanhoi.MA_PHAN_HOI')->join('donvi','congvan_phanhoi.MA_DON_VI','=','donvi.MA_DON_VI')->where('SO_CONG_VAN',$soCongVan)->get()->toArray();
        $thongTinvanBan = \DB::table('congvan')->select('TRICH_YEU_NOI_DUNG')->where('SO_CONG_VAN',$soCongVan)->first();
        $dsFile =  \DB::table('congvan_phanhoi_filedinhkem')->get()->toArray();
        return view('quanlyvanban.congvan.PhanHoiCongVan',compact('thongTinvanBan','dsPhanHoi','dsFile','soCongVan'));
    }
    public function postPhanHoiCongVan(Request $request){
        $maPhanHoi = time();
        $soCongVan = $request->all()['SoCongVan'];
        $noiDungPhanHoi = $request->all()['NoiDungPhanHoi'];
        $maDonVi = Session::get('maDonVi');

        $FileDinhKem = ($request->file('FileDinhKem')==null)?array():$request->file('FileDinhKem');

        \DB::table('congvan_phanhoi')->insert(array('MA_PHAN_HOI'=>$maPhanHoi,'SO_CONG_VAN'=>$soCongVan,'MA_DON_VI'=>$maDonVi,'NOI_DUNG_PHAN_HOI'=>$noiDungPhanHoi));
        foreach ($FileDinhKem as $file) {
            //lưu file vào thư mục public\file với định dạng tên timestamp+tên file
            $tenFileMoi = time().$file->getClientOriginalName();
            $file->move('file_ykienphanhoi', $tenFileMoi);
            //them vao bang congvan_filedinhkem
            \DB::table('congvan_phanhoi_filedinhkem')->insert(array('MA_PHAN_HOI'=>$maPhanHoi,'FILE_DINH_KEM'=>$tenFileMoi));
        }
        return redirect()->route('quanlyvanban.congvan.phanhoicongvan',['soCongVan'=>$soCongVan]);
    }

    public function chuyenTiepVanBanCaNhan(Request $request){
        $soVanBan = $request->SoVanBan;
        $dsNguoiNhan = $request->ChuyenTiepCaNhan;
        foreach ($dsNguoiNhan as $nguoiNhan) {
            $this->congVan->guiCongVanNhanSu($soVanBan,$nguoiNhan);
        }
        return redirect()->route('quanlyvanban.congvan.danhsachcongvanden');
    }

    public function chuyenTiepVanBanDonVi(Request $request){
        $soVanBan = $request->SoVanBan;
        $loaiGui = $request->LoaiGui;
        $dsDonViNhan = $request->ChuyenTiepDonVi;
        foreach ($dsDonViNhan as $donVi) {
            $this->congVan->guiCongVanDonVi($soVanBan,$donVi,$loaiGui);
        }
        return redirect()->route('quanlyvanban.congvan.danhsachcongvanden');
    }
}
