<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TimeTable;
use App\Models\Attendees;

use Auth;
use DateTime;
use DB;
use Carbon\Carbon;
use Config;
use Symfony\Component\Console\Input\Input;
use DatePeriod;
use DateInterval;
use Carbon\CarbonPeriod;


class QrCodeController extends Controller
{
    public function index(Request $request)
    {
      $id = $request->id;

      $selectedUser = User::find($id);
      return view('qrcode.qrgenerate')
            ->with('selectedUser',$selectedUser);
    }

    public function scan(Request $request)
    {
      
      return view('qrcode.qrscan');
    }

    public function results(Request $request)
    {
      $qr = $request->qr_code;
      
      $selectedUser = User::find($qr)->get('id');
      
      $mytime = Carbon::now('GMT+8')->toDateTimeString();
      
      $id = DB::select("
                SELECT id
                FROM users
                WHERE id = $qr");
      foreach($id as $id){
        $uid = $id->id;
      }
      
      $timetable = DB::select("
                SELECT *
                FROM timetable
                WHERE user_id = $uid");
      if ($qr == $uid) {
        if (count($timetable) == 0) {
            TimeTable::create([
            'user_id' => $qr,
            'scanned_by' => Auth::user()->id,
            'time_in' => $mytime
            ]);

            return response()->json([
                'status' => 200,
                'selectedUser' => $uid,
            ]);
        }else{
            return response()->json([
                'status' => 600,
                'selectedUser' => $uid,
            ]);
        }
          
      }else{
         return response()->json([
                'status' => 400,
                'selectedUser' => $uid,
            ]);
      }

      
    }

    public function success()
    {

      $latest = DB::select("
                SELECT user_id
                FROM timetable 
                WHERE id=(SELECT max(id) FROM timetable)");
      $uid = $latest[0]->user_id;
      $id = DB::select("
                SELECT name
                FROM users
                WHERE id = $uid");

      Attendees::where('user_id', $uid)
       ->update([
           'attend' => 0
        ]);

      return view('qrcode.qrsuccess')
                ->with('uname',$id);
    }

    public function scanned(Request $request)
    {
      return view('qrcode.qrscanned');
    }

    public function failed(Request $request)
    {
      return view('qrcode.qrfailed');
    }

    public function terms(Request $request)
    {
      return view('terms');
    }

    public function termsconfirm(Request $request)
    {
         $uid = Auth::user()->id;
      User::where('id', $uid)
       ->update([
           'terms_confirm' => 1
        ]);

       $checkAttendees = DB::select("
                    SELECT * 
                    FROM attendees
                    WHERE user_id = $uid");

        $user = DB::select("
            SELECT *
            FROM users
            WHERE terms_confirm = 1 AND id = $uid");

      return view('qrcode.qrpersonal')
             ->with('checkAttendees', $checkAttendees)
             ->with('user', $user);
    }

    public function personal(Request $request)
    {
        $uid = Auth::user()->id;
    $checkAttendees = DB::select("
                    SELECT * 
                    FROM attendees
                    WHERE user_id = $uid");
     $user = DB::select("
            SELECT *
            FROM users
            WHERE terms_confirm = 1 AND id = $uid");

      return view('qrcode.qrpersonal')
            ->with('checkAttendees', $checkAttendees)
            ->with('user', $user);
    }

    public function attend()
    {
        
        $uid = Auth::user()->id;

        User::where('id', $uid)
       ->update([
           'terms_confirm' => 1
        ]);


        $checkAttendees = DB::select("
                    SELECT * 
                    FROM attendees
                    WHERE user_id = $uid");

        $mytime = date('m/d/Y H:i', time());
        if (count($checkAttendees) == 0) {
             Attendees::create([
            'user_id' => $uid,
            'attend' => 1,
            'confirmed_at' => $mytime
            ]);
        }
       
      return redirect('qrpersonal')
            ->with('checkAttendees', $checkAttendees);
    }

    public function timetable()
    {
        //$users = TimeTable::orderBy('user_id','desc')->get();

        $users = DB::select("
                        SELECT *
                        FROM timetable tt, users r
                        WHERE r.id = tt.user_id");
        $userrole = $this->getUserRole(Auth::user()->id);
        
        return view('timetable.index')
            ->with('userrole',$userrole)
            ->with('users',$users);
    }

    public function attendees()
    {

        $users = DB::select("
                        SELECT *
                        FROM attendees tt, users r
                        WHERE r.id = tt.user_id  AND tt.attend = 1");
        $userrole = $this->getUserRole(Auth::user()->id);
        
        return view('qrcode.qrattendees')
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
