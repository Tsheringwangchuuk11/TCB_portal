<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\User;
use App\Models\Services;


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
    public function getDashboard()
    {
        $roles = auth()->user()->roles->pluck('id')->toArray();
        if (in_array(1, $roles)) { // role check
        $approvedApplication=Services::getTotalApprovedApplication();
        $rejectApplication=Services::getTotalRejectApplication();
        $totalApplication= $approvedApplication[0]->totalcount +  $rejectApplication[0]->totalreject;

        $chartArray["chart"] = array("type" => 'pie','plotBackgroundColor' => NULL,'plotBorderWidth'=> NULL,'plotShadow'=> false );
        $chartArray["title"] = array("text" => 'Application Summary Report');
        $chartArray["tooltip"] = array("pointFormat" => '{series.name}: {point.y}');
        $chartArray["credits"] = array("enabled" => false);
        $chartArray["plotOptions"] = array(
            'pie' =>array(
                'allowPointSelect'=> true,
                'cursor'=>'pointer',
                'dataLabels'=>array(
                    'enabled'=>true,
                    'format'=> '{point.name}: {point.y} ',
                    'style'=>array(
                        'color'=>"(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black' "
                        )
                    ),
                'showInLegend'=> true
                )
            );
       $applicationdata=[];
       $applicationdataArray= [];
        foreach($approvedApplication as $key=>$value){
            $applicationdata["name"] = "Total Application Approved";
            $applicationdata["y"] = $value->totalcount;
            array_push($applicationdataArray, $applicationdata);
              }
              foreach($rejectApplication as $key=>$value){
                $applicationdata["name"] = "Total Application Rejected";
                $applicationdata["y"] = $value->totalreject;
                array_push($applicationdataArray, $applicationdata);
                  }
                $applicationdata["name"] = "Total Application";
                $applicationdata["y"] =  $totalApplication;
                array_push($applicationdataArray, $applicationdata);

            $chartArray["series"] = array(
            array(
                "name" => 'Application',
                "colorByPoint" => true,
                "data" => $applicationdataArray
                )
            );
           return view('dashboards.admin')->with('chartArray', $chartArray);
        }
        elseif( in_array(3, $roles) || in_array(4, $roles) || in_array(5, $roles) || in_array(6, $roles) || in_array(7, $roles) || in_array(8, $roles)) { // role check
            $roles = auth()->user()->roles->pluck('id');
            $summarydata=Services::getApplicationSummaryData($roles[0]);
            $chartArray["chart"] = array("type" => 'pie','plotBackgroundColor' => NULL,'plotBorderWidth'=> NULL,'plotShadow'=> false );
            $chartArray["title"] = array("text" => 'Application Summary Report');
            $chartArray["tooltip"] = array("pointFormat" => '{series.name}: {point.y}');
            $chartArray["credits"] = array("enabled" => false);
            $chartArray["plotOptions"] = array(
                'pie' =>array(
                    'allowPointSelect'=> true,
                    'cursor'=>'pointer',
                    'dataLabels'=>array(
                        'enabled'=>true,
                        'format'=> '{point.name}: {point.y} ',
                        'style'=>array(
                            'color'=>"(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black' "
                            )
                        ),
                    'showInLegend'=> true
                    )
                );
           $applicationdata=[];
           $applicationdataArray= [];
            foreach($summarydata as $key=>$value){
                $applicationdata["name"] = "Total Application Approved";
                $applicationdata["y"] = $value->totalapproved;
                array_push($applicationdataArray, $applicationdata);
                  }
                  foreach($summarydata as $key=>$value){
                    $applicationdata["name"] = "Total Application Rejected";
                    $applicationdata["y"] = $value->totalrejected;
                    array_push($applicationdataArray, $applicationdata);
                      }
                    foreach($summarydata as $key=>$value){
                    $applicationdata["name"] = "Total Application";
                    $applicationdata["y"] = $value->totalapplication;
                    array_push($applicationdataArray, $applicationdata);
                      }

                $chartArray["series"] = array(
                array(
                    "name" => 'Application',
                    "colorByPoint" => true,
                    "data" => $applicationdataArray
                    )
                );
               return view('dashboards.divisionuser')->with('chartArray', $chartArray);
        }
        $userId = auth()->user()->id;
        $endUserApplicantDtls = WorkFlowDetails::getEndUserApplicationDtls($userId);
        return view('dashboards.enduser', compact('endUserApplicantDtls'));
    }
    public function getApplicationDetails()
    {
       // $endUserApplicantDtls = WorkFlowDetails::getEndUserApplicationDtls($userId);
        return view('dashboards.public');
    }


    public function getProfile(Request $request)
    {
        $user = auth()->user();
        $userLogs = $user->userLogs()->orderBy('created_at', 'desc')->paginate(5);

        return view('profile', compact('user', 'userLogs'));
    }

    public function getChangePassword()
    {
        return view('system-settings.change-password');
    }

    public function postChangePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];
        $this->validate($request, $rules);
    	if(\Hash::check($request->input('old_password'), $request->user()->password)){
			$request->user()->update([
                'password' => bcrypt($request->input('new_password'))
            ]);
            return redirect('change-password')->with('msg_success', 'Password Successfully updated');
		}
		return redirect('change-password')->with('msg_error', 'Your old password did not match our records');
    }
    
    public function getBasicStandardLists(Request $request){
        $condition = $request->condition;
        $basicStandardLists = Dropdown::getBasicStandards($condition);
        return response()->json($basicStandardLists);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->save();
        return redirect('profile')->with('msg_success', 'your details updated successfully');
    }
 }
