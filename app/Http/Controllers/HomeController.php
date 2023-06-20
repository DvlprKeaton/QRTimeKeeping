<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserRole;

use DateTime;
use DB;
use Carbon\Carbon;
use Config;
use Symfony\Component\Console\Input\Input;
use DatePeriod;
use DateInterval;
use Carbon\CarbonPeriod;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::whereNull('emp_no')->get();
        $userrole = $this->getUserRole(Auth::user()->id);

        return view('home')
            ->with('userrole',$userrole)
            ->with('users',$users);
    }

    public function getUserRole($uid)
    {
        $retval = array();
        set_time_limit(0);
        $ret = DB::select("
        SELECT r.id, ur.role
        FROM user_role ur, users r
        WHERE ur.user_id = $uid
        ");
        foreach ($ret as $r) {
            $retval['id']   = $r->id;
            $retval['role'] = $r->role;
        }

        if (count($retval) == 0) {
             UserRole::create([
            'user_id' => $uid,
            'role' => 'Employee'
            ]);

             $ret = DB::select("
            SELECT r.id, ur.role
            FROM user_role ur, users r
            WHERE ur.user_id = $uid
            ");
            foreach ($ret as $r) {
                $retval['id']   = $r->id;
                $retval['role'] = $r->role;
            }

            return $retval;
        }
        
        return $retval;
    }

}
