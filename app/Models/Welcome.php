<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Welcome extends Model
{
    public function getOnboarding()
    {
        $result=DB::table('tracks')
        ->leftJoin('stages', 'stages.stages', '=', 'tracks.stage_id')
        ->select('tracks.stage_id', 'stages.percent', 'stages.description')
        ->get();
        return $result;
    }

    public function ListSearchAccount($str)
    {
    	$result = DB::table('admin_basic_info')
    	->where('account_id', 'like', '%' . $str . '%')
    	->orwhere('account_name', 'like', '%' . $str . '%')
    	->orwhere('account_type', 'like', '%' . $str . '%')
    	->orwhere('created_at', 'like', '%' . $str . '%')
    	->orderBy('id', 'asc')
    	->get();
      	return $result;
    }

    public function ListViews($str)
    {
    	$account_id = DB::table('admin_basic_info')->where('id',$str)->value('account_id');
    	$row1 = DB::table('admin_basic_info')->where('account_id',$account_id)->first();
    	$row2 = DB::table('admin_handle')->where('account_id',$account_id)->first();
    	$row3 = DB::table('technical_handle')->where('account_id',$account_id)->first();
        $row4 = $this->FetchStatesById($row2->state);
        $row5 = $this->FetchStatesById($row3->state);
    	return array($row1, $row2, $row3, $row4, $row5);
    }
}
