<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DonVi extends Model
{
    public function getAll(){
    	return DB::table('donvi')->get();
    }

    public function dsDonVi(){
    	return DB::table('donvi')->get();
    }

    public function getAllExceptMe($maDonVi){
      return DB::table('donvi')->where('MA_DON_VI','!=',$maDonVi)->get();
    }
}
