<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Dropdown;
use App\PublicReport;
use Illuminate\Http\Request;


class PublicReportController extends Controller
{
    public function index()
    {
        $data['sort_type'] = Dropdown::getDropdowns('t_admin_sort_type','sort_id','sort_name','0','0');
        $data['regions'] = Dropdown::getDropdowns('t_admin_region_type','region_id','region','0','0');
        return view('public_reports.reports', $data);
    }

    public function ajaxReports(Request $request)
    {
        $X_Name="Name";
        $getReport = PublicReport::getReports($request);
        $y1_total=0;
        $y2_total=0;
        //in tabular formate
        $data="<div class='dataTable_wrapper'>";
        $data.="<table class='table table-striped table-bordered' id='Tables2'>";
        $data.="<thead><tr><th>". $X_Name."</th> <th>Male</th> <th>Female</th> <th>Total</th></tr></thead><tbody>";
        foreach ($getReport as $key):
            $data.="<tr class='odd gradeX'> <td>".$key->x_column."</td> <td>".number_format((int)$key->y1_column)."</td> <td>".number_format((int)$key->y2_column)."</td> <td>".number_format((int)($key->y1_column+$key->y2_column))."</td> </tr>";
            $y1_total+=$key->y1_column;
            $y2_total+=$key->y2_column;
        endforeach;
        $data.="</tbody>";
        $data.="<tfoot><tr>";
        $data.="<td><strong> Total </strong></td>";
        $data.="<td style='font-weight:bold; text-align:center;'>".number_format((int)$y1_total)."</td>";
        $data.="<td style='font-weight:bold; text-align:center;'>".number_format((int)$y2_total)."</td>";
        $data.="<td style='font-weight:bold; text-align:center;'>".number_format((int)($y1_total+$y2_total))."</td>";
        $data.="</tr></tfoot>";
        $data.="</table></div>";
        echo $data; exit;
    }
}
