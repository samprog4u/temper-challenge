<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Register extends Model
{
    public function RegisterUser($data)
    {
    	$i = DB::table('users')->insertGetId($data);
        return $i;
    }

    public function RegisterProfile($data)
    {
        $i = DB::table('user_profiles')->insertGetId($data);
        return $i;
    }

    public function RegisterJob($data)
    {
        $i = DB::table('job_interests')->insertGetId($data);
        return $i;
    }

    public function RegisterExperience($data)
    {
        $i = DB::table('job_experience')->insertGetId($data);
        return $i;
    }

    public function RegisterPortfolio($data)
    {
        $i = DB::table('portfolio')->insertGetId($data);
        return $i;
    }

    public function CheckEmailExist($email)
    {
        $row = DB::table('users')->where('email', $email)->first();
        if($row)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
