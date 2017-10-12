<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Login extends Model
{
    public function CheckAccountLogin($email)
    {
    	$row = DB::table('users')->where('email', $email)->first();
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
