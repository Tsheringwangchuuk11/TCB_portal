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
        $data['report_types'] = Dropdown::getDropdowns('t_admin_report_types','id','report_type','0','0');
        return view('public_reports.reports', $data);
    }

    public function ajaxReports(Request $request)
    {
        $reportTypeId=$request->report_type_id;
        $reportType= PublicReport::getReportName($reportTypeId);
        if($request->report_type_id==1){
            $getReport = PublicReport::getArrivalByModeOfTransporteports();
        }
        elseif($request->report_type_id==3){
            $getReport = PublicReport::ALoSByPurpose();
        }
        elseif($request->report_type_id==4){
            $getReport = PublicReport::getVisitorsByNights();
        }
        elseif($request->report_type_id==5){
            $getReport = PublicReport::getArrivalByModeOfTransporteportsByMonth();
        }
        elseif($request->report_type_id==7){
            $getReport = PublicReport::getALoSByMajorMarkets();
        }
        elseif($request->report_type_id==8){
            $getReport = PublicReport::getVDSByMajorMarkets();
        }
        elseif($request->report_type_id==9){
            $getReport = PublicReport::getMajorMarketsByMainPurpose();
        }
        elseif($request->report_type_id==10){
            $getReport = PublicReport::getVisitorbyGlobalSegmentationbyGender();
        }
        $chartArray["chart"] = [
            "type" => 'column',
            'plotBackgroundColor' => NULL,
            'plotBorderWidth'=> NULL,
            'plotShadow'=> false
            ] ;

        $chartArray["title"] =[
            "text" => $reportType->report_type
            ];
            $chartArray["subtitle"]= [
                "text"=> 'Source: TCB & DOI'
            ];
        $chartArray["tooltip"] = [
            'headerFormat'=>'<span style="font-size:10px">{point.key}</span><table>',
            'pointFormat'=>'<tr><td style="color:{series.color};padding:0">{series.name}: </td>
            <td style="padding:0"><b>{point.y} </b></td></tr>',
            'footerFormat'=> '</table>',
            'shared'=>true,
            'useHTML'=> true         
        ];
        $chartArray["plotOptions"] =[
            'column' =>[
                'pointPadding'=> 0.2,
                'borderWidth'=> 0
            ]
        ];
        if($request->report_type_id==5){
            $month=[];
            foreach($getReport as $key=>$value){
                $month[] = $value->MonthEn; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$month
            ];
        }
        elseif($request->report_type_id==7 || $request->report_type_id==8 || $request->report_type_id==9 || $request->report_type_id==10){
            $region=[];
            foreach($getReport as $key=>$value){
                $region[] = $value->Region; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$region
            ];
        }
        else{
            $mainPurpose=[];
            foreach($getReport as $key=>$value){
                $mainPurpose[] = $value->MainPurpose; 
              }
            $chartArray["xAxis"]=[
                'categories'=>$mainPurpose
            ];
        }
       
if($request->report_type_id==1){
    
        $arrivalByAir=[];
        $arrivalByland=[];
        foreach($getReport as $key=>$value){
            $arrivalByAir[] = $value->air; 
            }
        foreach($getReport as $key=>$value){
            $arrivalByland[] = $value->land; 
            }
        $chartArray["series"] = [
            [
                'name' =>'Land',
                'data'=>$arrivalByland
            ],
           [
                'name'=> 'Air',
                'data'=> $arrivalByAir
           ]
    ];
}
elseif($request->report_type_id==4 || $request->report_type_id==8){
    $one_two_night=[];
    $three_four_nights=[];
    $five_six_nights=[];
    $seven_eight_nights=[];
    $nine_fourteen_nights=[];
    $fiveteennights=[];
    foreach($getReport as $key=>$value){
        $one_two_night[] = $value->one_two_nights; 
        }
     foreach($getReport as $key=>$value){
        $three_four_nights[] = $value->three_four_nights; 
        }
    foreach($getReport as $key=>$value){
        $five_six_nights[] = $value->five_six_nights; 
        }
    foreach($getReport as $key=>$value){
        $seven_eight_nights[] = $value->seven_eight_nights; 
        }
    foreach($getReport as $key=>$value){
        $nine_fourteen_nights[] = $value->nine_fourteen_nights; 
        }
    foreach($getReport as $key=>$value){
        $fiveteennights[] = $value->fiveteennights; 
        }
    $chartArray["series"] = [
         [
            'name'=> '3_4nights',
            'data'=>  $three_four_nights
        ],
        [
            'name'=> '5_6nights',
            'data'=> $five_six_nights
        ],
        [
            'name'=> '7_8nights',
            'data'=> $seven_eight_nights
        ],
        [
            'name'=> '9_14nights',
            'data'=> $nine_fourteen_nights
        ],
        [
            'name'=> '15nights',
            'data'=> $fiveteennights
        ]
    ];
}
elseif($request->report_type_id==3){
    $visitors=[];
    $visitors_nights=[];
    $median_night=[];
    $mean_night=[];

    foreach($getReport as $key=>$value){
        $visitors[] = $value->visitors; 
        }
    foreach($getReport as $key=>$value){
        $visitors_nights[] = $value->visitors_nights; 
        }
    foreach($getReport as $key=>$value){
        $median_night[] = $value->median_night; 
        }
    foreach($getReport as $key=>$value){
        $mean_night[] = $value->mean_night; 
        }
    $chartArray["series"] = [
        [
            'name' =>'Visitors',
            'data'=>$visitors
        ],
        [
            'name'=> 'Visitors Nights',
            'data'=> $visitors_nights
        ],
        [
            'name'=> 'Median Night',
            'data'=> $median_night
        ],
        [
            'name'=> 'Mean Night',
            'data'=> $mean_night
        ]
     ];
}

elseif($request->report_type_id==5){
    $arrivalByAir=[];
    $arrivalByland=[];
    $total=[];

    foreach($getReport as $key=>$value){
        $arrivalByAir[] = $value->air; 
        }
    foreach($getReport as $key=>$value){
        $arrivalByland[] = $value->land; 
        }
    foreach($getReport as $key=>$value){
        $total[] = $value->total; 
        }
    $chartArray["series"] = [
        [
            'name' =>'Land',
            'data'=>$arrivalByland
        ], 
        [
            'name'=> 'Air',
            'data'=> $arrivalByAir
        ],
        [
            'name'=> 'Total',
            'data'=> $total
        ]
     ];
}
elseif($request->report_type_id==7){
    $mean=[];
    $median=[];

    foreach($getReport as $key=>$value){
        $mean[] = $value->mean; 
        }
    foreach($getReport as $key=>$value){
        $median[] = $value->median; 
        }
    $chartArray["series"] = [
        [
            'name' =>'Mean',
            'data'=>$mean
        ], 
        [
            'name'=> 'Median',
            'data'=> $median
        ]
     ];
    }
elseif($request->report_type_id==9){
    $Business=[];
    $ETE_Program=[];
    $HLR=[];
    $IT=[];
    $MICE=[];
    $Official=[];
    $Others=[];
    $VFRG=[];
    foreach($getReport as $key=>$value){
        $ETE_Program[] = $value->ETE_Program; 
        }
    foreach($getReport as $key=>$value){
        $Business[] = $value->Business; 
        }
    foreach($getReport as $key=>$value){
        $HLR[] = $value->HLR; 
        }
    foreach($getReport as $key=>$value){
        $IT[] = $value->IT; 
        }
    foreach($getReport as $key=>$value){
        $MICE[] = $value->MICE; 
        }
    foreach($getReport as $key=>$value){
        $Official[] = $value->Official; 
        }
    foreach($getReport as $key=>$value){
        $Others[] = $value->Others; 
        }
    foreach($getReport as $key=>$value){
        $VFRG[] = $value->VFRG; 
        }
    $chartArray["series"] = [
        [
            'name' =>'Business',
            'data'=>$Business
        ], 
        [
            'name'=> 'Education/Training/Exchange program',
            'data'=> $ETE_Program
        ],
        [
            'name'=> 'Holiday, Leisure and Recreation',
            'data'=> $HLR
        ],
        [
            'name'=> 'Incentives travel(FAM, Tour leader',
            'data'=> $IT,
        ],
        [
            'name'=> 'MICE',
            'data'=> $MICE,
        ],
        [
            'name'=> 'Official',
            'data'=> $Official,
        ],
        [
            'name'=> 'Others',
            'data'=> $Others,
        ],
        [
            'name'=> 'Visiting friends and relatives/guest',
            'data'=> $VFRG,
        ]
    ];
}
elseif($request->report_type_id==10){
    
    $male=[];
    $female=[];
    $total=[];
    foreach($getReport as $key=>$value){
        $male[] = $value->Male; 
        }
    foreach($getReport as $key=>$value){
        $female[] = $value->Female; 
        }
    foreach($getReport as $key=>$value){
        $total[] = $value->Total; 
        }
    $chartArray["series"] = [
        [
            'name' =>'Male',
            'data'=>$male
        ],
       [
            'name'=> 'Female',
            'data'=> $female
       ],
       [
            'name'=> 'Total',
            'data'=> $total
        ]
    ];
}
        
        return response()->json($chartArray)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
}
