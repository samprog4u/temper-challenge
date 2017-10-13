<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Site extends Model
{
    public function loggedIn()
    {
        return (bool) session()->get('email');
    }

    public function Send_Mail($email, $msg, $subj)
    {
       @$myto = $email;
       @$mysub = $subj;
       @$myMes = $msg;
       $headers = "From: cs@temper.com\r\n";
       if(!mail($myto,$mysub,$myMes,$headers))
       {
   
       }
    }

    public function TrackActivities($data)
    {
    	$i = DB::table('activities')->insert($data);
        return $i;
    }

    public function TrackStages($data)
    {
        $i = DB::table('tracks')->insert($data);
        return $i;
    }

    public function TrackLoginAttempt($data)
    {
        $i = DB::table('login_attempts')->insert($data);
        return $i;
    }

    public function TrackUserLogin($data)
    {
        $i = DB::table('user_logins')->insert($data);
        return $i;
    }

    public function UpdateUser($id, $data)
    {
        $i = DB::table('users')->where('id', $id)->update($data);
        return $i;
    }

    function GetActivationCode($length){
         $small_alphabets=range('a','z');
         $numbers=range('0','9');
         $big_alphabets=range('A','Z');
         $final_array= array_merge($small_alphabets,$numbers,$big_alphabets);
         $text='';
         
         while($length--){
             $key=array_rand($final_array);
             $text .= $final_array[$key];
             }                   
         return $text;
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

    public function CheckActivationCode($code)
    {
        $row = DB::table('users')->where('activation_code', $code)->where('activation_code_expire', 1)->first();
        if($row)
        {
            return $row->id;
        }
        else
        {
            return false;
        }
    }

    public function getJobInterest($user_id)
    {
        $row = DB::table('job_interests')->where('user_id', $user_id)->first();
        if($row)
        {
            return $row->jobs;
        }
        else
        {
            return false;
        }
    }

    public function UpdateTrackStages($id, $data)
    {
        $i = DB::table('tracks')->where('user_id',$id)->update($data);
        return $i;
    }

    public function ApproveUser($id, $data1, $data2)
    {
        $i = DB::table('tracks')->where('user_id', $id)->update($data1);
        $j = DB::table('users')->where('id', $id)->update($data2);
        if($i && $j)
        {
            return true;
        }

        return false;
    }

    public function getStages()
    {
        $row = DB::table('stages')->get();
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
