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
            if($request->report_type_id==1){
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
                }else{
                    if($request->report_name_id==10 || $request->report_name_id==19 || $request->report_name_id==13 || $request->report_name_id==15 || $request->report_name_id==24 || $request->report_name_id==26 || $request->report_name_id==27 ){
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
                                if($request->report_name_id==26){
                                    $chartArray["yAxis"]=[
                                        'min'=>0,
                                        'title'=> [
                                        'text'=>'Total trip expenditure'
                                        ],
                                        'legend'=> [
                                            'reversed'=>true
                                        ],
                                    ];
                                }else if($request->report_name_id==27){
                                    $chartArray["yAxis"]=[
                                        'min'=>0,
                                        'title'=> [
                                        'text'=>'Average trip expenditure'
                                        ],
                                        'legend'=> [
                                            'reversed'=>true
                                        ],
                                    ];
                                }
                                else{
                                    $chartArray["yAxis"]=[
                                        'min'=>0,
                                        'title'=> [
                                        'text'=>'Dzongkhag'
                                        ],
                                        'legend'=> [
                                            'reversed'=>true
                                        ],
                                    ];
                                }
                                $chartArray["plotOptions"] =[
                                    'series'=> [
                                        'stacking'=> 'normal'
                                    ]
                                ];
                        }else if($request->report_name_id==30){
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
                        }
                }
        
            if($request->report_name_id==5){
                $month=[];
                foreach($reportdata as $key=>$value){
                    $month[] = $value->MonthEn; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$month
                ];
            }
            else if($request->report_name_id==2){
                $mainPurpose=[];
                foreach($reportdata as $key=>$value){
                    $mainPurpose[] = $value->MainPurpose; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$mainPurpose
                ]; 
            }
            else if($request->report_name_id==6 || $request->report_name_id==7 || $request->report_name_id==8 || $request->report_name_id==9){
                $region=[];
                foreach($reportdata as $key=>$value){
                    $region[] = $value->Region; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$region
                ];
            }
            else if($request->report_name_id==1 || $request->report_name_id==3 || $request->report_name_id==4){
                $mainPurpose=[];
                foreach($reportdata as $key=>$value){
                    $mainPurpose[] = $value->MainPurpose; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$mainPurpose
                ];
            }
            else if($request->report_name_id==10 || $request->report_name_id==19 || $request->report_name_id==13 || $request->report_name_id==15 || $request->report_name_id==24 || $request->report_name_id==30){
                $dzongkhag=[];
                foreach($reportdata as $key=>$value){
                    $dzongkhag[] = $value->dzongkhag_name; 
                }
                $chartArray["xAxis"]=[
                    'categories'=>$dzongkhag
                ];
            } else if($request->report_name_id==26 || $request->report_name_id==27){
                $mainpurpose=[];
                foreach($reportdata as $key=>$value){
                    if($value->dropdown_name!="Total"){
                        $mainpurpose[] = $value->dropdown_name; 
                    }
                }
                $chartArray["xAxis"]=[
                    'categories'=>$mainpurpose
                ];
            }
        
    if($request->report_name_id==1){
        
            $arrivalByAir=[];
            $arrivalByland=[];
            foreach($reportdata as $key=>$value){
                $arrivalByAir[] = str_replace( ',', '', $value->air); 
                }
            foreach($reportdata as $key=>$value){
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
    else if($request->report_name_id==2){
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
            $mainpurpose[] = $value->MainPurpose; 
            }
        foreach($reportdata as $key=>$value){
            if( $value->Jan!=null){
                $january[] = $value->Jan; 
            }else{
                $january[] = 0; 
            }
        }

        foreach($reportdata as $key=>$value){
            if($value->Feb!=null){
            $febuary[] = $value->Feb;
            }else{
                $febuary[] = 0;
            } 
        }

        foreach($reportdata as $key=>$value){
            if($value->Feb!=null){
                $march[] = $value->Mar; 
            }else{
                $march[] = 0; 
            }
        }
        foreach($reportdata as $key=>$value){
            if($value->Apr!=null){
                $april[] = $value->Apr;
            }else{
                $april[] = 0;
            }
        }

        foreach($reportdata as $key=>$value){
            if($value->May!=null){
                $may[] = $value->May; 
            }else{
                $may[] = 0; 
            }
        }

        foreach($reportdata as $key=>$value){
            if($value->Jun!=null){
                $june[] = $value->Jun; 

            }else{
                $june[] = 0; 
            }
        }

        foreach($reportdata as $key=>$value){
            if($value->Jul!=null){
                $july[] = $value->Jul;
            }else{
                $july[] = 0;
            } 
        
        }
        foreach($reportdata as $key=>$value){
            if($value->Aug!=null){
                $august[] = $value->Aug;
            }else{
                $august[] =0;
            } 
        }

        foreach($reportdata as $key=>$value){
            if($value->Sep!=null){
                $september[] = $value->Sep;    
            }else{
                $september[] = $value->Sep;
            }
        }

        foreach($reportdata as $key=>$value){
            if($value->Octo!=null){
                $october[] = $value->Octo;    
            }else{
                $october[] = 0;
            }        
        }

        foreach($reportdata as $key=>$value){
            if($value->Nov!=null){
                $november[] = $value->Nov;    
            }else{
                $november[] = $value->Nov;
            }
        }

        foreach($reportdata as $key=>$value){
            if($value->Dece!=null){
                $december[] = $value->Dece; 
            }else{
                $december[] = 0; 
            }
        }
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
    else if($request->report_name_id==4 || $request->report_name_id==7){
        $one_two_night=[];
        $three_four_nights=[];
        $five_six_nights=[];
        $seven_eight_nights=[];
        $nine_fourteen_nights=[];
        $fiveteennights=[];
        foreach($reportdata as $key=>$value){
            $one_two_night[] = $value->one_two_nights; 
            }
        foreach($reportdata as $key=>$value){
            $three_four_nights[] = $value->three_four_nights; 
            }
        foreach($reportdata as $key=>$value){
            $five_six_nights[] = $value->five_six_nights; 
            }
        foreach($reportdata as $key=>$value){
            $seven_eight_nights[] = $value->seven_eight_nights; 
            }
        foreach($reportdata as $key=>$value){
            $nine_fourteen_nights[] = $value->nine_fourteen_nights; 
            }
        foreach($reportdata as $key=>$value){
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
    else if($request->report_name_id==3){
        $visitors=[];
        $visitors_nights=[];
        $median_night=[];
        $mean_night=[];

        foreach($reportdata as $key=>$value){
            $visitors[] = $value->visitors; 
            }
        foreach($reportdata as $key=>$value){
            $visitors_nights[] = $value->visitors_nights; 
            }
        foreach($reportdata as $key=>$value){
            $median_night[] = $value->median_night; 
            }
        foreach($reportdata as $key=>$value){
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

    else if($request->report_name_id==5){
        $arrivalByAir=[];
        $arrivalByland=[];
        $total=[];

        foreach($reportdata as $key=>$value){
            $arrivalByAir[] = $value->air; 
            }
        foreach($reportdata as $key=>$value){
            $arrivalByland[] = $value->land; 
            }
        foreach($reportdata as $key=>$value){
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
    else if($request->report_name_id==6){
        $mean=[];
        $median=[];

        foreach($reportdata as $key=>$value){
            $mean[] = $value->mean; 
            }
        foreach($reportdata as $key=>$value){
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
    else if($request->report_name_id==8){
        $Business=[];
        $ETE_Program=[];
        $HLR=[];
        $IT=[];
        $MICE=[];
        $Official=[];
        $Others=[];
        $VFRG=[];
        foreach($reportdata as $key=>$value){
            $ETE_Program[] = $value->ETE_Program; 
            }
        foreach($reportdata as $key=>$value){
            $Business[] = $value->Business; 
            }
        foreach($reportdata as $key=>$value){
            $HLR[] = $value->HLR; 
            }
        foreach($reportdata as $key=>$value){
            $IT[] = $value->IT; 
            }
        foreach($reportdata as $key=>$value){
            $MICE[] = $value->MICE; 
            }
        foreach($reportdata as $key=>$value){
            $Official[] = $value->Official; 
            }
        foreach($reportdata as $key=>$value){
            $Others[] = $value->Others; 
            }
        foreach($reportdata as $key=>$value){
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
    else if($request->report_name_id==9){
        
        $male=[];
        $female=[];
        $total=[];
        foreach($reportdata as $key=>$value){
            $male[] = $value->Male; 
            }
        foreach($reportdata as $key=>$value){
            $female[] = $value->Female; 
            }
        foreach($reportdata as $key=>$value){
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

    else if($request->report_name_id==10 || $request->report_name_id==19){
        $business=[];
        $education=[];
        $health=[];
        $holiday=[];
        $others=[];
        $personal=[];
        $religion=[];
        $visiting=[];
        foreach($reportdata as $key=>$value){
            $business[] = $value->business; 
            }
        foreach($reportdata as $key=>$value){
            $education[] = $value->education; 
            }
        foreach($reportdata as $key=>$value){
            $health[] = $value->health; 
            }
        foreach($reportdata as $key=>$value){
            $holiday[] = $value->holiday; 
            }
        foreach($reportdata as $key=>$value){
            $others[] = $value->others; 
            }
        foreach($reportdata as $key=>$value){
            $personal[] = $value->personal; 
            }
        foreach($reportdata as $key=>$value){
            $religion[] = $value->religion; 
            }
        foreach($reportdata as $key=>$value){
            $visiting[] = $value->visiting; 
            }
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
        else if($request->report_name_id==13 || $request->report_name_id==15){
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
                $bumthang[] = $value->bumthang; 
                }
            foreach($reportdata as $key=>$value){
                $chukha[] = $value->chukha; 
                }
            foreach($reportdata as $key=>$value){
                $dagana[] = $value->dagana; 
                }
            foreach($reportdata as $key=>$value){
                $gasa[] = $value->gasa; 
                }
            foreach($reportdata as $key=>$value){
                $haa[] = $value->haa; 
                }
            foreach($reportdata as $key=>$value){
                $lhuentse[] = $value->lhuentse; 
                }
            foreach($reportdata as $key=>$value){
                $mongar[] = $value->mongar; 
                }
            foreach($reportdata as $key=>$value){
                $paro[] = $value->paro; 
                }
            foreach($reportdata as $key=>$value){
                $pemagatshel[] = $value->pemagatshel; 
                }
            foreach($reportdata as $key=>$value){
                $punakha[] = $value->punakha; 
                }
            foreach($reportdata as $key=>$value){
                $samdrupjongkhar[] = $value->samdrupjongkhar; 
                }
            foreach($reportdata as $key=>$value){
                $samtse[] = $value->samtse; 
                }
            foreach($reportdata as $key=>$value){
                $sarpang[] = $value->sarpang; 
                }
            foreach($reportdata as $key=>$value){
                $thimphu[] = $value->thimphu; 
                }
            foreach($reportdata as $key=>$value){
                $trashigang[] = $value->trashigang; 
                }
            foreach($reportdata as $key=>$value){
                $trashiyangtse[] = $value->trashiyangtse; 
                }
            foreach($reportdata as $key=>$value){
                $trongsa[] = $value->trongsa; 
                }
            foreach($reportdata as $key=>$value){
                $tsirang[] = $value->tsirang; 
                }
            foreach($reportdata as $key=>$value){
                $wangduephodrang[] = $value->wangduephodrang; 
                }
            foreach($reportdata as $key=>$value){
                $zhemgang[] = $value->zhemgang; 
                }
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
        else if($request->report_name_id==24){
            $visitors=[];
            $visitors_percent=[];
            $nights_percent=[];
            $avg_expenditure_night=[];
            $avg_expenditure_trip=[];
            $tot_expenditure=[];
            $nights=[];
            foreach($reportdata as $key=>$value){
                $visitors[] = $value->visitors; 
                }
            foreach($reportdata as $key=>$value){
                $visitors_percent[] = $value->visitors_percent; 
                }
            foreach($reportdata as $key=>$value){
                $nights_percent[] = $value->nights_percent; 
                }
            foreach($reportdata as $key=>$value){
                $nights[] = $value->nights; 
                }
            foreach($reportdata as $key=>$value){
                $avg_expenditure_night[] = $value->avg_expenditure_night; 
                }
            foreach($reportdata as $key=>$value){
                $avg_expenditure_trip[] = $value->avg_expenditure_trip; 
                }
            foreach($reportdata as $key=>$value){
                $tot_expenditure[] = $value->tot_expenditure; 
                }
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
            else if($request->report_name_id==26 || $request->report_name_id==27){
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
                    $accommodation[] = $value->accommodation; 
                    }
                foreach($reportdata as $key=>$value){
                    $air[] = $value->air; 
                    }
                foreach($reportdata as $key=>$value){
                    $car_rental[] = $value->car_rental; 
                    }
                foreach($reportdata as $key=>$value){
                    $entertainment[] = $value->entertainment; 
                    }
                foreach($reportdata as $key=>$value){
                    $fuel_cost[] = $value->fuel_cost; 
                    }
                foreach($reportdata as $key=>$value){
                    $food[] = $value->food; 
                    }
                foreach($reportdata as $key=>$value){
                    $local_transport[] = $value->local_transport; 
                    }
                foreach($reportdata as $key=>$value){
                    $long_distance[] = $value->long_distance; 
                    }
                foreach($reportdata as $key=>$value){
                    $medical[] = $value->medical; 
                    }
                foreach($reportdata as $key=>$value){
                    $mice[] = $value->mice; 
                    }
                foreach($reportdata as $key=>$value){
                    $others[] = $value->others; 
                    }
                foreach($reportdata as $key=>$value){
                    $shopping[] = $value->shopping; 
                    }
                foreach($reportdata as $key=>$value){
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
                else if($request->report_name_id==30){
                    $male=[];
                    $female=[];
                    foreach($reportdata as $key=>$value){
                        $male[] = $value->male; 
                        }
                    foreach($reportdata as $key=>$value){
                        $female[] = $value->female; 
                        }
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
            return response()->json($chartArray)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }else{
        $status=false;
        return response()->json($status);
    }
}
}
