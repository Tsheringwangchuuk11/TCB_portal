<?php

namespace App\Http\Controllers\StatisticalReport;

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
        if ($request->has('print'))
        {
            $reportTypeName = '';
            $data['reportTypeId'] = $request->query('reportType');
            $data['reportTitle'] = '';
            if ($request->query('reportType')==1){
                $reportTypeName = 'Overall Arrivals Report';
                $data['reportTitle'] = 'Visitor Arrivals To Bhutan';
                if ($request->query('groupType') != "" && $request->query('groupType') == 0){
                    $reportTypeName = 'Arrivals By International Report';
                    $data['reportTitle'] = 'Visitor Arrivals By International';
                }
            }
            if ($request->query('print') == 'excel') {
                return Excel::download(new ExportToView($data, 'arrival'), $reportTypeName.'.xlsx');
            } else {
                $pdf = PDF::loadView('report.pdf.arrival', ['reportDtls' =>$data['statisticReportDtls'] ]);
                return $pdf->stream('Arrival Report-'.str_random(4).'.pdf');
            }
        } else {
            return view('statistical-reports.arrival', $data);
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
