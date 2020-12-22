<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Dropdown;
use App\PublicReport;
use Illuminate\Http\Request;


class PublicReportController extends Controller
{
    public function index($id)
    {   
        $data['report_types'] = Dropdown::getDropdowns('t_report_types','report_type_id','report_type','0','0');
        return view('public_reports.reports', $data, compact('id'));
    }

    public function ajaxReports(Request $request)
    {
        //get report content
        $reportname= PublicReport::getReportName($request->report_name_id);
        $data=null;
        $reportdata= PublicReport::getReportContent($request->report_type_id,$request->report_category_id,$request->report_name_id,$request->year);
        if($reportdata){
            //Arrival by mode of transport by purpose(number of visitors)
            if($request->report_name_id==1){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =["text" => $reportname->report_name];
                $chartArray["subtitle"]= ["text"=> 'Source: TCB & DOI'];
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
                $arrivalByAir=[];
                $arrivalByland=[];
                foreach($reportdata as $key=>$value){
                    $arrivalByAir[] = str_replace( ',', '', $value->air); 
                    $arrivalByland[] = str_replace( ',', '', $value->land);

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

            //Monthly AloS by Purpose
            else if($request->report_name_id==2){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =["text" => $reportname->report_name];
                $chartArray["subtitle"]= ["text"=> 'Source: TCB & DOI'];
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
                $mainPurpose=[];
                $mainpurpose=[];
                $january=[];
                $febuary=[];
                $march=[];
                $april=[];
                $may=[];
                $june=[];
                $july=[];
                $august=[];
                $september=[];
                $october=[];
                $november=[];
                $december=[];
                foreach($reportdata as $key=>$value){
                    $mainPurpose[] = $value->MainPurpose; 
                    $mainpurpose[] = $value->MainPurpose; 
                    if( $value->Jan!=null){
                        $january[] = $value->Jan; 
                    }else{
                        $january[] = 0; 
                    }
                    if($value->Feb!=null){
                        $febuary[] = $value->Feb;
                        }else{
                            $febuary[] = 0;
                        } 
                    if($value->Feb!=null){
                        $march[] = $value->Mar; 
                    }else{
                        $march[] = 0; 
                    }
                    if($value->Apr!=null){
                        $april[] = $value->Apr;
                    }else{
                        $april[] = 0;
                    }
                    if($value->May!=null){
                        $may[] = $value->May; 
                    }else{
                        $may[] = 0; 
                    }
                    if($value->Jun!=null){
                        $june[] = $value->Jun; 
        
                    }else{
                        $june[] = 0; 
                    }
                    if($value->Jul!=null){
                        $july[] = $value->Jul;
                    }else{
                        $july[] = 0;
                    } 
                    if($value->Aug!=null){
                        $august[] = $value->Aug;
                    }else{
                        $august[] =0;
                    } 
                    
                    if($value->Sep!=null){
                        $september[] = $value->Sep;    
                    }else{
                        $september[] = $value->Sep;
                    }        
                    if($value->Octo!=null){
                        $october[] = $value->Octo;    
                    }else{
                        $october[] = 0;
                    }        
        
                    if($value->Nov!=null){
                        $november[] = $value->Nov;    
                    }else{
                        $november[] = $value->Nov;
                    }
                    if($value->Dece!=null){
                        $december[] = $value->Dece; 
                    }else{
                        $december[] = 0; 
                    }
                }
                $chartArray["xAxis"]=[
                    'categories'=>$mainPurpose
                ]; 
                $chartArray["series"] = [
                    [
                        'name' =>'Jan',
                        'data'=>$january
                    ],
                    [
                            'name'=> 'Feb',
                            'data'=> $febuary
                    ],
                    [
                        'name'=> 'Mar',
                        'data'=> $march
                    ],
                    [
                        'name'=> 'Apr',
                        'data'=> $april
                    ],
                    [
                        'name'=> 'May',
                        'data'=> $may
                    ],
                    [
                        'name'=> 'Jun',
                        'data'=> $june
                    ],
                    [
                        'name'=> 'Jul',
                        'data'=> $july
                    ],
                    [
                        'name'=> 'Aug',
                        'data'=> $august
                    ],
                    [
                        'name'=> 'Sep',
                        'data'=> $september
                    ],
                    [
                        'name'=> 'Oct',
                        'data'=> $october
                    ],
                    [
                        'name'=> 'Nov',
                        'data'=> $november
                    ],
                    [
                        'name'=> 'Dec',
                        'data'=> $december
                        ]
                    ];
            }
            //AloS by purpose
            else if($request->report_name_id==3){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
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
                $mainPurpose=[];
                $visitors=[];
                $visitors_nights=[];
                $median_night=[];
                $mean_night=[];
                foreach($reportdata as $key=>$value){
                    $mainPurpose[] = $value->MainPurpose; 
                    $visitors[] = $value->visitors;
                    $visitors_nights[] = $value->visitors_nights; 
                    $median_night[] = $value->median_night; 
                    $mean_night[] = $value->mean_night;  
                }
                $chartArray["xAxis"]=[
                    'categories'=>$mainPurpose
                ];
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

            //Visitor nights by Purpose in Numbers
            else if($request->report_name_id==4){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
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
                $mainPurpose=[];
                $one_two_night=[];
                $three_four_nights=[];
                $five_six_nights=[];
                $seven_eight_nights=[];
                $nine_fourteen_nights=[];
                $fiveteennights=[];
                foreach($reportdata as $key=>$value){
                    $mainPurpose[] = $value->MainPurpose; 
                    $one_two_night[] = $value->one_two_nights; 
                    $three_four_nights[] = $value->three_four_nights; 
                    $five_six_nights[] = $value->five_six_nights; 
                    $seven_eight_nights[] = $value->seven_eight_nights; 
                    $nine_fourteen_nights[] = $value->nine_fourteen_nights; 
                    $fiveteennights[] = $value->fiveteennights; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$mainPurpose
                ];
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

            //Monthly Arrivals by mode of Transport(Numbers of persons)	
            else if($request->report_name_id==5){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
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
                $month=[];
                $arrivalByAir=[];
                $arrivalByland=[];
                $total=[];
                foreach($reportdata as $key=>$value){
                    $month[] = $value->MonthEn; 
                    $arrivalByAir[] = $value->air; 
                    $arrivalByland[] = $value->land; 
                    $total[] = $value->total; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$month
                ];
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

            //Visitors by duration of stay by major markets
            else if($request->report_name_id==6){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
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

                $region=[];
                $mean=[];
                $median=[];
                foreach($reportdata as $key=>$value){
                    $region[] = $value->Region; 
                    $mean[] = $value->mean; 
                    $median[] = $value->median; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$region
                ];
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
		//Visitors by duration of stay by major markets
        else if($request->report_name_id==7){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
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
                $region=[];
                $one_two_night=[];
                $three_four_nights=[];
                $five_six_nights=[];
                $seven_eight_nights=[];
                $nine_fourteen_nights=[];
                $fiveteennights=[];
                foreach($reportdata as $key=>$value){
                    $region[] = $value->Region; 
                    $one_two_night[] = $value->one_two_nights; 
                    $three_four_nights[] = $value->three_four_nights; 
                    $five_six_nights[] = $value->five_six_nights; 
                    $seven_eight_nights[] = $value->seven_eight_nights; 
                    $nine_fourteen_nights[] = $value->nine_fourteen_nights; 
                    $fiveteennights[] = $value->fiveteennights; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$region
                ];
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
		   //Major markets by main purpose
            else if($request->report_name_id==8){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
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
                $region=[];
                $Business=[];
                $ETE_Program=[];
                $HLR=[];
                $IT=[];
                $MICE=[];
                $Official=[];
                $Others=[];
                $VFRG=[];
                foreach($reportdata as $key=>$value){
                    $region[] = $value->Region;
                    $ETE_Program[] = $value->ETE_Program; 
                    $Business[] = $value->Business; 
                    $HLR[] = $value->HLR; 
                    $IT[] = $value->IT; 
                    $MICE[] = $value->MICE; 
                    $Official[] = $value->Official; 
                    $Others[] = $value->Others; 
                    $VFRG[] = $value->VFRG;  
                }
                $chartArray["xAxis"]=[
                    'categories'=>$region
                ];
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

            //Visitor by Global Segmentation by Gender
            else if($request->report_name_id==9){
                $chartArray["chart"] = [
                    "type" => 'column',
                    'plotBackgroundColor' => NULL,
                    'plotBorderWidth'=> NULL,
                    'plotShadow'=> false
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
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
                $region=[];
                $male=[];
                $female=[];
                $total=[];
                foreach($reportdata as $key=>$value){
                    $region[] = $value->Region; 
                    $male[] = $value->Male; 
                    $female[] = $value->Female; 
                    $total[] = $value->Total; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$region
                ];
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
			 //Overnight visitors by purpose by Dzongkhag visited
             else if($request->report_name_id==10){
                $chartArray["chart"] = [
                    "type" => 'bar',
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
                    ];
                $chartArray["subtitle"]= [
                    "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
                ];
                $chartArray["tooltip"] = [
                    'split'=> true,
                ]; 
                $chartArray["yAxis"]=[
                    'min'=>0,
                    'title'=> [
                    'text'=>'Dzongkhag'
                    ],
                    'legend'=> [
                        'reversed'=>true
                    ],
                ];
                $chartArray["plotOptions"] =[
                    'series'=> [
                        'stacking'=> 'normal'
                    ]
                ];
                $dzongkhag=[];
                $business=[];
                $education=[];
                $health=[];
                $holiday=[];
                $others=[];
                $personal=[];
                $religion=[];
                $visiting=[];
                foreach($reportdata as $key=>$value){
                    $dzongkhag[] = $value->dzongkhag_name; 
                    $business[] = $value->business; 
                    $education[] = $value->education; 
                    $health[] = $value->health; 
                    $holiday[] = $value->holiday; 
                    $others[] = $value->others; 
                    $personal[] = $value->personal; 
                    $religion[] = $value->religion; 
                    $visiting[] = $value->visiting; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$dzongkhag
                ];
                $chartArray["series"] = [
                    [
                        'name' =>'Business and Professional',
                        'data'=>$business
                    ],
                    [
                        'name'=> 'Education and Training',
                        'data'=> $education
                    ],
                    [
                        'name'=> 'Health and Medical care',
                        'data'=> $health
                    ],
                    [
                        'name'=> 'Holiday/Leisure/Recreation',
                        'data'=> $holiday
                    ],
                    [
                        'name'=> 'Others',
                        'data'=> $others
                    ],
                    [
                        'name'=> 'Personal Shopping',
                        'data'=> $personal
                    ],
                    [
                        'name'=> 'Religion/Pilgrimage',
                        'data'=> $religion
                    ],
                    [
                        'name'=> 'Visiting Friends and Relatives',
                        'data'=> $visiting
                    ]
                ];
            }
            //Visitors by destination and origin Dzongkhag(Number)
            else if($request->report_name_id==13){
                $chartArray["chart"] = [
                    "type" => 'bar',
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
                    ];
                $chartArray["subtitle"]= [
                    "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
                ];
                $chartArray["tooltip"] = [
                    'split'=> true,
                ]; 
                $chartArray["yAxis"]=[
                    'min'=>0,
                    'title'=> [
                    'text'=>'Dzongkhag'
                    ],
                    'legend'=> [
                        'reversed'=>true
                    ],
                ];
                $chartArray["plotOptions"] =[
                    'series'=> [
                        'stacking'=> 'normal'
                    ]
                ];
                $dzongkhag=[];
                $bumthang=[];
                $chukha=[];
                $dagana=[];
                $gasa=[];
                $haa=[];
                $lhuentse=[];
                $mongar=[];
                $paro=[];
                $pemagatshel=[];
                $punakha=[];
                $samdrupjongkhar=[];
                $samtse=[];
                $sarpang=[];
                $thimphu=[];
                $trashigang=[];
                $trashiyangtse=[];
                $trongsa=[];
                $tsirang=[];
                $wangduephodrang=[];
                $zhemgang=[];
                foreach($reportdata as $key=>$value){
                    $dzongkhag[] = $value->dzongkhag_name;
                    $bumthang[] = $value->bumthang; 
                    $chukha[] = $value->chukha; 
                    $dagana[] = $value->dagana; 
                    $gasa[] = $value->gasa; 
                    $haa[] = $value->haa; 
                    $lhuentse[] = $value->lhuentse; 
                    $mongar[] = $value->mongar; 
                    $paro[] = $value->paro; 
                    $pemagatshel[] = $value->pemagatshel; 
                    $punakha[] = $value->punakha; 
                    $samdrupjongkhar[] = $value->samdrupjongkhar; 
                    $samtse[] = $value->samtse; 
                    $sarpang[] = $value->sarpang; 
                    $thimphu[] = $value->thimphu; 
                    $trashigang[] = $value->trashigang; 
                    $trashiyangtse[] = $value->trashiyangtse; 
                    $trongsa[] = $value->trongsa; 
                    $tsirang[] = $value->tsirang; 
                    $wangduephodrang[] = $value->wangduephodrang; 
                    $zhemgang[] = $value->zhemgang;  
                }
                $chartArray["xAxis"]=[
                    'categories'=>$dzongkhag
                ];
              
                   
                $chartArray["series"] = [
                    [
                        'name' =>'Bumthang',
                        'data'=>$bumthang
                    ],
                    [
                        'name'=> 'Chukha',
                        'data'=> $chukha
                    ],
                    [
                        'name'=> 'Dagana',
                        'data'=> $dagana
                    ],
                    [
                        'name'=> 'Gasa',
                        'data'=> $gasa,
                    ],
                    [
                        'name'=> 'Haa,',
                        'data'=> $haa,
                    ],
                    [
                        'name'=> 'Lhuentse',
                        'data'=> $lhuentse
                    ],
                    [
                        'name'=> 'Mongar',
                        'data'=> $mongar
                    ],
                    [
                        'name'=> 'Paro',
                        'data'=> $paro
                    ],
                    [
                        'name'=> 'Pemagatshel',
                        'data'=> $pemagatshel
                    ],
                    [
                        'name'=> 'Punakha',
                        'data'=> $punakha
                    ],
                    [
                        'name'=> 'Samdrupjongkhar',
                        'data'=> $samdrupjongkhar
                    ],
                    [
                        'name'=> 'Samtse',
                        'data'=> $samtse
                    ],
                    [
                        'name'=> 'Sarpang',
                        'data'=> $sarpang
                    ],
                    [
                        'name'=> 'Thimphu',
                        'data'=> $thimphu
                    ],
                    [
                        'name'=> 'Trashigang',
                        'data'=> $trashigang
                    ],
                    [
                        'name'=> 'Trashiyangtse',
                        'data'=> $trashiyangtse
                    ],
                    [
                        'name'=> 'Trongsa',
                        'data'=> $trongsa
                    ],
                    [
                        'name'=> 'Tsirang',
                        'data'=> $tsirang
                    ],
                    [
                        'name'=> 'Wangduephodrang',
                        'data'=> $wangduephodrang
                    ],
                    [
                        'name'=> 'Zhemgang',
                        'data'=> $zhemgang
                    ]
                 ];
            }

            //Visitor nights by destination and origin Dzongkhag
            else if($request->report_name_id==15){
                $chartArray["chart"] = [
                    "type" => 'bar',
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
                    ];
                $chartArray["subtitle"]= [
                    "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
                ];
                $chartArray["tooltip"] = [
                    'split'=> true,
                ]; 
                $chartArray["yAxis"]=[
                    'min'=>0,
                    'title'=> [
                    'text'=>'Dzongkhag'
                    ],
                    'legend'=> [
                        'reversed'=>true
                    ],
                ];
                $chartArray["plotOptions"] =[
                    'series'=> [
                        'stacking'=> 'normal'
                    ]
                ];
                $dzongkhag=[];
                $bumthang=[];
                $chukha=[];
                $dagana=[];
                $gasa=[];
                $haa=[];
                $lhuentse=[];
                $mongar=[];
                $paro=[];
                $pemagatshel=[];
                $punakha=[];
                $samdrupjongkhar=[];
                $samtse=[];
                $sarpang=[];
                $thimphu=[];
                $trashigang=[];
                $trashiyangtse=[];
                $trongsa=[];
                $tsirang=[];
                $wangduephodrang=[];
                $zhemgang=[];
                foreach($reportdata as $key=>$value){
                    $dzongkhag[] = $value->dzongkhag_name; 
                    $bumthang[] = $value->bumthang; 
                    $chukha[] = $value->chukha; 
                    $dagana[] = $value->dagana; 
                    $gasa[] = $value->gasa; 
                    $haa[] = $value->haa; 
                    $lhuentse[] = $value->lhuentse; 
                    $mongar[] = $value->mongar; 
                    $paro[] = $value->paro; 
                    $pemagatshel[] = $value->pemagatshel; 
                    $punakha[] = $value->punakha; 
                    $samdrupjongkhar[] = $value->samdrupjongkhar; 
                    $samtse[] = $value->samtse; 
                    $sarpang[] = $value->sarpang; 
                    $thimphu[] = $value->thimphu; 
                    $trashigang[] = $value->trashigang; 
                    $trashiyangtse[] = $value->trashiyangtse; 
                    $trongsa[] = $value->trongsa; 
                    $tsirang[] = $value->tsirang; 
                    $wangduephodrang[] = $value->wangduephodrang; 
                    $zhemgang[] = $value->zhemgang;
                }
                $chartArray["xAxis"]=[
                    'categories'=>$dzongkhag
                ];
               
                    
                $chartArray["series"] = [
                    [
                        'name' =>'Bumthang',
                        'data'=>$bumthang
                    ],
                    [
                        'name'=> 'Chukha',
                        'data'=> $chukha
                    ],
                    [
                        'name'=> 'Dagana',
                        'data'=> $dagana
                    ],
                    [
                        'name'=> 'Gasa',
                        'data'=> $gasa,
                    ],
                    [
                        'name'=> 'Haa,',
                        'data'=> $haa,
                    ],
                    [
                        'name'=> 'Lhuentse',
                        'data'=> $lhuentse
                    ],
                    [
                        'name'=> 'Mongar',
                        'data'=> $mongar
                    ],
                    [
                        'name'=> 'Paro',
                        'data'=> $paro
                    ],
                    [
                        'name'=> 'Pemagatshel',
                        'data'=> $pemagatshel
                    ],
                    [
                        'name'=> 'Punakha',
                        'data'=> $punakha
                    ],
                    [
                        'name'=> 'Samdrupjongkhar',
                        'data'=> $samdrupjongkhar
                    ],
                    [
                        'name'=> 'Samtse',
                        'data'=> $samtse
                    ],
                    [
                        'name'=> 'Sarpang',
                        'data'=> $sarpang
                    ],
                    [
                        'name'=> 'Thimphu',
                        'data'=> $thimphu
                    ],
                    [
                        'name'=> 'Trashigang',
                        'data'=> $trashigang
                    ],
                    [
                        'name'=> 'Trashiyangtse',
                        'data'=> $trashiyangtse
                    ],
                    [
                        'name'=> 'Trongsa',
                        'data'=> $trongsa
                    ],
                    [
                        'name'=> 'Tsirang',
                        'data'=> $tsirang
                    ],
                    [
                        'name'=> 'Wangduephodrang',
                        'data'=> $wangduephodrang
                    ],
                    [
                        'name'=> 'Zhemgang',
                        'data'=> $zhemgang
                    ]
                ];
            }
			//Visitor by purpose and Dzongkhag visited
             else if($request->report_name_id==19){
                $chartArray["chart"] = [
                    "type" => 'bar',
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
                    ];
                $chartArray["subtitle"]= [
                    "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
                ];
                $chartArray["tooltip"] = [
                    'split'=> true,
                ]; 
                $chartArray["yAxis"]=[
                    'min'=>0,
                    'title'=> [
                    'text'=>'Dzongkhag'
                    ],
                    'legend'=> [
                        'reversed'=>true
                    ],
                ];
                $chartArray["plotOptions"] =[
                    'series'=> [
                        'stacking'=> 'normal'
                    ]
                ];
                $dzongkhag=[];
                $business=[];
                $education=[];
                $health=[];
                $holiday=[];
                $others=[];
                $personal=[];
                $religion=[];
                $visiting=[];
                foreach($reportdata as $key=>$value){
                    $dzongkhag[] = $value->dzongkhag_name; 
                    $business[] = $value->business; 
                    $education[] = $value->education; 
                    $health[] = $value->health; 
                    $holiday[] = $value->holiday; 
                    $others[] = $value->others; 
                    $personal[] = $value->personal; 
                    $religion[] = $value->religion; 
                    $visiting[] = $value->visiting; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$dzongkhag
                ];
               
                    
                $chartArray["series"] = [
                    [
                        'name' =>'Business and Professional',
                        'data'=>$business
                    ],
                    [
                        'name'=> 'Education and Training',
                        'data'=> $education
                    ],
                    [
                        'name'=> 'Health and Medical care',
                        'data'=> $health
                    ],
                    [
                        'name'=> 'Holiday/Leisure/Recreation',
                        'data'=> $holiday
                    ],
                    [
                        'name'=> 'Others',
                        'data'=> $others
                    ],
                    [
                        'name'=> 'Personal Shopping',
                        'data'=> $personal
                    ],
                    [
                        'name'=> 'Religion/Pilgrimage',
                        'data'=> $religion
                    ],
                    [
                        'name'=> 'Visiting Friends and Relatives',
                        'data'=> $visiting
                    ]
                ];
            } 
			//Visitor,visitor nights and expenditure by Dzongkhag visited
            else if($request->report_name_id==24){
                $chartArray["chart"] = [
                    "type" => 'bar',
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
                    ];
                $chartArray["subtitle"]= [
                    "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
                ];
                $chartArray["tooltip"] = [
                    'split'=> true,
                ]; 
                $chartArray["yAxis"]=[
                    'min'=>0,
                    'title'=> [
                    'text'=>'Dzongkhag'
                    ],
                    'legend'=> [
                        'reversed'=>true
                    ],
                ];
                $chartArray["plotOptions"] =[
                    'series'=> [
                        'stacking'=> 'normal'
                    ]
                ];
                $dzongkhag=[];
                $visitors=[];
                $visitors_percent=[];
                $nights_percent=[];
                $avg_expenditure_night=[];
                $avg_expenditure_trip=[];
                $tot_expenditure=[];
                $nights=[];
                foreach($reportdata as $key=>$value){
                    $dzongkhag[] = $value->dzongkhag_name; 
                    $visitors[] = $value->visitors; 
                    $visitors_percent[] = $value->visitors_percent; 
                    $nights_percent[] = $value->nights_percent; 
                    $nights[] = $value->nights; 
                    $avg_expenditure_night[] = $value->avg_expenditure_night; 
                    $avg_expenditure_trip[] = $value->avg_expenditure_trip; 
                    $tot_expenditure[] = $value->tot_expenditure; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$dzongkhag
                ];
                $chartArray["series"] = [
                    [
                        'name' =>'Visitors',
                        'data'=>$visitors
                    ],
                    [
                        'name'=> 'Visitors Percent',
                        'data'=> $visitors_percent
                    ],
                    [
                        'name'=> 'Nights',
                        'data'=> $nights
                    ],
                    [
                        'name'=> 'Nights Percent',
                        'data'=> $nights_percent
                    ],
                    [
                        'name'=> 'Average Expenditure Per Night',
                        'data'=> $avg_expenditure_night
                    ],
                    [
                        'name'=> 'Average Expenditure Per Trip',
                        'data'=> $avg_expenditure_trip
                    ],
                    [
                        'name'=> 'Total Expenditure',
                        'data'=> $tot_expenditure
                    ]
                ];
            }

			//Total expenditure by purpose and expenditure item(in Nu.Million)
            else if($request->report_name_id==26){
                $chartArray["chart"] = [
                    "type" => 'bar',
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
                    ];
                $chartArray["subtitle"]= [
                    "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
                ];
                $chartArray["tooltip"] = [
                    'split'=> true,
                ]; 
                $chartArray["yAxis"]=[
                    'min'=>0,
                    'title'=> [
                    'text'=>'Total trip expenditure'
                    ],
                    'legend'=> [
                        'reversed'=>true
                    ],
                ];
                $chartArray["plotOptions"] =[
                    'series'=> [
                        'stacking'=> 'normal'
                    ]
                ];
                $mainpurpose=[];
                $accommodation=[];
                    $air=[];
                    $car_rental=[];
                    $entertainment=[];
                    $fuel_cost=[];
                    $food=[];
                    $local_transport=[];
                    $long_distance=[];
                    $medical=[];
                    $mice=[];
                    $others=[];
                    $shopping=[];
                    $tour_package=[];
                foreach($reportdata as $key=>$value){
                    if($value->dropdown_name!="Total"){
                        $mainpurpose[] = $value->dropdown_name; 
                    }
                    $accommodation[] = $value->accommodation; 
                    $air[] = $value->air; 
                    $car_rental[] = $value->car_rental; 
                    $entertainment[] = $value->entertainment; 
                    $fuel_cost[] = $value->fuel_cost; 
                    $food[] = $value->food; 
                    $local_transport[] = $value->local_transport; 
                    $long_distance[] = $value->long_distance; 
                    $medical[] = $value->medical; 
                    $mice[] = $value->mice; 
                    $others[] = $value->others; 
                    $shopping[] = $value->shopping; 
                    $tour_package[] = $value->tour_package;
                }
                        
                    $chartArray["series"] = [
                        [
                            'name' =>'Accommodation',
                            'data'=>$accommodation
                        ],
                        [
                            'name'=> 'Air fare',
                            'data'=> $air
                        ],
                        [
                            'name'=> 'Car Rental',
                            'data'=> $car_rental
                        ],
                        [
                            'name'=> 'Entertainment',
                            'data'=> $entertainment
                        ],
                        [
                            'name'=> 'Fuel Cost',
                            'data'=> $fuel_cost
                        ],
                        [
                            'name'=> 'Food and Beverages',
                            'data'=> $food
                        ],
                        [
                            'name'=> 'local Transportation',
                            'data'=> $local_transport
                        ],
                        [
                            'name'=> 'Long Distance Transportation',
                            'data'=> $long_distance
                        ],
                        [
                            'name'=> 'Medical and Treatment',
                            'data'=> $long_distance
                        ],
                        [
                            'name'=> 'MICE/Training fees/Workshop etc.',
                            'data'=> $mice
                        ],
                        [
                            'name'=> 'Others',
                            'data'=> $others
                        ],
                        [
                            'name'=> 'Shopping',
                            'data'=> $shopping
                        ],
                        [
                            'name'=> 'Tour Package',
                            'data'=> $tour_package
                        ],
                    ];
            }
            //Mean expenditure by purpose and expenditure item
            else if($request->report_name_id==27){
                $chartArray["chart"] = [
                    "type" => 'bar',
                    ] ;
                $chartArray["title"] =[
                    "text" => $reportname->report_name
                    ];
                $chartArray["subtitle"]= [
                    "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
                ];
                $chartArray["tooltip"] = [
                    'split'=> true,
                ]; 
                $chartArray["yAxis"]=[
                    'min'=>0,
                    'title'=> [
                    'text'=>'Average trip expenditure'
                    ],
                    'legend'=> [
                        'reversed'=>true
                    ],
                ];
                $chartArray["plotOptions"] =[
                    'series'=> [
                        'stacking'=> 'normal'
                    ]
                ];
                $mainpurpose=[];
                $accommodation=[];
                $air=[];
                $car_rental=[];
                $entertainment=[];
                $fuel_cost=[];
                $food=[];
                $local_transport=[];
                $long_distance=[];
                $medical=[];
                $mice=[];
                $others=[];
                $shopping=[];
                $tour_package=[];
                foreach($reportdata as $key=>$value){
                    if($value->dropdown_name!="Total"){
                        $mainpurpose[] = $value->dropdown_name; 
                    }
                    $accommodation[] = $value->accommodation; 
                    $air[] = $value->air; 
                    $car_rental[] = $value->car_rental; 
                    $entertainment[] = $value->entertainment; 
                    $fuel_cost[] = $value->fuel_cost; 
                    $food[] = $value->food; 
                    $local_transport[] = $value->local_transport; 
                    $long_distance[] = $value->long_distance; 
                    $medical[] = $value->medical; 
                    $mice[] = $value->mice; 
                    $others[] = $value->others; 
                    $shopping[] = $value->shopping; 
                    $tour_package[] = $value->tour_package; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$mainpurpose
                ];
                $chartArray["series"] = [
                    [
                        'name' =>'Accommodation',
                        'data'=>$accommodation
                    ],
                    [
                        'name'=> 'Air fare',
                        'data'=> $air
                    ],
                    [
                        'name'=> 'Car Rental',
                        'data'=> $car_rental
                    ],
                    [
                        'name'=> 'Entertainment',
                        'data'=> $entertainment
                    ],
                    [
                        'name'=> 'Fuel Cost',
                        'data'=> $fuel_cost
                    ],
                    [
                        'name'=> 'Food and Beverages',
                        'data'=> $food
                    ],
                    [
                        'name'=> 'local Transportation',
                        'data'=> $local_transport
                    ],
                    [
                        'name'=> 'Long Distance Transportation',
                        'data'=> $long_distance
                    ],
                    [
                        'name'=> 'Medical and Treatment',
                        'data'=> $long_distance
                    ],
                    [
                        'name'=> 'MICE/Training fees/Workshop etc.',
                        'data'=> $mice
                    ],
                    [
                        'name'=> 'Others',
                        'data'=> $others
                    ],
                    [
                        'name'=> 'Shopping',
                        'data'=> $shopping
                    ],
                    [
                        'name'=> 'Tour Package',
                        'data'=> $tour_package
                    ],
                ];
            }

            //Daytrip(excursion) visitors by Dzongkhag visited and sex
            else if($request->report_name_id==30){
                $chartArray["chart"]=[
                    'type'=>'column'
                  ];
                 $chartArray["title"]= [
                     "text" => $reportname->report_name
                  ];
                 $chartArray["subtitle"]=[
                    'text'=> 'Domestic and Outbound Tourism Survey '.$request->year
                 ];
                 $chartArray['plotOptions']= [
                    'series'=> [
                      'grouping'=> false,
                      'borderWidth'=> 0
                    ]
                  ];
                  $chartArray['egend']= [
                    'enabled'=> false
                  ];
                  $chartArray["tooltip"]= [
                    'shared'=> true,
                    'headerFormat'=> '<span style="font-size: 15px">{point.point.name}</span><br/>',
                   'pointFormat'=> '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>'
                  ];
                 
                $chartArray["yAxis"]= [[
                    'title'=> [
                    'text'=> 'Total Visiter'
                    ],
                'showFirstLabel'=> false
                ]];
                $dzongkhag=[];
                $male=[];
                $female=[];
                foreach($reportdata as $key=>$value){
                    $dzongkhag[] = $value->dzongkhag_name; 
                    $male[] = $value->male; 
                    $female[] = $value->female; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$dzongkhag
                ];
                $chartArray["series"]= [
                        [
                        'color'=> 'rgb(158, 159, 163)',
                        'pointPlacement'=> -0.2,
                        'linkedTo'=> 'main',
                        'data'=>$male,
                        'name'=> 'Male'
                        ], 
                        [
                        'name'=> 'Female',
                        'id'=>'main',
                        ' dataSorting'=> [
                        'enabled'=> true,
                        'matchByName'=> true
                        ],
                        'dataLabels'=> [[
                        'enabled'=> true,
                        'inside'=> true,
                        'style'=> [
                            'fontSize'=>'16px'
                        ]
                        ]],
                        'data'=> $female
                    ]
                ];
            }
            //Daytrip(excursion) visitors and expenditure by Dzongkhag visited and purpose of visited
            else if($request->report_name_id==35){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Dzongkhag'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $dzongkhag=[];
            $business=[];
            $education=[];
            $health=[];
            $holiday=[];
            $others=[];
            $personal=[];
            $religion=[];
            $visiting=[];
            $visiting=[];
            $total_visitor=[];
            $total_expenditure=[];
            foreach($reportdata as $key=>$value){
                $dzongkhag[] = $value->dzongkhag_name; 
                $business[] = $value->business; 
                $education[] = $value->education; 
                $health[] = $value->health; 
                $holiday[] = $value->holiday; 
                $others[] = $value->others; 
                $personal[] = $value->personal; 
                $religion[] = $value->religion; 
                $visiting[] = $value->visiting; 
                $total_visitor[] = $value->total_visitor; 
                $total_expenditure[] = $value->total_expenditure; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$dzongkhag
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Business and Professional',
                    'data'=>$business
                ],
                [
                    'name'=> 'Education and Training',
                    'data'=> $education
                ],
                [
                    'name'=> 'Health and Medical care',
                    'data'=> $health
                ],
                [
                    'name'=> 'Holiday/Leisure/Recreation',
                    'data'=> $holiday
                ],
                [
                    'name'=> 'Others',
                    'data'=> $others
                ],
                [
                    'name'=> 'Personal Shopping',
                    'data'=> $personal
                ],
                [
                    'name'=> 'Religion/Pilgrimage',
                    'data'=> $religion
                ],
                [
                    'name'=> 'Visiting Friends and Relatives',
                    'data'=> $visiting
                ],
                [
                    'name'=> 'Total Visitor',
                    'data'=> $total_visitor
                ],
                [
                    'name'=> 'Total Expenditure',
                    'data'=> $total_expenditure
                ]
            ];
        }
        //Daytrip(excursion) mean trip expenditure by item of expenditure and main purpose
        else if($request->report_name_id==36){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Dzongkhag'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $purpose=[];
            $car_rental=[];
            $entertainment=[];
            $fuel_cost=[];
            $food=[];
            $local_transport=[];
            $long_distance=[];
            $medical=[];
            $mice=[];
            $others=[];
            $shopping=[];
            $total_expenditure=[];
            foreach($reportdata as $key=>$value){
                $purpose[] = $value->dropdown_name; 
                $car_rental[] = $value->car_rental; 
                $entertainment[] = $value->entertainment; 
                $fuel_cost[] = $value->fuel_cost; 
                $food[] = $value->food; 
                $local_transport[] = $value->local_transport; 
                $long_distance[] = $value->long_distance; 
                $medical[] = $value->medical; 
                $mice[] = $value->mice; 
                $others[] = $value->others; 
                $shopping[] = $value->shopping; 
                $total_expenditure[] = $value->total_expenditure; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$purpose
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Car Rental',
                    'data'=>$car_rental
                ],
                [
                    'name'=> 'Entertainment',
                    'data'=> $entertainment
                ],
                [
                    'name'=> 'Fuel Cost',
                    'data'=> $fuel_cost
                ],
                [
                    'name'=> 'Food',
                    'data'=> $food
                ],
                [
                    'name'=> 'Local Transportation',
                    'data'=> $local_transport
                ],
                [
                    'name'=> 'Long Distance',
                    'data'=> $long_distance
                ],
                [
                    'name'=> 'Medical',
                    'data'=> $medical
                ],
                [
                    'name'=> 'MICE',
                    'data'=> $mice
                ],
                [
                    'name'=> 'Other',
                    'data'=> $others
                ],
                [
                    'name'=> 'Shopping',
                    'data'=> $shopping
                ],
                [
                    'name'=> 'Total Expenditure',
                    'data'=> $total_expenditure
                ]
            ];
        }
		//Daytrip(excursion) total trip expenditure by item of expenditure and main purpose(Nu.Million)
        else if($request->report_name_id==37){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Dzongkhag'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $purpose=[];
            $car_rental=[];
            $entertainment=[];
            $fuel_cost=[];
            $food=[];
            $local_transport=[];
            $long_distance=[];
            $medical=[];
            $mice=[];
            $others=[];
            $shopping=[];
            $total_expenditure=[];
            foreach($reportdata as $key=>$value){
                $purpose[] = $value->dropdown_name; 
                $car_rental[] = $value->car_rental; 
                $entertainment[] = $value->entertainment; 
                $fuel_cost[] = $value->fuel_cost; 
                $food[] = $value->food; 
                $local_transport[] = $value->local_transport; 
                $long_distance[] = $value->long_distance; 
                $medical[] = $value->medical; 
                $mice[] = $value->mice; 
                $others[] = $value->others; 
                $shopping[] = $value->shopping; 
                $total_expenditure[] = $value->total_expenditure; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$purpose
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Car Rental',
                    'data'=>$car_rental
                ],
                [
                    'name'=> 'Entertainment',
                    'data'=> $entertainment
                ],
                [
                    'name'=> 'Fuel Cost',
                    'data'=> $fuel_cost
                ],
                [
                    'name'=> 'Food',
                    'data'=> $food
                ],
                [
                    'name'=> 'Local Transportation',
                    'data'=> $local_transport
                ],
                [
                    'name'=> 'Long Distance',
                    'data'=> $long_distance
                ],
                [
                    'name'=> 'Medical',
                    'data'=> $medical
                ],
                [
                    'name'=> 'MICE',
                    'data'=> $mice
                ],
                [
                    'name'=> 'Other',
                    'data'=> $others
                ],
                [
                    'name'=> 'Shopping',
                    'data'=> $shopping
                ],
                [
                    'name'=> 'Total Expenditure',
                    'data'=> $total_expenditure
                ]
            ];
        }
        //Daytrip(excursion) visitors and expenditure by Dzongkhag visited
		else if($request->report_name_id==40){
            $chartArray["chart"] = [
                "type" => 'column',
                'plotBackgroundColor' => NULL,
                'plotBorderWidth'=> NULL,
                'plotShadow'=> false
                ] ;
            $chartArray["title"] =["text" => $reportname->report_name];
            $chartArray["subtitle"]= ["text"=> 'Source: TCB & DOI'];
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

            $dzongkhag_name=[];
            $visitors=[];
            $avg_expenditure_trip=[];
            $tot_expenditure=[];
            foreach($reportdata as $key=>$value){
                $dzongkhag_name[] = $value->dzongkhag_name; 
                $visitors[] =$value->visitors; 
                $avg_expenditure_trip[] = $value->avg_expenditure_trip;
                $tot_expenditure[] = $value->tot_expenditure;
            }
            $chartArray["xAxis"]=[
                'categories'=>$dzongkhag_name
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Visitors',
                    'data'=>$visitors
                ],
                [
                        'name'=> 'Avg Expenditure trip',
                        'data'=> $avg_expenditure_trip
                ],
                [
                    'name'=> 'Total Expenditure',
                    'data'=> $tot_expenditure
                ]
            ];
        }
        //Outbound overnight visitors by main destination
        else if($request->report_name_id==41){
          /*  $chartArray["chart"] = [
                "type" => 'variablepie',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
             $chartArray["tooltip"] = [
                'headerFormat'=> '',
                'pointFormat'=> '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
                    'Visitors (No.): <b>{point.y}</b><br/>' +
                    'Visitor (%): <b>{point.z}</b><br/>'
            ];  
           
            $data=[];
            foreach($reportdata as $key=>$value){
                $data[]= array('name'=>$value->dropdown_name,'y'=>$value->visitors,'z'=>$value->percent); 
            }
            $chartArray["series"] =[
                [
                'minPointSize'=> 10,
                    'innerSize'=>'20%',
                    'zMin'=> 0,
                    'name'=> 'countries',
                    'data'=>  [
                             [
                            'name'=> 'Spain',
                            'y'=> 505370,
                            'z'=> 92.9
                            ]
                             ],
                    ]
            ]; */

            $chartArray["chart"] = [
                "type" => 'column',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'pointFormat'=> 'Visitor: <b>{point.y}%</b>'
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Visitors'
                ],
            ];
            $data=[];
            foreach($reportdata as $key=>$value){
                $data[]= array($value->dropdown_name, $value->percent); 
            }
            $chartArray["xAxis"]=[
                'type'=> 'category',
                'labels'=> [
                   ' rotation'=> -45,
                    'style'=> [
                        'fontSize'=> '13px',
                        'fontFamily'=> 'Verdana, sans-serif'
                    ]
                ]
            ];

            $chartArray["series"] = [
                [
                   'name'=> 'Visitor',
                    'data'=>$data,
                   ' dataLabels'=> [
                       'enabled'=> true,
                        'rotation'=> -90,
                        'color'=> '#FFFFFF',
                        'align'=>'right',
                        'format'=> '{point.y}', // one decimal
                        'y'=> 10, // 10 pixels down from the top
                        'style'=> [
                            'fontSize'=> '13px',
                            'fontFamily'=> 'Verdana, sans-serif'
                        ]
                   ]
                ]
            ];  
        }
        //Outbound total and mean visitor nights by main destionation
        else if($request->report_name_id==42){
            $chartArray["chart"] = [
                "type" => 'column',
                'plotBackgroundColor' => NULL,
                'plotBorderWidth'=> NULL,
                'plotShadow'=> false
                ] ;
            $chartArray["title"] =["text" => $reportname->report_name];
            $chartArray["subtitle"]= ["text"=> 'Source: Tourism Survey'];
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
            $nights=[];
            $Mean=[];
            $country=[];
            foreach($reportdata as $key=>$value){
                $Mean[] =$value->mean; 
                $nights[] =$value->nights; 
                $country[] =$value->dropdown_name; 
                }
            $chartArray["xAxis"]=[
                'categories'=>$country
            ];

            $chartArray["series"] = [
                [
                    'name' =>'Nights',
                    'data'=>$nights
                ],
                [
                        'name'=> 'Mean',
                        'data'=> $Mean
                ]
            ];
        }

        //Outbound overnight trips by main purpose and destionation
        else if($request->report_name_id==43){
            $chartArray["chart"]= [
                'type'=> 'column'
            ];
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];

            $business=[];
            $education=[];
            $health=[];
            $holiday=[];
            $others=[];
            $personal=[];
            $religion=[];
            $visiting=[];
            $country=[];

            foreach($reportdata as $key=>$value){
                $business[] =$value->business; 
                $education[] =$value->education;
                $health[] =$value->health; 
                $holiday[] =$value->holiday; 
                $others[] =$value->others; 
                $personal[] =$value->personal; 
                $religion[] =$value->religion; 
                $visiting[] =$value->visiting; 
                $country[] =$value->dropdown_name; 
                }
            $chartArray["xAxis"]=[
                'categories'=>$country
            ];
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Purpose'
                ],
            ];
            $chartArray[ "tooltip"]= [
            ' pointFormat'=> '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
            'shared'=> true
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'percent'
                ]
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Business',
                    'data'=>$business
                ],
                [
                        'name'=> 'Education',
                        'data'=> $education
                ],
                [
                    'name'=> 'Health',
                    'data'=> $health
                ],
                [
                    'name'=> 'Holiday',
                    'data'=> $holiday
                ],
                [
                    'name'=> 'Others',
                    'data'=> $others
                ],
                [
                    'name'=> 'Personal',
                    'data'=> $personal
                ],
                [
                    'name'=> 'Religion',
                    'data'=> $religion
                ],
                [
                    'name'=> 'Visiting',
                    'data'=> $visiting
                ]
            ];
         }
         //Outbound visitors nights by main purpose and destionation
        else if($request->report_name_id==44){
            $chartArray["chart"]= [
                'type'=> 'column'
            ];
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];

            $business=[];
            $education=[];
            $health=[];
            $holiday=[];
            $others=[];
            $personal=[];
            $religion=[];
            $visiting=[];
            $country=[];

            foreach($reportdata as $key=>$value){
                $business[] =$value->business; 
                $education[] =$value->education;
                $health[] =$value->health; 
                $holiday[] =$value->holiday; 
                $others[] =$value->others; 
                $personal[] =$value->personal; 
                $religion[] =$value->religion; 
                $visiting[] =$value->visiting; 
                $country[] =$value->dropdown_name; 
                }
            $chartArray["xAxis"]=[
                'categories'=>$country
            ];
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Purpose'
                ],
            ];
            $chartArray[ "tooltip"]= [
            ' pointFormat'=> '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
            'shared'=> true
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'percent'
                ]
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Business',
                    'data'=>$business
                ],
                [
                        'name'=> 'Education',
                        'data'=> $education
                ],
                [
                    'name'=> 'Health',
                    'data'=> $health
                ],
                [
                    'name'=> 'Holiday',
                    'data'=> $holiday
                ],
                [
                    'name'=> 'Others',
                    'data'=> $others
                ],
                [
                    'name'=> 'Personal',
                    'data'=> $personal
                ],
                [
                    'name'=> 'Religion',
                    'data'=> $religion
                ],
                [
                    'name'=> 'Visiting',
                    'data'=> $visiting
                ]
            ];
        }
        //Outbound overnight trips by main destination by mode of transport(%)
		else if($request->report_name_id==46){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Mode Of Transport(%)'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $country=[];
            $air=[];
            $car=[];
            $own_vehicle=[];
            $public_transport=[];
            $vehicle_arranged=[];
            $total=[];
            foreach($reportdata as $key=>$value){
                $country[] = $value->dropdown_name;
                $air[] = $value->air;
                $own_vehicle[] = $value->own_vehicle; 
                $car[] = $value->car;
                $public_transport[] = $value->public_transport;
                $vehicle_arranged[] = $value->vehicle_arranged;
                $total[] = $value->total;
            }
            $chartArray["xAxis"]=[
                'categories'=>$country
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Air',
                    'data'=>$air
                ],
                [
                    'name'=> 'Car',
                    'data'=> $car
                ],
                [
                    'name'=> 'Own Vehicle',
                    'data'=> $own_vehicle
                ],
                [
                    'name'=> 'Public Transport',
                    'data'=> $public_transport
                ],
                [
                    'name'=> 'Vehicle Arranged',
                    'data'=> $vehicle_arranged
                ],
                [
                    'name'=> 'Total',
                    'data'=> $total
                ]
            ];
        }
	    //Outbound overnight visitors by main destination and package options
        else if($request->report_name_id==48){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Package Option '
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $country=[];
            $yes_option=[];
            $no_option=[];
            $total=[];
            foreach($reportdata as $key=>$value){
                $country[] = $value->dropdown_name; 
                $yes_option[] = $value->yes_option; 
                $no_option[] = $value->no_option; 
                $total[] = $value->total; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$country
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Package Option Yes',
                    'data'=>$yes_option
                ],
                [
                    'name'=> 'Package Option No',
                    'data'=> $no_option
                ],
                [
                    'name'=> 'Total',
                    'data'=> $total
                ]
            ];
        }
		 //Outbound overnight total trip expenditure by main destination and item of expenditure(in Nu.Million)
        else if($request->report_name_id==52){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Expenditure(Million)'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $purpose=[];
            $tour_package=[];
            $accommodation=[];
            $air=[];
            $car_rental=[];
            $fuel_cost=[];
            $food=[];
            $local_transport=[];
            $long_distance=[];
            $medical=[];
            $mice=[];
            $others=[];
            $shopping=[];
            foreach($reportdata as $key=>$value){
                $purpose[] = $value->dropdown_name; 
                $tour_package[] = $value->tour_package; 
                $accommodation[] = $value->accommodation; 
                $air[] = $value->air; 
                $car_rental[] = $value->car_rental; 
                $fuel_cost[] = $value->fuel_cost; 
                $food[] = $value->food; 
                $local_transport[] = $value->local_transport; 
                $long_distance[] = $value->long_distance; 
                $medical[] = $value->medical; 
                $mice[] = $value->mice; 
                $others[] = $value->others; 
                $shopping[] = $value->shopping; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$purpose
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Tour Package',
                    'data'=>$tour_package
                ],
                [
                    'name'=> 'Accommodation',
                    'data'=> $accommodation
                ],
                [
                    'name'=> 'Air',
                    'data'=> $air
                ],
                [
                    'name'=> 'Car Rental',
                    'data'=> $car_rental
                ],
                [
                    'name'=> 'Fuel Cost',
                    'data'=> $fuel_cost
                ],
                [
                    'name'=> 'Food',
                    'data'=> $food
                ],
                [
                    'name'=> 'Local Transport',
                    'data'=> $local_transport
                ],
                [
                    'name'=> 'Long Distance',
                    'data'=> $long_distance
                ],
                [
                    'name'=> 'Medical',
                    'data'=> $medical
                ],
                [
                    'name'=> 'MICE',
                    'data'=> $mice
                ],
                [
                    'name'=> 'Others',
                    'data'=> $others
                ],
                [
                    'name'=> 'Shopping',
                    'data'=> $shopping
                ]
            ];
        }
        //Outbound overnight mean trip expenditure by main destination and item of expenditure(in Nu.)
        else if($request->report_name_id==53){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Expenditure(Nu.)'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $purpose=[];
            $tour_package=[];
            $accommodation=[];
            $air=[];
            $car_rental=[];
            $fuel_cost=[];
            $food=[];
            $local_transport=[];
            $long_distance=[];
            $medical=[];
            $mice=[];
            $others=[];
            $shopping=[];
            foreach($reportdata as $key=>$value){
                $purpose[] = $value->dropdown_name; 
                $tour_package[] = $value->tour_package; 
                $accommodation[] = $value->accommodation; 
                $air[] = $value->air; 
                $car_rental[] = $value->car_rental; 
                $fuel_cost[] = $value->fuel_cost; 
                $food[] = $value->food; 
                $local_transport[] = $value->local_transport; 
                $long_distance[] = $value->long_distance; 
                $medical[] = $value->medical; 
                $mice[] = $value->mice; 
                $others[] = $value->others; 
                $shopping[] = $value->shopping; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$purpose
            ];
            $chartArray["series"] = [
                [
                    'name' =>'Tour Package',
                    'data'=>$tour_package
                ],
                [
                    'name'=> 'Accommodation',
                    'data'=> $accommodation
                ],
                [
                    'name'=> 'Air',
                    'data'=> $air
                ],
                [
                    'name'=> 'Car Rental',
                    'data'=> $car_rental
                ],
                [
                    'name'=> 'Fuel Cost',
                    'data'=> $fuel_cost
                ],
                [
                    'name'=> 'Food',
                    'data'=> $food
                ],
                [
                    'name'=> 'Local Transport',
                    'data'=> $local_transport
                ],
                [
                    'name'=> 'Long Distance',
                    'data'=> $long_distance
                ],
                [
                    'name'=> 'Medical',
                    'data'=> $medical
                ],
                [
                    'name'=> 'MICE',
                    'data'=> $mice
                ],
                [
                    'name'=> 'Others',
                    'data'=> $others
                ],
                [
                    'name'=> 'Shopping',
                    'data'=> $shopping
                ]
            ];
        }
        //Outbound excursion trip by purpose and sex
         else if($request->report_name_id==55){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Purpose'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $purpose=[];
            $male=[];
            $female=[];
            $total=[];
           
            foreach($reportdata as $key=>$value){
                $purpose[] = $value->dropdown_name; 
                $male[] = $value->male; 
                $female[] = $value->female; 
                $total[] = $value->total; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$purpose
            ];
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

        //Outbound overnight total trip expenditure by main destination and item of expenditure(in Nu.Million)
        else if($request->report_name_id==59){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Expenditure(Million)'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $purpose=[];
            $car_rental=[];
            $fuel_cost=[];
            $food=[];
            $local_transport=[];
            $long_distance=[];
            $medical=[];
            $mice=[];
            $others=[];
            $shopping=[];
            foreach($reportdata as $key=>$value){
                $purpose[] = $value->dropdown_name; 
                $car_rental[] = $value->car_rental; 
                $fuel_cost[] = $value->fuel_cost; 
                $food[] = $value->food; 
                $local_transport[] = $value->local_transport; 
                $long_distance[] = $value->long_distance; 
                $medical[] = $value->medical; 
                $mice[] = $value->mice; 
                $others[] = $value->others; 
                $shopping[] = $value->shopping; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$purpose
            ];
            $chartArray["series"] = [
                [
                    'name'=> 'Car Rental',
                    'data'=> $car_rental
                ],
                [
                    'name'=> 'Fuel Cost',
                    'data'=> $fuel_cost
                ],
                [
                    'name'=> 'Food',
                    'data'=> $food
                ],
                [
                    'name'=> 'Local Transport',
                    'data'=> $local_transport
                ],
                [
                    'name'=> 'Long Distance',
                    'data'=> $long_distance
                ],
                [
                    'name'=> 'Medical',
                    'data'=> $medical
                ],
                [
                    'name'=> 'MICE',
                    'data'=> $mice
                ],
                [
                    'name'=> 'Others',
                    'data'=> $others
                ],
                [
                    'name'=> 'Shopping',
                    'data'=> $shopping
                ]
            ];
        }

			//Outbound overnight mean trip expenditure by main destination and item of expenditure(in Nu.)
            else if($request->report_name_id==60){
            $chartArray["chart"] = [
                "type" => 'bar',
                ] ;
            $chartArray["title"] =[
                "text" => $reportname->report_name
                ];
            $chartArray["subtitle"]= [
                "text"=> 'Domestic and Outbound Tourism Survey '.$request->year
            ];
            $chartArray["tooltip"] = [
                'split'=> true,
            ]; 
            $chartArray["yAxis"]=[
                'min'=>0,
                'title'=> [
                'text'=>'Expenditure(Nu.)'
                ],
                'legend'=> [
                    'reversed'=>true
                ],
            ];
            $chartArray["plotOptions"] =[
                'series'=> [
                    'stacking'=> 'normal'
                ]
            ];
            $purpose=[];
            $car_rental=[];
            $fuel_cost=[];
            $food=[];
            $local_transport=[];
            $long_distance=[];
            $medical=[];
            $mice=[];
            $others=[];
            $shopping=[];
            foreach($reportdata as $key=>$value){
                $purpose[] = $value->dropdown_name; 
                $car_rental[] = $value->car_rental; 
                $fuel_cost[] = $value->fuel_cost; 
                $food[] = $value->food; 
                $local_transport[] = $value->local_transport; 
                $long_distance[] = $value->long_distance; 
                $medical[] = $value->medical; 
                $mice[] = $value->mice; 
                $others[] = $value->others; 
                $shopping[] = $value->shopping; 
            }
            $chartArray["xAxis"]=[
                'categories'=>$purpose
            ];
            $chartArray["series"] = [
                [
                    'name'=> 'Car Rental',
                    'data'=> $car_rental
                ],
                [
                    'name'=> 'Fuel Cost',
                    'data'=> $fuel_cost
                ],
                [
                    'name'=> 'Food',
                    'data'=> $food
                ],
                [
                    'name'=> 'Local Transport',
                    'data'=> $local_transport
                ],
                [
                    'name'=> 'Long Distance',
                    'data'=> $long_distance
                ],
                [
                    'name'=> 'Medical',
                    'data'=> $medical
                ],
                [
                    'name'=> 'MICE',
                    'data'=> $mice
                ],
                [
                    'name'=> 'Others',
                    'data'=> $others
                ],
                [
                    'name'=> 'Shopping',
                    'data'=> $shopping
                ]
            ];
        }
        return response()->json($chartArray)->setEncodingOptions(JSON_NUMERIC_CHECK);
        }
        else{
            $status=false;
            return response()->json($status);
        }
    }
}
