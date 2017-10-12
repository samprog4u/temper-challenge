<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Redirector;
use DB;
use App\Models\Register;
use App\Models\Site;
use Illuminate\Support\Facades\Hash;

class RegisterController extends MYController
{
    public $reg;
	public function __construct()
    {
        $this->reg = new Register();
        $this->site = new Site();
    }

    function users()
    {
        if(!session()->get('user'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }
        return view('user_profile');
    }

    function jobs()
    {
        if(!session()->get('user'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }
        return view('job_interest');
    }

    function experience()
    {
        if(!session()->get('user') || !session()->get('pick_job'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }
        return view('job_experience');
    }

    function freelance()
    {
        if(!session()->get('user') || !session()->get('pick_job'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }
        return view('job_freelancer');
    }

    function approval()
    {
        if(!session()->get('user') || !session()->get('pick_job'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }
        return view('final_stage');
    }

    function completed()
    {
        if(!session()->get('user') || !session()->get('pick_job'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }
        return view('completed');
    }

    function activate($code = NULL)
    {
        $id = $this->site->CheckActivationCode($code);
        //exit(var_dump($id));
        if($id)
        {
            $date_created = date('Y-m-d H:i:s');
            $user_ip = $this->UserIp();
            $aData = array(
                'user_id' => $id,
                'ip' => $user_ip,
                'actions' => trans('app_lang.account_activation'),
                'date_created' => $date_created
            );

            $sData = array('stage_id' => 2);

            $data = array(
                'status' => 2,
                'activation_code_expire' => 0                
            );

            $this->site->TrackActivities($aData);
            $this->site->UpdateTrackStages($id, $sData);
            $this->site->UpdateUser($id, $data);
            \Session::flash('message','<strong>Success:</strong>!<br />' . trans('app_lang.activation_success'));
            return redirect('/auth/confirmation_token');
        }
        else
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.activation_expired'));
            return redirect('/auth/confirmation_token');
        }
    }

    function register(Request $request)
    {
        $post=$request->all();
        $v = \Validator::make($request->all(),

            [
                'firstname' => 'required',
                'lastname' => 'required',
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
            $firstname = $post['firstname'];
            $lastname = $post['lastname'];
            $password = bcrypt($post['password']);
            $date_created = date('Y-m-d H:i:s');
            $res = $this->reg->CheckEmailExist($email);
            $user_ip = $this->UserIp();
            $code = $email . $firstname . $lastname . $date_created;
            $salt = '}#f4ga~g%7hjg4&j(7mk?/P!bj';
            $hash1_sha1 = SHA1($salt.$code);
            $activation_code = $this->site->GetActivationCode(110) . $hash1_sha1;
            if($res)
            {
                $data = array(
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'password' => $password,
                    'status' => 1,
                    'ip' => $user_ip,
                    'activation_code' => $activation_code,
                    'activation_code_expire' => 1,
                    'group_id' => 2,
                    'date_created' => $date_created,
                    );

                $id = $this->reg->RegisterUser($data);
                if($id)
                {
                    $user_ip = $this->UserIp();
                    $aData = array(
                        'user_id' => $id,
                        'ip' => $user_ip,
                        'actions' => trans('app_lang.account_creation'),
                        'date_created' => $date_created
                    );

                    $sData = array(
                        'user_id' => $id,
                        'stage_id' => 1,
                        'date_created' => $date_created
                    );
                    
                    $this->site->TrackActivities($aData);
                    $this->site->TrackStages($sData);
                    $subj = trans('app_lang.account_creation');
                    $msg = trans('app_lang.mail_text') . url('/') . "/activate/" . $activation_code;
                    $this->site->Send_Mail($email, $msg, $subj);

                    \Session::flash('message','<strong>Success:</strong>!<br />' . trans('app_lang.account_success'));
                    return redirect('/auth/signup');
                }
                else
                {
                     \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.account_not_success'));
                     return redirect('/auth/signup');
                }
            }
            else
            {
                \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.email_exist'));
                return redirect('/auth/signup');
            }
        }
    }

    function profile(Request $request)
    {
        if(!session()->get('user'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }

        $post=$request->all();
        $v = \Validator::make($request->all(),

            [
                'phone_no' => 'required',
                'zipcode' => 'required|min:4|max:4',
                'gender'  => 'required',
                'dob' => 'required',
                'country'  => 'required',
                'state' => 'required',
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $phone_no = $post['phone_no'];
            $zipcode = $post['zipcode'];
            $gender = $post['gender'];
            $dob = $post['dob'];
            $country = $post['country'];
            $state = $post['state'];
            $user = session()->get('user');
            $date_created = date('Y-m-d H:i:s');

            $data = array(
                'user_id' => $user->id,
                'phone_no' => $phone_no,
                'gender' => $gender,
                'zip_code' => $zipcode,
                'dob' => $dob,
                'country_id' => $country,
                'state' => $state,
                'date_created' => $date_created,
                );

            $i = $this->reg->RegisterProfile($data);
            if($i)
            {
                $user_ip = $this->UserIp();
                $aData = array(
                    'user_id' => $user->id,
                    'ip' => $user_ip,
                    'actions' => trans('app_lang.profile_completed'),
                    'date_created' => $date_created
                );

                $sData = array('stage_id' => 3);

                $uData = array('status' => 3);
                
                $this->site->TrackActivities($aData);
                $this->site->UpdateTrackStages($user->id, $sData);
                $this->site->UpdateUser($user->id, $uData);
                return redirect('/auth/job_interest');
            }
            else
            {
                 \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.profile_not_success'));
                 return redirect('/auth/user_profile');
            }
        }
    }

    function job_interested(Request $request)
    {
        if(!session()->get('user'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }

        $post=$request->all();
        $v = \Validator::make($request->all(),

            [
                'specialization' => 'required',
                'job_interest'  => 'required',
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $specialization = $post['specialization'];
            $job_interest = $post['job_interest'];
            $user = session()->get('user');
            $date_created = date('Y-m-d H:i:s');

            $data = array(
                'user_id' => $user->id,
                'specialization_id' => $specialization,
                'jobs' => $job_interest,
                'date_created' => $date_created,
                );

            $i = $this->reg->RegisterJob($data);
            if($i)
            {
                $user_ip = $this->UserIp();
                $aData = array(
                    'user_id' => $user->id,
                    'ip' => $user_ip,
                    'actions' => trans('app_lang.job_completed'),
                    'date_created' => $date_created
                );

                $sData = array('stage_id' => 4);

                $uData = array('status' => 4);
                
                $this->site->TrackActivities($aData);
                $this->site->UpdateTrackStages($user->id, $sData);
                $this->site->UpdateUser($user->id, $uData);
                \Session::put('pick_job', $job_interest);
                return redirect('/auth/job_experience');
            }
            else
            {
                 \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.interest_not_success'));
                 return redirect('/auth/job_interest');
            }
        }
    }

    function job_experienced(Request $request)
    {
        if(!session()->get('user') || !session()->get('pick_job'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }

        $post=$request->all();
        $v = \Validator::make($request->all(),

            [
                'relevant' => 'required',
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $relevant = $post['relevant'];
            $job_experience = $post['job_experience'];
            $user = session()->get('user');
            $date_created = date('Y-m-d H:i:s');

            $data = array(
                'user_id' => $user->id,
                'relevant_experience' => $relevant,
                'experience' => $job_experience,
                'date_created' => $date_created,
                );

            $i = $this->reg->RegisterExperience($data);
            if($i)
            {
                $user_ip = $this->UserIp();
                $aData = array(
                    'user_id' => $user->id,
                    'ip' => $user_ip,
                    'actions' => trans('app_lang.job_experienced'),
                    'date_created' => $date_created
                );

                $sData = array('stage_id' => 5);

                $uData = array('status' => 5);
                
                $this->site->TrackActivities($aData);
                $this->site->UpdateTrackStages($user->id, $sData);
                $this->site->UpdateUser($user->id, $uData);
                return redirect('/auth/freelancer');
            }
            else
            {
                 \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.experience_not_success'));
                 return redirect('/auth/job_experience');
            }
        }
    }

    function job_freelanced(Request $request)
    {
        if(!session()->get('user') || !session()->get('pick_job'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }

        $post=$request->all();
        $v = \Validator::make($request->all(),

            [
                'freelancer' => 'required',
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $freelancer = $post['freelancer'];
            $potfolio_url = $post['potfolio_url'];
            $user = session()->get('user');
            $date_created = date('Y-m-d H:i:s');

            $data = array(
                'user_id' => $user->id,
                'freelancer' => $freelancer,
                'portfolio_url' => $potfolio_url,
                'date_created' => $date_created,
                );

            $i = $this->reg->RegisterPortfolio($data);
            if($i)
            {
                $user_ip = $this->UserIp();
                $aData = array(
                    'user_id' => $user->id,
                    'ip' => $user_ip,
                    'actions' => trans('app_lang.job_freelanced'),
                    'date_created' => $date_created
                );

                $sData = array('stage_id' => 6);

                $uData = array('status' => 6);
                
                $this->site->TrackActivities($aData);
                $this->site->UpdateTrackStages($user->id, $sData);
                $this->site->UpdateUser($user->id, $uData);
                return redirect('/auth/wait_approval');
            }
            else
            {
                 \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.freelance_not_success'));
                 return redirect('/auth/freelancer');
            }
        }
    }

    function finished(Request $request)
    {
        if(!session()->get('user') || !session()->get('pick_job'))
        {
            \Session::flash('error','<strong>Error:</strong>!<br />' . trans('app_lang.access_denied'));
            return redirect('/auth/login');
        }

        $post=$request->all();
        $v = \Validator::make($request->all(),

            [
                'agree' => 'required',
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $user = session()->get('user');
            $date_created = date('Y-m-d H:i:s');
                
            $user_ip = $this->UserIp();
            $aData = array(
                'user_id' => $user->id,
                'ip' => $user_ip,
                'actions' => trans('app_lang.approval_finish'),
                'date_created' => $date_created
            );

            $sData = array('stage_id' => 7);

            $uData = array('status' => 7);
                
            $this->site->TrackActivities($aData);
            $this->site->UpdateTrackStages($user->id, $sData);
            $this->site->UpdateUser($user->id, $uData);
            return redirect('/auth/completed');
        }
    }
}
