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

    public function getUsers()
    {
        $row = DB::table('users')->where('group_id', '2')->get();
        if($row)
        {
            return $row;
        }
        else
        {
            return false;
        }
    }
}
