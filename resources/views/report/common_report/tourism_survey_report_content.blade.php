
<div class="card">
    <div class="card-header">  
        <h3 class="card-title">
            {{$reportname->report_name}}
        </h3>                                             
    </div>
    <div class="card-body">
        <div class="row" style="overflow-x:auto;">
            <div class="col-md-12">
                @if ($report_name_id==1)
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Purpose</th>
                                <th>Air</th>
                                <th>Land</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->MainPurpose}}</td>
                                    <td>{{$reportdata->air}}</td>
                                    <td>{{$reportdata->land}}</td>
                                    <td>{{$reportdata->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($report_name_id==2)
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Purpose</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>May</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Aug</th>
                                <th>Sep</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->MainPurpose}}</td>
                                    <td>{{$reportdata->Jan}}</td>
                                    <td>{{$reportdata->Feb}}</td>
                                    <td>{{$reportdata->Mar}}</td>
                                    <td>{{$reportdata->Apr}}</td>
                                    <td>{{$reportdata->May}}</td>
                                    <td>{{$reportdata->Jun}}</td>
                                    <td>{{$reportdata->Jul}}</td>
                                    <td>{{$reportdata->Aug}}</td>
                                    <td>{{$reportdata->Sep}}</td>
                                    <td>{{$reportdata->Octo}}</td>
                                    <td>{{$reportdata->Nov}}</td>
                                    <td>{{$reportdata->Dece}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($report_name_id==3)
                    @php
                        $total_visitors=0;
                        $total_visitors_nights=0;
                        $total_median_night=0;
                        $total_mean_night=0;
                    @endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Purpose</th>
                                <th>Visitor</th>
                                <th>Visitor nights</th>
                                <th>Median night</th>
                                <th>Mean night</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->MainPurpose}}</td>
                                    <td>{{$reportdata->visitors}}</td>
                                    <td>{{$reportdata->visitors_nights}}</td>
                                    <td>{{$reportdata->median_night}}</td>
                                    <td>{{$reportdata->mean_night}}</td>
                                    @php
                                    ($total_visitors +=$reportdata->visitors);
                                    ($total_visitors_nights +=$reportdata->visitors_nights);
                                    ($total_median_night +=$reportdata->median_night);
                                    ($total_mean_night +=$reportdata->mean_night);
                                    @endphp 
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{$total_visitors}}</th>
                                <th>{{$total_visitors_nights}}</th>
                                <th>{{$total_median_night}}</th>
                                <th>{{$total_mean_night}}</th>
                            </tr>
                        </tfoot>
                    </table>
                @elseif($report_name_id==4)
                    @php
                        $total_one_two_nights=0;
                        $total_three_four_nights=0;
                        $total_five_six_nights=0;
                        $total_seven_eight_nights=0;
                        $total_nine_fourteen_nights=0;
                        $total_fiveteennights=0;
                        $grant_total=0;
                    @endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Purpose</th>
                                <th>1-2 Nights</th>
                                <th>3-4 Nights</th>
                                <th>5-6 Nights</th>
                                <th>7-6 Nights</th>
                                <th>9-14 Nights</th>
                                <th>15 Nights and above</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->MainPurpose}}</td>
                                    <td>{{$reportdata->one_two_nights}}</td>
                                    <td>{{$reportdata->three_four_nights}}</td>
                                    <td>{{$reportdata->five_six_nights}}</td>
                                    <td>{{$reportdata->seven_eight_nights}}</td>
                                    <td>{{$reportdata->nine_fourteen_nights}}</td>
                                    <td>{{$reportdata->fiveteennights}}</td>
                                    <td>{{$reportdata->total}}</td>
                                    @php
                                    ($total_one_two_nights +=$reportdata->one_two_nights);
                                    ($total_three_four_nights +=$reportdata->three_four_nights);
                                    ($total_five_six_nights +=$reportdata->five_six_nights);
                                    ($total_seven_eight_nights +=$reportdata->seven_eight_nights);
                                    ($total_nine_fourteen_nights +=$reportdata->nine_fourteen_nights);
                                    ($total_fiveteennights +=$reportdata->fiveteennights);
                                    ($grant_total +=$reportdata->total);
                                    @endphp 
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{$total_one_two_nights}}</th>
                                <th>{{$total_three_four_nights}}</th>
                                <th>{{$total_five_six_nights}}</th>
                                <th>{{$total_seven_eight_nights}}</th>
                                <th>{{$total_nine_fourteen_nights}}</th>
                                <th>{{$total_fiveteennights}}</th>
                                <th>{{$grant_total}}</th>
                            </tr>
                        </tfoot>
                    </table>
                 @elseif($report_name_id==5)
                    @php
                        $total_air=0;
                        $total_land=0;
                        $grant_total=0;
                    @endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th rowspan="2">Month</th>
                                <th colspan="2" class="text-center">Air</th>
                                <th colspan="2" class="text-center">Land</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->MonthEn}}</td>
                                    <td>{{$reportdata->air}}</td>
                                    <td>{{number_format(($reportdata->air/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->land}}</td>
                                    <td>{{number_format(($reportdata->land/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->total}}</td>
                                    @php
                                    ($total_air +=$reportdata->air);
                                    ($total_land +=$reportdata->land);
                                    ($grant_total +=$reportdata->total);
                                    @endphp  
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{$total_air}}</th>
                                <th>{{number_format(($total_air/$grant_total)*100,2)}}</th>
                                <th>{{$total_land}}</th>
                                <th>{{number_format(($total_land/$grant_total)*100,2)}}</th>
                                <th>{{$grant_total}}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @elseif($report_name_id==6)
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Mean</th>
                                <th>Median</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->Region}}</td>
                                    <td>{{$reportdata->mean}}</td>
                                    <td>{{$reportdata->median}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                 @elseif($report_name_id==7)
                    @php
                        $total_one_two_nights=0;
                        $total_three_four_nights=0;
                        $total_five_six_nights=0;
                        $total_seven_eight_nights=0;
                        $total_nine_fourteen_nights=0;
                        $total_fiveteennights=0;
                        $grant_total=0;
                    @endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Country code</th>
                                <th>1-2 Nights</th>
                                <th>3-4 Nights</th>
                                <th>5-6 Nights</th>
                                <th>7-6 Nights</th>
                                <th>9-14 Nights</th>
                                <th>15 Nights and above</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->Region}}</td>
                                    <td>{{$reportdata->one_two_nights}}</td>
                                    <td>{{$reportdata->three_four_nights}}</td>
                                    <td>{{$reportdata->five_six_nights}}</td>
                                    <td>{{$reportdata->seven_eight_nights}}</td>
                                    <td>{{$reportdata->nine_fourteen_nights}}</td>
                                    <td>{{$reportdata->fiveteennights}}</td>
                                    <td>{{$reportdata->total}}</td>
                                    @php
                                    ($total_one_two_nights +=$reportdata->one_two_nights);
                                    ($total_three_four_nights +=$reportdata->three_four_nights);
                                    ($total_five_six_nights +=$reportdata->five_six_nights);
                                    ($total_seven_eight_nights +=$reportdata->seven_eight_nights);
                                    ($total_nine_fourteen_nights +=$reportdata->nine_fourteen_nights);
                                    ($total_fiveteennights +=$reportdata->fiveteennights);
                                    ($grant_total +=$reportdata->total);
                                    @endphp 
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{$total_one_two_nights}}</th>
                                <th>{{$total_three_four_nights}}</th>
                                <th>{{$total_five_six_nights}}</th>
                                <th>{{$total_seven_eight_nights}}</th>
                                <th>{{$total_nine_fourteen_nights}}</th>
                                <th>{{$total_fiveteennights}}</th>
                                <th>{{$grant_total}}</th>
                            </tr>
                        </tfoot>
                    </table>
                 @elseif($report_name_id==8)
                    @php
                        $total_business=0;
                        $total_ete_program=0;
                        $total_hlr=0;
                        $total_it=0;
                        $total_mice=0;
                        $total_official=0;
                        $total_others=0;
                        $total_vfrg=0;
                        $grant_total=0;
                    @endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th rowspan="2">Country</th>
                                <th colspan="2">Business</th>
                                <th colspan="2">Education/Training/Exchange program</th>
                                <th colspan="2">Holiday,Leisure and Recreation</th>
                                <th colspan="2">Incentives travel(FAM,Tour leader)</th>
                                <th colspan="2">MICE</th>
                                <th colspan="2">Official</th>
                                <th colspan="2">Others</th>
                                <th colspan="2">Visiting friends and relatives/guest</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                                <th>No</th>
                                <th>%</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                <td>{{$reportdata->Region}}</td>
                                    <td>{{$reportdata->Business}}</td>
                                    <td>{{number_format(($reportdata->Business/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->ETE_Program}}</td>
                                    <td>{{number_format(($reportdata->ETE_Program/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->HLR}}</td>
                                    <td>{{number_format(($reportdata->HLR/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->IT}}</td>
                                    <td>{{number_format(($reportdata->IT/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->MICE}}</td>
                                    <td>{{number_format(($reportdata->MICE/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->Official}}</td>
                                    <td>{{number_format(($reportdata->Official/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->Others}}</td>
                                    <td>{{number_format(($reportdata->Others/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->VFRG}}</td>
                                    <td>{{number_format(($reportdata->VFRG/$reportdata->total)*100,2)}}</td>
                                    <td>{{$reportdata->total}}</td>
                                    @php
                                    ($total_business +=$reportdata->Business);
                                    ($total_ete_program +=$reportdata->ETE_Program);
                                    ($total_hlr +=$reportdata->HLR);
                                    ($total_it +=$reportdata->IT);
                                    ($total_mice +=$reportdata->MICE);
                                    ($total_official +=$reportdata->Official);
                                    ($total_others +=$reportdata->Others);
                                    ($total_vfrg +=$reportdata->VFRG);
                                    ($grant_total +=$reportdata->total);
                                    @endphp   
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{$total_business}}</th>
                                <th>{{number_format(($total_business/$grant_total)*100,2)}}</th>
                                <th>{{$total_ete_program}}</th>
                                <th>{{number_format(($total_ete_program/$grant_total)*100,2)}}</th>
                                <th>{{$total_hlr}}</th>
                                <th>{{number_format(($total_hlr/$grant_total)*100,2)}}</th>
                                <th>{{$total_it}}</th>
                                <th>{{number_format(($total_it/$grant_total)*100,2)}}</th>
                                <th>{{$total_mice}}</th>
                                <th>{{number_format(($total_mice/$grant_total)*100,2)}}</th>
                                <th>{{$total_official}}</th>
                                <th>{{number_format(($total_official/$grant_total)*100,2)}}</th>
                                <th>{{$total_others}}</th>
                                <th>{{number_format(($total_others/$grant_total)*100,2)}}</th>
                                <th>{{$total_vfrg}}</th>
                                <th>{{number_format(($total_vfrg/$grant_total)*100,2)}}</th>
                                <th>{{$grant_total}}</th>
                            </tr>
                        </tfoot>
                    </table>
                 @elseif($report_name_id==9)
                    @php
                        $total_male=0;
                        $total_female=0;
                        $grant_total=0;
                    @endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Nationality</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->Region}}</td>
                                    <td>{{$reportdata->Male}}</td>
                                    <td>{{$reportdata->Female}}</td>
                                    <td>{{$reportdata->Total}}</td>
                                    @php
                                    ($total_male +=$reportdata->Male);
                                    ($total_female +=$reportdata->Female);
                                    ($grant_total +=$reportdata->Total);
                                    @endphp 
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{ number_format($total_male),}}</th>
                                <th>{{number_format($total_female),}}</th>
                                <th>{{number_format($grant_total),}}</th>
                            </tr>
                        </tfoot>
                    </table>
                @elseif($report_name_id==10 || $report_name_id==19)
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Dzongkhag </th>
                                <th>Holiday/Leisure/Recreation</th>
                                <th>Visiting friends & relativese</th>
                                <th>Education & training</th>
                                <th>Health & medical care</th>
                                <th>Religion/pilgrimage</th>
                                <th>Personal shopping</th>
                                <th>Business & professional</th>
                                <th>Others</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->dzongkhag_name}}</td>
                                    <td>{{$reportdata->holiday}}</td>
                                    <td>{{$reportdata->visiting}}</td>
                                    <td>{{$reportdata->education}}</td> 
                                    <td>{{$reportdata->health}}</td> 
                                    <td>{{$reportdata->religion}}</td> 
                                    <td>{{$reportdata->personal}}</td> 
                                    <td>{{$reportdata->business}}</td> 
                                    <td>{{$reportdata->others}}</td> 
                                    <td>{{$reportdata->total}}</td> 
                                </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-danger text-center"> No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                @elseif($report_name_id==12)
                @php
                $dzongkhag_name = '';
                $total_business=0;
                $total_education=0;
                $total_health=0; 
                $total_holiday=0; 
                $total_others=0; 
                $total_personal=0; 
                $total_religion=0; 
                $total_visiting=0; 
                $m_business=0;
                $m_education=0;
                $m_health=0; 
                $m_holiday=0; 
                $m_others=0; 
                $m_personal=0; 
                $m_religion=0; 
                $m_visiting=0; 
                $f_business=0;
                $f_education=0;
                $f_health=0; 
                $f_holiday=0; 
                $f_others=0; 
                $f_personal=0; 
                $f_religion=0; 
                $f_visiting=0; 
				@endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Destination </th>
                                <th>Holiday/Leisure/Recreation</th>
                                <th>Visiting friends & relativese</th>
                                <th>Education & training</th>
                                <th>Health & medical care</th>
                                <th>Religion/pilgrimage</th>
                                <th>Personal shopping</th>
                                <th>Business & professional</th>
                                <th>Others</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reportdata as $reportdata)
                                @if ($dzongkhag_name!=$reportdata->dzongkhag_name && $reportdata->dzongkhag_name!="Total")
                                    <tr>
                                        <th colspan="9" style="background-color: #d1d1d1">  {{$reportdata->dzongkhag_name}}</th> 
                                    @php
                                        $dzongkhag_name = $reportdata->dzongkhag_name
                                    @endphp 
                                    </tr>
                                    <tr>
                                        <td>Female</td>
                                        <td>{{$reportdata->holiday}}</td>
                                        <td>{{$reportdata->visiting}}</td>
                                        <td>{{$reportdata->education}}</td> 
                                        <td>{{$reportdata->health}}</td> 
                                        <td>{{$reportdata->religion}}</td> 
                                        <td>{{$reportdata->personal}}</td> 
                                        <td>{{$reportdata->business}}</td> 
                                        <td>{{$reportdata->others}}</td> 
                                        @php
                                        ($f_business +=$reportdata->business);
                                        ($f_education +=$reportdata->education);
                                        ($f_health +=$reportdata->health); 
                                        ($f_holiday +=$reportdata->holiday); 
                                        ($f_others +=$reportdata->others); 
                                        ($f_personal +=$reportdata->personal); 
                                        ($f_religion +=$reportdata->religion); 
                                        ($f_visiting +=$reportdata->visiting); 
                                        @endphp
                                    </tr>
                                @else
                                    @if ($reportdata->dzongkhag_name!="Total")
                                        <tr>
                                            <td>Male</td>
                                            <td>{{$reportdata->holiday}}</td>
                                            <td>{{$reportdata->visiting}}</td>
                                            <td>{{$reportdata->education}}</td> 
                                            <td>{{$reportdata->health}}</td> 
                                            <td>{{$reportdata->religion}}</td> 
                                            <td>{{$reportdata->personal}}</td> 
                                            <td>{{$reportdata->business}}</td> 
                                            <td>{{$reportdata->others}}</td> 
                                            @php
                                            ($m_business +=$reportdata->business);
                                            ($m_education +=$reportdata->education);
                                            ($m_health +=$reportdata->health); 
                                            ($m_holiday +=$reportdata->holiday); 
                                            ($m_others +=$reportdata->others); 
                                            ($m_personal +=$reportdata->personal); 
                                            ($m_religion +=$reportdata->religion); 
                                            ($m_visiting +=$reportdata->visiting); 
                                            @endphp
                                        </tr>
                                    @endif
                                @endif
                            @empty
                            <tr>
                                <td colspan="10" class="text-danger text-center"> No data available</td>
                            </tr>
                            @endforelse
                            <tr>
                                <th>Total</th>
                                <th>{{ number_format($f_holiday + $m_holiday),}}</th>
                                <th>{{ number_format($f_visiting + $m_visiting),}}</th>
                                <th>{{ number_format($f_education + $m_education),}}</th>
                                <th>{{ number_format($f_health + $m_health),}}</th>
                                <th>{{ number_format($f_religion + $m_religion),}}</th>
                                <th>{{ number_format($f_personal + $m_personal),}}</th>
                                <th>{{ number_format($f_business + $m_business),}}</th>
                                <th>{{ number_format($f_others + $m_others),}}</th>
                            </tr>
                            <tr>
                                <th>Female</th>
                                <th>{{ number_format($f_holiday), }}</th>
                                <th>{{ number_format($f_visiting),}}</th>
                                <th>{{ number_format($f_education),}}</th>
                                <th>{{ number_format($f_health),}}</th>
                                <th>{{ number_format($f_religion),}}</th>
                                <th>{{ number_format($f_personal),}}</th>
                                <th>{{ number_format($f_business),}}</th>
                                <th>{{ number_format($f_others),}}</th>
                            </tr>
                            <tr>
                                <th>Male</th>
                                <th>{{ number_format($m_holiday), }}</th>
                                <th>{{ number_format($m_visiting),}}</th>
                                <th>{{ number_format($m_education),}}</th>
                                <th>{{ number_format($m_health), }}</th>
                                <th>{{ number_format($m_religion), }}</th>
                                <th>{{ number_format($m_personal), }}</th>
                                <th>{{ number_format($m_business),}}</th>
                                <th>{{ number_format($m_others), }}</th>
                            </tr>
                        </tbody>
                    </table>
                @elseif($report_name_id==13 || $report_name_id==15)
                @php
                    $total_bumthang=0; 
                    $total_chukha=0;
                    $total_dagana=0; 
                    $total_gasa=0; 
                    $total_haa=0;
                    $total_lhuentse=0; 
                    $total_mongar=0; 
                    $total_paro=0; 
                    $total_pemagatshel=0; 
                    $total_punakha=0; 
                    $total_samdrupjongkhar=0; 
                    $total_samtse=0; 
                    $total_sarpang=0; 
                    $total_thimphu=0; 
                    $total_trashigang=0; 
                    $total_trashiyangtse=0; 
                    $total_trongsa=0; 
                    $total_tsirang=0; 
                    $total_wangduephodrang=0; 
                    $total_zhemgang=0; 
                    $grant_total=0;
                @endphp
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Origin Dzongkhag </th>
                                <th>Bumthang</th>
                                <th>Chhukha</th>
                                <th>Dagana</th>
                                <th>Gasa</th>
                                <th>Haa</th>
                                <th>Lhuentse</th>
                                <th>Mongar</th>
                                <th>Paro</th>
                                <th>PemaGatshel</th>
                                <th>Punakha</th>
                                <th>S/J</th>
                                <th>Samtse</th>
                                <th>Sarpang</th>
                                <th>Thimphu</th>
                                <th>T/gang</th>
                                <th>T/yangtse</th>
                                <th>Trongsa</th>
                                <th>Tsirang</th>
                                <th>W/Phodrang</th>
                                <th>Zhemgang</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reportdata as $reportdata)
                                <tr>
                                    <td>{{$reportdata->dzongkhag_name}}</td>
                                    <td>{{$reportdata->bumthang}}</td>
                                    <td>{{$reportdata->chukha}}</td>
                                    <td>{{$reportdata->dagana}}</td> 
                                    <td>{{$reportdata->gasa}}</td> 
                                    <td>{{$reportdata->haa}}</td> 
                                    <td>{{$reportdata->lhuentse}}</td> 
                                    <td>{{$reportdata->mongar}}</td> 
                                    <td>{{$reportdata->paro}}</td> 
                                    <td>{{$reportdata->pemagatshel}}</td> 
                                    <td>{{$reportdata->punakha}}</td> 
                                    <td>{{$reportdata->samdrupjongkhar}}</td> 
                                    <td>{{$reportdata->samtse}}</td> 
                                    <td>{{$reportdata->sarpang}}</td> 
                                    <td>{{$reportdata->thimphu}}</td> 
                                    <td>{{$reportdata->trashigang}}</td> 
                                    <td>{{$reportdata->trashiyangtse}}</td> 
                                    <td>{{$reportdata->trongsa}}</td> 
                                    <td>{{$reportdata->tsirang}}</td> 
                                    <td>{{$reportdata->wangduephodrang}}</td> 
                                    <td>{{$reportdata->zhemgang}}</td> 
                                    <td>{{$reportdata->total}}</td> 
                                    @php
                                        ($total_bumthang +=$reportdata->bumthang); 
                                        ($total_chukha +=$reportdata->chukha);
                                        ($total_dagana +=$reportdata->dagana); 
                                        ($total_gasa +=$reportdata->gasa); 
                                        ($total_haa +=$reportdata->haa);
                                        ($total_lhuentse +=$reportdata->lhuentse); 
                                        ($total_mongar +=$reportdata->mongar); 
                                        ($total_paro +=$reportdata->paro); 
                                        ($total_pemagatshel +=$reportdata->pemagatshel); 
                                        ($total_punakha +=$reportdata->punakha); 
                                        ($total_samdrupjongkhar +=$reportdata->samdrupjongkhar); 
                                        ($total_samtse +=$reportdata->samtse); 
                                        ($total_sarpang +=$reportdata->sarpang); 
                                        ($total_thimphu +=$reportdata->thimphu); 
                                        ($total_trashigang +=$reportdata->trashigang); 
                                        ($total_trashiyangtse +=$reportdata->trashiyangtse); 
                                        ($total_trongsa +=$reportdata->trongsa); 
                                        ($total_tsirang +=$reportdata->tsirang); 
                                        ($total_wangduephodrang +=$reportdata->wangduephodrang); 
                                        ($total_zhemgang +=$reportdata->zhemgang); 
                                        ($grant_total +=$reportdata->total);
                                    @endphp
                                </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-danger text-center"> No data available</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td>Total</td>
                                <th>{{ number_format($total_bumthang),}}</th>
                                <th>{{ number_format($total_chukha),}}</th>
                                <th>{{ number_format($total_dagana),}}</th>
                                <th>{{ number_format($total_gasa),}}</th>
                                <th>{{ number_format($total_haa),}}</th>
                                <th>{{ number_format($total_lhuentse),}}</th>
                                <th>{{ number_format($total_mongar) ,}}</th>
                                <th>{{ number_format($total_paro),}}</th>
                                <th>{{ number_format($total_pemagatshel),}}</th> 
                                <th>{{ number_format($total_punakha),}}</th>
                                <th>{{ number_format($total_samdrupjongkhar),}}</th> 
                                <th>{{ number_format($total_samtse),}}</th>
                                <th>{{ number_format($total_sarpang) ,}}</th>
                                <th>{{ number_format($total_thimphu),}}</th>
                                <th>{{ number_format($total_trashigang) ,}}</th>
                                <th>{{ number_format($total_trashiyangtse),}}</th>
                                <th>{{ number_format($total_trongsa), }}</th>
                                <th>{{ number_format($total_tsirang), }}</th>
                                <th>{{ number_format($total_wangduephodrang),}} </th> 
                                <th>{{ number_format($total_zhemgang),}}</th> 
                                <th>{{ number_format($grant_total), }}</th>
                            </tr>
                        </tbody>
                    </table>
                    @elseif($report_name_id==14)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Origin Dzongkhag </th>
                                    <th>Bumthang</th>
                                    <th>Chhukha</th>
                                    <th>Dagana</th>
                                    <th>Gasa</th>
                                    <th>Haa</th>
                                    <th>Lhuentse</th>
                                    <th>Mongar</th>
                                    <th>Paro</th>
                                    <th>PemaGatshel</th>
                                    <th>Punakha</th>
                                    <th>S/J</th>
                                    <th>Samtse</th>
                                    <th>Sarpang</th>
                                    <th>Thimphu</th>
                                    <th>T/gang</th>
                                    <th>T/yangtse</th>
                                    <th>Trongsa</th>
                                    <th>Tsirang</th>
                                    <th>W/Phodrang</th>
                                    <th>Zhemgang</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reportdata as $reportdata)
                                @if ($reportdata->dzongkhag_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dzongkhag_name}}</th>
                                        <th>{{$reportdata->bumthang}}</th>
                                        <th>{{$reportdata->chukha}}</th>
                                        <th>{{$reportdata->dagana}}</th> 
                                        <th>{{$reportdata->gasa}}</th> 
                                        <th>{{$reportdata->haa}}</th> 
                                        <th>{{$reportdata->lhuentse}}</th> 
                                        <th>{{$reportdata->mongar}}</th> 
                                        <th>{{$reportdata->paro}}</th> 
                                        <th>{{$reportdata->pemagatshel}}</th> 
                                        <th>{{$reportdata->punakha}}</th> 
                                        <th>{{$reportdata->samdrupjongkhar}}</th> 
                                        <th>{{$reportdata->samtse}}</th> 
                                        <th>{{$reportdata->sarpang}}</th> 
                                        <th>{{$reportdata->thimphu}}</th> 
                                        <th>{{$reportdata->trashigang}}</th> 
                                        <th>{{$reportdata->trashiyangtse}}</th> 
                                        <th>{{$reportdata->trongsa}}</th> 
                                        <th>{{$reportdata->tsirang}}</th> 
                                        <th>{{$reportdata->wangduephodrang}}</th>                                                    
                                        <th>{{$reportdata->zhemgang}}</th> 
                                        <th>{{$reportdata->total}}</th> 
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dzongkhag_name}}</td>
                                        <td>{{$reportdata->bumthang}}</td>
                                        <td>{{$reportdata->chukha}}</td>
                                        <td>{{$reportdata->dagana}}</td> 
                                        <td>{{$reportdata->gasa}}</td> 
                                        <td>{{$reportdata->haa}}</td> 
                                        <td>{{$reportdata->lhuentse}}</td> 
                                        <td>{{$reportdata->mongar}}</td> 
                                        <td>{{$reportdata->paro}}</td> 
                                        <td>{{$reportdata->pemagatshel}}</td> 
                                        <td>{{$reportdata->punakha}}</td> 
                                        <td>{{$reportdata->samdrupjongkhar}}</td> 
                                        <td>{{$reportdata->samtse}}</td> 
                                        <td>{{$reportdata->sarpang}}</td> 
                                        <td>{{$reportdata->thimphu}}</td> 
                                        <td>{{$reportdata->trashigang}}</td> 
                                        <td>{{$reportdata->trashiyangtse}}</td> 
                                        <td>{{$reportdata->trongsa}}</td> 
                                        <td>{{$reportdata->tsirang}}</td> 
                                        <td>{{$reportdata->wangduephodrang}}</td>                                                    
                                        <td>{{$reportdata->zhemgang}}</td> 
                                        <td>{{$reportdata->total}}</td> 
                                    </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="10" class="text-danger text-center table-condensed"> No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==24)
                        @php
                            $total_visitor=0;
                            $total_night=0;
                            $total_avg_ept=0;
                            $total_expenditure=0;
                            $total_avd_epn=0;
                        @endphp
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th rowspan="2">Destination</th>
                                    <th colspan="2" class="text-center">Visitors</th>
                                    <th colspan="2" class="text-center">Nights</th>
                                    <th rowspan="2">Average expenditure per trip (Nu.)</th>
                                    <th rowspan="2">Total expenditure(Nu. million)</th>
                                    <th rowspan="2">Average expenditure per night(Nu.)</th>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th>%</th>
                                    <th>No</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dzongkhag_name}}</td>
                                        <td>{{$reportdata->visitors}}</td>
                                        <td>{{$reportdata->visitors_percent}}</td>
                                        <td>{{$reportdata->nights}}</td>
                                        <td>{{$reportdata->nights_percent}}</td>
                                        <td>{{$reportdata->avg_expenditure_trip}}</td>
                                        <td>{{$reportdata->tot_expenditure}}</td>
                                        <td>{{$reportdata->avg_expenditure_night}}</td>
                                        @php
                                        ($total_visitor +=$reportdata->visitors);
                                        ($total_night +=$reportdata->nights);
                                        ($total_avg_ept +=$reportdata->avg_expenditure_trip);
                                        ($total_expenditure +=$reportdata->tot_expenditure);
                                        ($total_avd_epn +=$reportdata->avg_expenditure_night);
                                        @endphp  
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>{{ number_format($total_visitor),}}</th>
                                    <th>{{number_format(($total_visitor/$total_visitor)*100,0)}}</th>
                                    <th>{{number_format($total_night),}}</th>
                                    <th>{{number_format(($total_night/$total_night)*100,0)}}</th>
                                    <th>{{$total_avg_ept}}</th>
                                    <th>{{ number_format($total_expenditure,2)}}</th>
                                    <th>{{$total_avd_epn}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @elseif($report_name_id==26)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Tour packages</th>
                                    <th>Airfare</th>
                                    <th>Long distance transportation</th>
                                    <th>Car renting/hiring</th>
                                    <th>fuel cost</th>
                                    <th>Local transfortation</th>
                                    <th>Accommodation</th>
                                    <th>Food and beverages</th>
                                    <th>Medical and treatment</th>
                                    <th>Shopping</th>
                                    <th>Entertainment</th>
                                    <th>MICE/training fees/workshop etc</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->tour_package}}</td>
                                        <td>{{$reportdata->air}}</td>
                                        <td>{{$reportdata->long_distance}}</td>
                                        <td>{{$reportdata->car_rental}}</td>
                                        <td>{{$reportdata->fuel_cost}}</td>
                                        <td>{{$reportdata->local_transport}}</td>
                                        <td>{{$reportdata->accommodation}}</td>
                                        <td>{{$reportdata->food}}</td>
                                        <td>{{$reportdata->medical}}</td>
                                        <td>{{$reportdata->shopping}}</td>
                                        <td>{{$reportdata->entertainment}}</td>
                                        <td>{{$reportdata->mice}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="15" class="text-danger text-center"> No data available</td>
                                </tr>
                                        
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==27)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Tour packages</th>
                                    <th>Airfare</th>
                                    <th>Long distance transportation</th>
                                    <th>Car renting/hiring</th>
                                    <th>fuel cost</th>
                                    <th>Local transfortation</th>
                                    <th>Accommodation</th>
                                    <th>Food and beverages</th>
                                    <th>Medical and treatment</th>
                                    <th>Shopping</th>
                                    <th>Entertainment</th>
                                    <th>MICE/training fees/workshop etc</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    @if ($reportdata->dropdown_name=="Total")
                                        <tr>
                                            <th>{{$reportdata->dropdown_name}}</th>
                                            <th>{{$reportdata->tour_package}}</th>
                                            <th>{{$reportdata->air}}</th>
                                            <th>{{$reportdata->long_distance}}</th>
                                            <th>{{$reportdata->car_rental}}</th>
                                            <th>{{$reportdata->fuel_cost}}</th>
                                            <th>{{$reportdata->local_transport}}</th>
                                            <th>{{$reportdata->accommodation}}</th>
                                            <th>{{$reportdata->food}}</th>
                                            <th>{{$reportdata->medical}}</th>
                                            <th>{{$reportdata->shopping}}</th>
                                            <th>{{$reportdata->entertainment}}</th>
                                            <th>{{$reportdata->mice}}</th>
                                            <th>{{$reportdata->others}}</th>
                                            <th>{{$reportdata->total}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$reportdata->dropdown_name}}</td>
                                            <td>{{$reportdata->tour_package}}</td>
                                            <td>{{$reportdata->air}}</td>
                                            <td>{{$reportdata->long_distance}}</td>
                                            <td>{{$reportdata->car_rental}}</td>
                                            <td>{{$reportdata->fuel_cost}}</td>
                                            <td>{{$reportdata->local_transport}}</td>
                                            <td>{{$reportdata->accommodation}}</td>
                                            <td>{{$reportdata->food}}</td>
                                            <td>{{$reportdata->medical}}</td>
                                            <td>{{$reportdata->shopping}}</td>
                                            <td>{{$reportdata->entertainment}}</td>
                                            <td>{{$reportdata->mice}}</td>
                                            <td>{{$reportdata->others}}</td>
                                            <td>{{$reportdata->total}}</td>
                                        </tr>
                                    @endif
                                @empty
                                <tr>
                                    <td colspan="15" class="text-danger text-center"> No data available</td>
                                </tr>
                                        
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==34)
                        @php
                        $dzongkhag_name = '';
                        $total_business=0;
                        $total_education=0;
                        $total_health=0; 
                        $total_holiday=0; 
                        $total_others=0; 
                        $total_personal=0; 
                        $total_religion=0; 
                        $total_visiting=0; 
                        $m_business=0;
                        $m_education=0;
                        $m_health=0; 
                        $m_holiday=0; 
                        $m_others=0; 
                        $m_personal=0; 
                        $m_religion=0; 
                        $m_visiting=0; 
                        $f_business=0;
                        $f_education=0;
                        $f_health=0; 
                        $f_holiday=0; 
                        $f_others=0; 
                        $f_personal=0; 
                        $f_religion=0; 
                        $f_visiting=0; 
                        @endphp
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Destination </th>
                                    <th>Holiday/Leisure/Recreation</th>
                                    <th>Visiting friends & relativese</th>
                                    <th>Education & training</th>
                                    <th>Health & medical care</th>
                                    <th>Religion/pilgrimage</th>
                                    <th>Personal shopping</th>
                                    <th>Business & professional</th>
                                    <th>Others</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reportdata as $reportdata)
                                    @if ($dzongkhag_name!=$reportdata->dzongkhag_name && $reportdata->dzongkhag_name!="Total")
                                        <tr>
                                            <th colspan="9" style="background-color: #d1d1d1">  {{$reportdata->dzongkhag_name}}</th> 
                                        @php
                                            $dzongkhag_name = $reportdata->dzongkhag_name
                                        @endphp 
                                        </tr>
                                        <tr>
                                            <td>Female</td>
                                            <td>{{$reportdata->holiday}}</td>
                                            <td>{{$reportdata->visiting}}</td>
                                            <td>{{$reportdata->education}}</td> 
                                            <td>{{$reportdata->health}}</td> 
                                            <td>{{$reportdata->religion}}</td> 
                                            <td>{{$reportdata->personal}}</td> 
                                            <td>{{$reportdata->business}}</td> 
                                            <td>{{$reportdata->others}}</td> 
                                            @php
                                            ($f_business +=$reportdata->business);
                                            ($f_education +=$reportdata->education);
                                            ($f_health +=$reportdata->health); 
                                            ($f_holiday +=$reportdata->holiday); 
                                            ($f_others +=$reportdata->others); 
                                            ($f_personal +=$reportdata->personal); 
                                            ($f_religion +=$reportdata->religion); 
                                            ($f_visiting +=$reportdata->visiting); 
                                            @endphp
                                        </tr>
                                    @else
                                        @if ($reportdata->dzongkhag_name!="Total")
                                            <tr>
                                                <td>Male</td>
                                                <td>{{$reportdata->holiday}}</td>
                                                <td>{{$reportdata->visiting}}</td>
                                                <td>{{$reportdata->education}}</td> 
                                                <td>{{$reportdata->health}}</td> 
                                                <td>{{$reportdata->religion}}</td> 
                                                <td>{{$reportdata->personal}}</td> 
                                                <td>{{$reportdata->business}}</td> 
                                                <td>{{$reportdata->others}}</td> 
                                                @php
                                                ($m_business +=$reportdata->business);
                                                ($m_education +=$reportdata->education);
                                                ($m_health +=$reportdata->health); 
                                                ($m_holiday +=$reportdata->holiday); 
                                                ($m_others +=$reportdata->others); 
                                                ($m_personal +=$reportdata->personal); 
                                                ($m_religion +=$reportdata->religion); 
                                                ($m_visiting +=$reportdata->visiting); 
                                                @endphp
                                            </tr>
                                        @endif
                                    @endif
                                @empty
                                <tr>
                                    <td colspan="10" class="text-danger text-center"> No data available</td>
                                </tr>
                                @endforelse
                                <tr>
                                    <th>Total</th>
                                    <th>{{ number_format($f_holiday + $m_holiday),}}</th>
                                    <th>{{ number_format($f_visiting + $m_visiting),}}</th>
                                    <th>{{ number_format($f_education + $m_education),}}</th>
                                    <th>{{ number_format($f_health + $m_health),}}</th>
                                    <th>{{ number_format($f_religion + $m_religion),}}</th>
                                    <th>{{ number_format($f_personal + $m_personal),}}</th>
                                    <th>{{ number_format($f_business + $m_business),}}</th>
                                    <th>{{ number_format($f_others + $m_others),}}</th>
                                </tr>
                                <tr>
                                    <th>Female</th>
                                    <th>{{ number_format($f_holiday), }}</th>
                                    <th>{{ number_format($f_visiting),}}</th>
                                    <th>{{ number_format($f_education),}}</th>
                                    <th>{{ number_format($f_health),}}</th>
                                    <th>{{ number_format($f_religion),}}</th>
                                    <th>{{ number_format($f_personal),}}</th>
                                    <th>{{ number_format($f_business),}}</th>
                                    <th>{{ number_format($f_others),}}</th>
                                </tr>
                                <tr>
                                    <th>Male</th>
                                    <th>{{ number_format($m_holiday), }}</th>
                                    <th>{{ number_format($m_visiting),}}</th>
                                    <th>{{ number_format($m_education),}}</th>
                                    <th>{{ number_format($m_health), }}</th>
                                    <th>{{ number_format($m_religion), }}</th>
                                    <th>{{ number_format($m_personal), }}</th>
                                    <th>{{ number_format($m_business),}}</th>
                                    <th>{{ number_format($m_others), }}</th>
                                </tr>
                            </tbody>
                        </table>
                    @elseif($report_name_id==30)
                        @php
                            $total_male=0;
                            $total_female=0;
                            $grant_total=0;
                        @endphp
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th rowspan="2">Destination</th>
                                    <th colspan="2">Male</th>
                                    <th colspan="2">Female</th>
                                    <th rowspan="2">Total</th>
                                </tr>
                                <tr>
                                    <th>No.</th>
                                    <th>%</th>
                                    <th>No.</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dzongkhag_name}}</td>
                                        <td>{{$reportdata->male}}</td>
                                        <td>{{$reportdata->male_percent}}</td>
                                        <td>{{$reportdata->female}}</td>
                                        <td>{{$reportdata->female_percent}}</td>
                                        <td>{{$reportdata->total }}</td>
                                        @php
                                        ($total_male +=$reportdata->male);
                                        ($total_female +=$reportdata->female);
                                        ($grant_total +=$reportdata->total);
                                        @endphp 
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>{{ number_format($total_male),}}</th>
                                    <th>{{ number_format(($total_male/$grant_total)*100,2)}}</th>
                                    <th>{{number_format($total_female),}}</th>
                                    <th>{{ number_format(($total_female/$grant_total)*100,2)}}</th>
                                    <th>{{number_format($grant_total),}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @elseif($report_name_id==35)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Destination </th>
                                    <th>Holiday/Leisure/Recreation</th>
                                    <th>Visiting friends & relativese</th>
                                    <th>Education & training</th>
                                    <th>Health & medical care</th>
                                    <th>Religion/pilgrimage</th>
                                    <th>Personal shopping</th>
                                    <th>Business & professional</th>
                                    <th>Others</th>
                                    <th>Total Visiter</th>
                                    <th>Total Expenditure(In Nu.million)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reportdata as $reportdata)
                                    @if ($reportdata->dzongkhag_name=="Total")
                                    <tr>
                                        <th>{{ $reportdata->dzongkhag_name }}</th>
                                        <th>{{$reportdata->holiday}}</th>
                                        <th>{{$reportdata->visiting}}</th>
                                        <th>{{$reportdata->education}}</th> 
                                        <th>{{$reportdata->health}}</th> 
                                        <th>{{$reportdata->religion}}</th> 
                                        <th>{{$reportdata->personal}}</th> 
                                        <th>{{$reportdata->business}}</th> 
                                        <th>{{$reportdata->others}}</th> 
                                        <th>{{$reportdata->total_visitor}}</th> 
                                        <th>{{$reportdata->total_expenditure}}</th> 
                                    </tr>
                                    @else
                                    <tr>
                                        <td>{{ $reportdata->dzongkhag_name }}</td>
                                        <td>{{$reportdata->holiday}}</td>
                                        <td>{{$reportdata->visiting}}</td>
                                        <td>{{$reportdata->education}}</td> 
                                        <td>{{$reportdata->health}}</td> 
                                        <td>{{$reportdata->religion}}</td> 
                                        <td>{{$reportdata->personal}}</td> 
                                        <td>{{$reportdata->business}}</td> 
                                        <td>{{$reportdata->others}}</td> 
                                        <td>{{$reportdata->total_visitor}}</td> 
                                        <td>{{$reportdata->total_expenditure}}</td> 
                                    </tr>
                                    @endif
                                @empty
                                <tr>
                                    <td colspan="10" class="text-danger text-center"> No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==36 || $report_name_id==37)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Long distance transportation</th>
                                    <th>Car renting/hiring</th>
                                    <th>fuel cost</th>
                                    <th>Local transfortation</th>
                                    <th>Food and beverages</th>
                                    <th>Medical and treatment</th>
                                    <th>Shopping</th>
                                    <th>Entertainment</th>
                                    <th>MICE/training fees/workshop etc</th>
                                    <th>Others</th>
                                    <th>Total Exp.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    @if ($reportdata->dropdown_name=="Total")
                                        <tr>
                                            <th>{{$reportdata->dropdown_name}}</th>
                                            <th>{{$reportdata->long_distance}}</th>
                                            <th>{{$reportdata->car_rental}}</th>
                                            <th>{{$reportdata->fuel_cost}}</th>
                                            <th>{{$reportdata->local_transport}}</th>
                                            <th>{{$reportdata->food}}</th>
                                            <th>{{$reportdata->medical}}</th>
                                            <th>{{$reportdata->shopping}}</th>
                                            <th>{{$reportdata->entertainment}}</th>
                                            <th>{{$reportdata->mice}}</th>
                                            <th>{{$reportdata->others}}</th>
                                            <th>{{$reportdata->total_expenditure}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$reportdata->dropdown_name}}</td>
                                            <td>{{$reportdata->long_distance}}</td>
                                            <td>{{$reportdata->car_rental}}</td>
                                            <td>{{$reportdata->fuel_cost}}</td>
                                            <td>{{$reportdata->local_transport}}</td>
                                            <td>{{$reportdata->food}}</td>
                                            <td>{{$reportdata->medical}}</td>
                                            <td>{{$reportdata->shopping}}</td>
                                            <td>{{$reportdata->entertainment}}</td>
                                            <td>{{$reportdata->mice}}</td>
                                            <td>{{$reportdata->others}}</td>
                                            <td>{{$reportdata->total_expenditure}}</td>
                                        </tr>
                                    @endif
                                @empty
                                <tr>
                                    <td colspan="15" class="text-danger text-center"> No data available</td>
                                </tr>  
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==40)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Destination</th>
                                    <th>Visitor(Number)</th>
                                    <th>Total trip expediture(in Nu.Million)</th>
                                    <th>Mean trip expenditure per visitor(in Nu.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dzongkhag_name}}</td>
                                        <td>{{$reportdata->visitors}}</td>
                                        <td>{{$reportdata->avg_expenditure_trip}}</td>
                                        <td>{{$reportdata->tot_expenditure}}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                     @elseif($report_name_id==41)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Main Destination</th>
                                    <th>No</th>
                                    <th>Percent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reportdata as $reportdata)
                                @if ($reportdata->dropdown_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dropdown_name}}</th>
                                        <th>{{$reportdata->visitors}}</th>
                                        <th>{{$reportdata->percent}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->visitors}}</td>
                                        <td>{{$reportdata->percent}}</td>
                                    </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==42)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Main Destination</th>
                                    <th>Total Visitor nights</th>
                                    <th>Mean visitors nights</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->nights}}</td>
                                        <td>{{$reportdata->mean}}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                     @elseif($report_name_id==43 || $report_name_id==44)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Holiday/Leisure/Recreation</th>
                                    <th>Visiting  friends & relatives</th>
                                    <th>Education & Training</th>
                                    <th>Health & medical care</th>
                                    <th>Religion/prilgrimage</th>
                                    <th>Personal Shopping</th>
                                    <th>Business and professional</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->holiday}}</td>
                                        <td>{{$reportdata->visiting}}</td>
                                        <td>{{$reportdata->education}}</td>
                                        <td>{{$reportdata->health}}</td>
                                        <td>{{$reportdata->religion}}</td>
                                        <td>{{$reportdata->personal}}</td>
                                        <td>{{$reportdata->business}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==46)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Air</th>
                                    <th>Own vechicle</th>
                                    <th>Public Transport</th>
                                    <th>Vechicle arranged by travel agent</th>
                                    <th>Car rental/hiring</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                @if ($reportdata->dropdown_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dropdown_name}}</th>
                                        <th>{{$reportdata->air}}</th>
                                        <th>{{$reportdata->own_vehicle}}</th>
                                        <th>{{$reportdata->public_transport}}</th>
                                        <th>{{$reportdata->vehicle_arranged}}</th>
                                        <th>{{$reportdata->car}}</th>
                                        <th>{{$reportdata->others}}</th>
                                        <th>{{$reportdata->total}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->air}}</td>
                                        <td>{{$reportdata->own_vehicle}}</td>
                                        <td>{{$reportdata->public_transport}}</td>
                                        <td>{{$reportdata->vehicle_arranged}}</td>
                                        <td>{{$reportdata->car}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @endif
                                    
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==46)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Air</th>
                                    <th>Own vechicle</th>
                                    <th>Public Transport</th>
                                    <th>Vechicle arranged by travel agent</th>
                                    <th>Car rental/hiring</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                @if ($reportdata->dropdown_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dropdown_name}}</th>
                                        <th>{{$reportdata->air}}</th>
                                        <th>{{$reportdata->own_vehicle}}</th>
                                        <th>{{$reportdata->public_transport}}</th>
                                        <th>{{$reportdata->vehicle_arranged}}</th>
                                        <th>{{$reportdata->car}}</th>
                                        <th>{{$reportdata->others}}</th>
                                        <th>{{$reportdata->total}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->air}}</td>
                                        <td>{{$reportdata->own_vehicle}}</td>
                                        <td>{{$reportdata->public_transport}}</td>
                                        <td>{{$reportdata->vehicle_arranged}}</td>
                                        <td>{{$reportdata->car}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @endif
                                    
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==48)
                    @php
                        $total_yes=0;
                        $total_no=0;
                        $grant_total=0;
                    @endphp
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th rowspan="2">Main destination</th>
                                    <th colspan="2">Package Option</th>
                                    <th rowspan="2">Total</th>
                                </tr>
                                <tr>
                                    <th>Yes</th>
                                    <th>No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->yes_option}}</td>
                                        <td>{{$reportdata->no_option}}</td>
                                        <td>{{$reportdata->total}}</td>
                                        @php
                                            ($total_yes +=$reportdata->yes_option);
                                            ($total_no +=$reportdata->no_option);
                                            ($grant_total +=$reportdata->total);
                                        @endphp
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>{{ number_format($total_yes), }}</th>
                                    <th>{{ number_format($total_no), }}</th>
                                    <th>{{ number_format($grant_total), }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @elseif($report_name_id==50)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Main destination</th>
                                    <th>Total Trip Expenditure(Nu.Million)</th>
                                    <th>Mean trip expenditure(in Nu)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->tot_expenditure}}</td>
                                        <td>{{$reportdata->avg_expenditure_trip}}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==52)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Tour packages</th>
                                    <th>Airfare</th>
                                    <th>Long distance transportation</th>
                                    <th>Accommodation</th>
                                    <th>Car renting/hiring</th>
                                    <th>fuel cost</th>
                                    <th>Local transfortation</th>
                                    <th>Food and beverages</th>
                                    <th>Medical</th>
                                    <th>Personal Shopping</th>
                                    <th>Entertainment</th>
                                    <th>MICE</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                @if ($reportdata->dropdown_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dropdown_name}}</th>
                                        <th>{{$reportdata->tour_package}}</th>
                                        <th>{{$reportdata->air}}</th>
                                        <th>{{$reportdata->long_distance}}</th>
                                        <th>{{$reportdata->accommodation}}</th>
                                        <th>{{$reportdata->car_rental}}</th>
                                        <th>{{$reportdata->fuel_cost}}</th>
                                        <th>{{$reportdata->local_transport}}</th>
                                        <th>{{$reportdata->food}}</th>
                                        <th>{{$reportdata->medical}}</th>
                                        <th>{{$reportdata->shopping}}</th>
                                        <th>{{$reportdata->entertainment}}</th>
                                        <th>{{$reportdata->mice}}</th>
                                        <th>{{$reportdata->others}}</th>
                                        <th>{{$reportdata->total}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->tour_package}}</td>
                                        <td>{{$reportdata->air}}</td>
                                        <td>{{$reportdata->long_distance}}</td>
                                        <td>{{$reportdata->accommodation}}</td>
                                        <td>{{$reportdata->car_rental}}</td>
                                        <td>{{$reportdata->fuel_cost}}</td>
                                        <td>{{$reportdata->local_transport}}</td>
                                        <td>{{$reportdata->food}}</td>
                                        <td>{{$reportdata->medical}}</td>
                                        <td>{{$reportdata->shopping}}</td>
                                        <td>{{$reportdata->entertainment}}</td>
                                        <td>{{$reportdata->mice}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="15" class="text-danger text-center"> No data available</td>
                                </tr>
                                        
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==53)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Tour packages</th>
                                    <th>Airfare</th>
                                    <th>Long distance transportation</th>
                                    <th>Accommodation</th>
                                    <th>Car renting/hiring</th>
                                    <th>fuel cost</th>
                                    <th>Local transfortation</th>
                                    <th>Food and beverages</th>
                                    <th>Medical</th>
                                    <th>Personal Shopping</th>
                                    <th>Entertainment</th>
                                    <th>MICE</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                @if ($reportdata->dropdown_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dropdown_name}}</th>
                                        <th>{{$reportdata->tour_package}}</th>
                                        <th>{{$reportdata->air}}</th>
                                        <th>{{$reportdata->long_distance}}</th>
                                        <th>{{$reportdata->accommodation}}</th>
                                        <th>{{$reportdata->car_rental}}</th>
                                        <th>{{$reportdata->fuel_cost}}</th>
                                        <th>{{$reportdata->local_transport}}</th>
                                        <th>{{$reportdata->food}}</th>
                                        <th>{{$reportdata->medical}}</th>
                                        <th>{{$reportdata->shopping}}</th>
                                        <th>{{$reportdata->entertainment}}</th>
                                        <th>{{$reportdata->mice}}</th>
                                        <th>{{$reportdata->others}}</th>
                                        <th>{{$reportdata->total}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->tour_package}}</td>
                                        <td>{{$reportdata->air}}</td>
                                        <td>{{$reportdata->long_distance}}</td>
                                        <td>{{$reportdata->accommodation}}</td>
                                        <td>{{$reportdata->car_rental}}</td>
                                        <td>{{$reportdata->fuel_cost}}</td>
                                        <td>{{$reportdata->local_transport}}</td>
                                        <td>{{$reportdata->food}}</td>
                                        <td>{{$reportdata->medical}}</td>
                                        <td>{{$reportdata->shopping}}</td>
                                        <td>{{$reportdata->entertainment}}</td>
                                        <td>{{$reportdata->mice}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="15" class="text-danger text-center"> No data available</td>
                                </tr>
                                        
                                @endforelse
                            </tbody>
                        </table>
                     @elseif($report_name_id==55)
                        @php
                            $total_male=0;
                            $total_female=0;
                            $grant_total=0;
                        @endphp
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th rowspan="2">Purpose</th>
                                    <th colspan="2" class="text-center">Male</th>
                                    <th colspan="2" class="text-center">Female</th>
                                    <th rowspan="2">Total</th>
                                </tr>
                                <tr>
                                    <th>Number</th>
                                    <th>Percent</th>
                                    <th>Number</th>
                                    <th>Percent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportdata as $reportdata)
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->male}}</td>
                                        <td>{{$reportdata->male_percent}}</td>
                                        <td>{{$reportdata->female}}</td>
                                        <td>{{$reportdata->female_percent}}</td>
                                        <td>{{$reportdata->total}}</td>
                                        @php
                                        ($total_male +=$reportdata->male);
                                        ($total_female +=$reportdata->female);
                                        ($grant_total +=$reportdata->total);
                                        @endphp  
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>{{$total_male}}</th>
                                    <th></th>
                                    <th>{{$total_female}}</th>
                                    <th></th>
                                    <th>{{$grant_total}}</th>
                                </tr>
                            </tfoot>
                        </table>
                     @elseif($report_name_id==59)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Long distance transportation</th>
                                    <th>Car renting/hiring</th>
                                    <th>fuel cost</th>
                                    <th>Local transfortation</th>
                                    <th>Food and beverages</th>
                                    <th>Medical</th>
                                    <th>Personal Shopping</th>
                                    <th>Entertainment</th>
                                    <th>MICE</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                @if ($reportdata->dropdown_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dropdown_name}}</th>
                                        <th>{{$reportdata->long_distance}}</th>
                                        <th>{{$reportdata->car_rental}}</th>
                                        <th>{{$reportdata->fuel_cost}}</th>
                                        <th>{{$reportdata->local_transport}}</th>
                                        <th>{{$reportdata->food}}</th>
                                        <th>{{$reportdata->medical}}</th>
                                        <th>{{$reportdata->shopping}}</th>
                                        <th>{{$reportdata->entertainment}}</th>
                                        <th>{{$reportdata->mice}}</th>
                                        <th>{{$reportdata->others}}</th>
                                        <th>{{$reportdata->total}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->long_distance}}</td>
                                        <td>{{$reportdata->car_rental}}</td>
                                        <td>{{$reportdata->fuel_cost}}</td>
                                        <td>{{$reportdata->local_transport}}</td>
                                        <td>{{$reportdata->food}}</td>
                                        <td>{{$reportdata->medical}}</td>
                                        <td>{{$reportdata->shopping}}</td>
                                        <td>{{$reportdata->entertainment}}</td>
                                        <td>{{$reportdata->mice}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="15" class="text-danger text-center"> No data available</td>
                                </tr>
                                        
                                @endforelse
                            </tbody>
                        </table>
                    @elseif($report_name_id==60)
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Long distance transportation</th>
                                    <th>Car renting/hiring</th>
                                    <th>fuel cost</th>
                                    <th>Local transfortation</th>
                                    <th>Food and beverages</th>
                                    <th>Medical</th>
                                    <th>Personal Shopping</th>
                                    <th>Entertainment</th>
                                    <th>MICE</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reportdata as $reportdata)
                                @if ($reportdata->dropdown_name=="Total")
                                    <tr>
                                        <th>{{$reportdata->dropdown_name}}</th>
                                        <th>{{$reportdata->long_distance}}</th>
                                        <th>{{$reportdata->car_rental}}</th>
                                        <th>{{$reportdata->fuel_cost}}</th>
                                        <th>{{$reportdata->local_transport}}</th>
                                        <th>{{$reportdata->food}}</th>
                                        <th>{{$reportdata->medical}}</th>
                                        <th>{{$reportdata->shopping}}</th>
                                        <th>{{$reportdata->entertainment}}</th>
                                        <th>{{$reportdata->mice}}</th>
                                        <th>{{$reportdata->others}}</th>
                                        <th>{{$reportdata->total}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$reportdata->dropdown_name}}</td>
                                        <td>{{$reportdata->long_distance}}</td>
                                        <td>{{$reportdata->car_rental}}</td>
                                        <td>{{$reportdata->fuel_cost}}</td>
                                        <td>{{$reportdata->local_transport}}</td>
                                        <td>{{$reportdata->food}}</td>
                                        <td>{{$reportdata->medical}}</td>
                                        <td>{{$reportdata->shopping}}</td>
                                        <td>{{$reportdata->entertainment}}</td>
                                        <td>{{$reportdata->mice}}</td>
                                        <td>{{$reportdata->others}}</td>
                                        <td>{{$reportdata->total}}</td>
                                    </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="15" class="text-danger text-center"> No data available</td>
                                </tr>
                                        
                                @endforelse
                            </tbody>
                        </table>
                 @else
                 <table class="table table-bordered table-hover table-condensed">
                        <tr>
                            <td colspan="4" class="text-center text-danger">No data available</td>
                        </tr>
                </table>

                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
           $('#datatableId').DataTable({
               "paging": true,
               "lengthChange": true,
               "searching": true,
               "ordering": false,
               "info": true,
               "autoWidth": true,
           });
       });
</script>