<?php

namespace App\Http\Controllers\EndUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\User;

class EnduserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:oauth');
    }

    public function getApplicationDetails()
    {

        $userId = auth()->user()->user_id;
        $endUserApplicantDtls = WorkFlowDetails::getEndUserApplicationDtls($userId);
        return view('dashboards.public',compact('endUserApplicantDtls'));
    }
}
