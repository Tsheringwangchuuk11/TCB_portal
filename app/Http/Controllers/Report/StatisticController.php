<?php

namespace App\Http\Controllers\Report;

use App\Exports\ExportToView;
use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Excel;
use PDF;
class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['statisticReportDtls'] = Statistic::getArrivalReport($request);
        $reportTypeName = '';
        $data['reportTypeId'] = $request->query('reportType');
        $data['reportTitle'] = '';
        if ($request->query('reportType')==1){
            $reportTypeName = 'Overall Arrivals Report';
            $data['reportTitle'] = 'Visitor Arrivals To Bhutan between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            if ($request->query('groupType') != "" && $request->query('groupType') == 0){
                $reportTypeName = 'Arrivals By International Report';
                $data['reportTitle'] = 'Visitor Arrivals By International between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            } elseif ($request->query('groupType') != "" && $request->query('groupType') == 1){
                $reportTypeName = 'Arrivals By Regional Report';
                $data['reportTitle'] = 'Visitor Arrivals By Regional between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            }
        } elseif ($request->query('reportType')==2){
            $reportTypeName = 'Arrivals By Nationality Report';
            $data['reportTitle'] = 'Visitor Arrivals By Nationality between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            if ($request->query('groupType') != "" && $request->query('groupType') == 0){
                $reportTypeName = 'Nationality of International Arrivals Report';
                $data['reportTitle'] = 'Nationality of International Visitor Arrivals between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            } elseif ($request->query('groupType') != "" && $request->query('groupType') == 1){
                $reportTypeName = 'Nationality of Regional Arrivals Report';
                $data['reportTitle'] = 'Nationality of Regional Visitor Arrivals between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            }
        } elseif ($request->query('reportType')==3){
            $reportTypeName = 'Arrivals By Activity Report';
            $data['reportTitle'] = 'Visitor Arrivals By Activity between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            if ($request->query('groupType') != "" && $request->query('groupType') == 0){
                $reportTypeName = 'International Arrivals By Activity Report';
                $data['reportTitle'] = 'International Visitor Arrivals By Activity between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            } elseif ($request->query('groupType') != "" && $request->query('groupType') == 1){
                $reportTypeName = 'Nationality of Regional Arrivals Report';
                $data['reportTitle'] = 'Regional Visitor Arrivals By Activity between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            }
        } elseif ($request->query('reportType')==4){
            $reportTypeName = 'Arrivals By Dzongkhag Report';
            $data['reportTitle'] = 'Visitor Arrivals By Dzongkhag between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            if ($request->query('groupType') != "" && $request->query('groupType') == 0){
                $reportTypeName = 'International Arrivals By Dzongkhag Report';
                $data['reportTitle'] = 'International Visitor By Dzongkhag between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            } elseif ($request->query('groupType') != "" && $request->query('groupType') == 1){
                $reportTypeName = 'Regional Arrivals By Dzongkhag Report';
                $data['reportTitle'] = 'Regional Visitor Arrivals By Dzongkhag between \''.date('d-m-Y', strtotime($request->query('start_date'))).'\' and \''.date('d-m-Y', strtotime($request->query('end_date'))).'\'';
            }
        }

        if ($request->has('print'))
        {

            if ($request->query('print') == 'excel') {
                return Excel::download(new ExportToView($data, 'report.statistical.download_excel.arrival'), $reportTypeName.'.xlsx');
            } else {
                $pdf = PDF::loadView('report.statistical.download_pdf.arrival', $data);
                return $pdf->stream($reportTypeName.'-'.str_random(4).'.pdf');
            }
        } else {
            $chartArray = [];
            $chartArray['chart'] = ['type' => 'column'];
            $chartArray['title'] = ['text' => $data['reportTitle']];
            $chartArray['subtitle'] = ['text' => 'Source: TCB'];
            $chartArray['credits'] = ['enabled' => false];
            //$chartArray['xAxis'] = ['categories' => ['Africa', 'America', 'Asia', 'Europe', 'Oceania']];
            $chartArray['xAxis'] = [
                'type' => 'category',
                'labels' => [
                    'rotation' => '-45',
                    'style' => [
                        'fontSize' => '13px',
                        'fontFamily' => 'Verdana, sans-serif'
                    ]
                ]
            ];
            $chartArray['yAxis'] = [
                                        'min' => '0',
                                        'title' => [
                                            'text' => 'Total Visitors (numbers)'
                                        ]
                                    ];
            $chartArray['legend'] = [
                'enabled' => false
            ];
            $chartArray['tooltip'] = [
                'pointFormat' => 'Total Visitors: <b>{point.y:.1f} numbers</b>'
            ];
            /*$chartArray['tooltip'] = [
                'valueSuffix' => 'numbers'
            ];*/
            /*$chartArray['plotOptions'] = [
                'bar' => [
                    'dataLabels' => [
                        'enable' => true
                    ]
                ]
            ];*/
           /* $chartArray['legend'] = [
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'top',
                'x' => '-40',
                'y' => '80',
                'floating' => true,
                'borderWidth' => '1',
                'backgroundColor' =>
                'Highcharts.defaultOptions.legend.backgroundColor',
                'shadow' => true
            ];*/
            /*$chartArray['series'] = [
                [
                    'name' => 'Year 1800',
                    'data' =>  [107, 31, 635, 203, 2]
                ],
            ];*/
            $dataArray = [];
            if ($request->query('reportType') !=1){
                foreach ($data['statisticReportDtls'] as $reportDtl ){
                    $dataArray[] = [$reportDtl->name, $reportDtl->total];
                }
            }

            $chartArray['series'] = [
                [
                    'name' => 'Total Visitors',
                    'data'=> $dataArray,
                    'dataLabels' => [
                        'enabled' => true,
                        'rotation' => '-90',
                        'color' => '#FFFFFF',
                        'align' => 'right',
                        'format' => '{point.y:.1f}', // one decimal
                        'y' => '10', // 10 pixels down from the top
                        'style' => [
                            'fontSize' => '0px',
                            'fontFamily' => 'Verdana, sans-serif'
                        ]

                    ]
                ]
            ];
            $data['chartArray'] = $chartArray;
            return view('report.statistical.arrival', $data);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function show(Statistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function edit(Statistic $statistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statistic $statistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statistic $statistic)
    {
        //
    }
}
