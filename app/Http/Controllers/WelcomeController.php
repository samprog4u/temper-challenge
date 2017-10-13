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

    function approve($id = NULL)
    {
        if (!$this->site->loggedIn()) {
            return redirect('/auth/login');            
        }
        if(!$id)
        {
            return view('users', $result);
            \Session::flash('error', trans('app_lang.invalid_user'));
            return redirect('users');
        }

        $data1 = array('stage_id' => 8);
        $data2 = array('status' => 8);

        if($this->site->ApproveUser($id, $data1, $data2))
        {
            \Session::flash('message', trans('app_lang.user_approve_success'));
            return redirect('users');
        }
        else
        {
            \Session::flash('error', trans('app_lang.user_approve_unsuccess'));
            return redirect('users');
        }
        
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

    function users()
    {
        if (!$this->site->loggedIn()) {
            return redirect('/auth/login');            
        }
        $result['users'] = $this->welcome->getUsers();
        $result['stages'] = $this->site->getStages();
        return view('users', $result);
    }
}
