<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Redirector;
use DB;
use App\Models\Site;
use App\Models\Welcome;

class WelcomeController extends MYController
{
    public $welcome;
	public function __construct()
    {
        $this->site = new Site();
        $this->welcome = new Welcome();
    }

    function index()
    {
        if (!$this->site->loggedIn()) {
            return redirect('/auth/login');            
        }
        $result = $this->welcome->getOnboarding();
        return view('welcome')->with('data', $result);
    }

    function logout()
    {
        session()->flush();
        return redirect('/auth/login');
    }
}
