<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Login;
use App\Models\Site;
class LoginController extends MYController
{
    public $qlogin;
    function __construct()
    {
        $this->qlogin=new Login();
        $this->site = new Site();
    }

    public function login(Request $request)
    {
        $post=$request->all();
        $v = \Validator::make($request->all(),

            [
                'email'  => 'required|email',
                'password' => 'required',
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $email = $post['email'];
            $password = $post['password'];
            $res = $this->qlogin->CheckAccountLogin($email);
            if($res)
            {
                if($res->status == 1 && $res->group_id != 1)
                {
                   \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.not_yet_activated'));
                   return redirect('/auth/login');
                }

                if(Hash::check($password, $res->password))
                {
                    $user_ip = $this->UserIp();
                    $uData = array('last_login_ip' => $user_ip);
                    $this->site->UpdateUser($res->id, $uData);

                    if($res->group_id == 1)
                    {
                        \Session::put('user', $res);
                        \Session::put('email', $email);
                        
                        $datas = array(
                            'ip' => $user_ip,
                            'user_id' => $res->id,
                            'date_created' => date('Y-m-d H:i:s')
                        );
                        $this->site->TrackUserLogin($datas);
                        return redirect('welcome');
                    }

                    if($res->status == 2 && $res->group_id != 1)
                    {
                        \Session::put('user', $res);
                        return redirect('/auth/user_profile');
                    }
                    else if($res->status == 3 && $res->group_id != 1)
                    {
                        \Session::put('user', $res);
                        return redirect('/auth/job_interest');
                    }
                    else if($res->status == 4 && $res->group_id != 1)
                    {
                        \Session::put('user', $res);
                        $job_interest = $this->site->getJobInterest($res->id);
                        \Session::put('pick_job', $job_interest);
                        return redirect('/auth/job_experience');
                    }
                    else if($res->status == 5 && $res->group_id != 1)
                    {
                        \Session::put('user', $res);
                        return redirect('/auth/freelancer');
                    }
                    else if($res->status == 6 && $res->group_id != 1)
                    {
                        \Session::put('user', $res);
                        return redirect('/auth/wait_approval');
                    }
                    else if($res->status == 7 && $res->group_id != 1)
                    {
                        \Session::put('user', $res);
                        return redirect('/auth/completed');
                    }
                }
                else
                {
                   $date_created = date('Y-m-d H:i:s');
                   $user_ip = $this->UserIp();
                   $data = array(
                       'ip' => $user_ip,
                       'email' => $email,
                       'date_created' => $date_created
                   );
                   $this->site->TrackLoginAttempt($data);
                   \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.invalid_password'));
                   return redirect('/auth/login');
                }
            }
            else
            {
                $date_created = date('Y-m-d H:i:s');
                $user_ip = $this->UserIp();
                $data = array(
                    'ip' => $user_ip,
                    'email' => $email,
                    'date_created' => $date_created
                );
                $this->site->TrackLoginAttempt($data);
                \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.invalid_email'));
                return redirect('/auth/login');
            }
        }
    }
}
