<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;

class MYController extends Controller
{
	public $site;
	public function __construct()
    {
        
    }

    public function UserIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function unsetSession($key)
    {
    	if (session()->has($key)) {
           session()->forget($key);
        }
    }
}
