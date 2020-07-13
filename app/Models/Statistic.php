<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistic extends Model
{
    //
    protected $connection = 'mysql2';
    public static function getArrivalReport($request){
        $result = [];
        $query = '';
        if ($request->query('reportType') == 1){
            $query = 'SELECT 
                      SUM(
                        CASE
                          WHEN b.EntryModeId = 233 
                          THEN 1 
                          ELSE 0 
                        END
                      ) air,
                      SUM(
                        CASE
                          WHEN b.EntryModeId = 234 
                          THEN 1 
                          ELSE 0 
                        END
                      ) land,
                      COUNT(*) total 
                    FROM
                      visa_individual a 
                      LEFT JOIN visa_individualentry b 
                        ON a.Id = b.IndividualId 
                      LEFT JOIN visa_entry c 
                        ON b.EntryId = c.Id 
                    WHERE a.StatusId IN (7, 10) 
                      AND c.EntryDate >= ? 
                      AND c.ExitDate <= ? ';
            if ($request->query('groupType') != "" ){
                $query .= 'AND a.GroupId IN 
                          (SELECT 
                            Id 
                          FROM
                            visa_group 
                          WHERE GroupType = ?)';
                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))),date('Y-m-d', strtotime($request->query('end_date'))), $request->query('groupType')]);
            }else{
                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))),date('Y-m-d', strtotime($request->query('end_date')))]);
            }
        }elseif ($request->query('reportType') == 2){
            $query = 'SELECT 
                          d.Country name,
                          COUNT(*) total 
                        FROM
                          visa_individual a 
                          LEFT JOIN visa_individualentry b 
                            ON a.Id = b.IndividualId 
                          LEFT JOIN visa_entry c 
                            ON b.EntryId = c.Id 
                            LEFT JOIN m_countries d ON a.CountryId= d.Id
                        WHERE a.StatusId IN (7, 10) 
                          AND c.EntryDate >= ? 
                          AND c.ExitDate <= ?  ';
            if ($request->query('groupType') != "" ){
                $query .= 'AND a.GroupId IN 
                          (SELECT 
                            Id 
                          FROM
                            visa_group 
                          WHERE GroupType = ?) GROUP BY a.CountryId ORDER BY d.Country';
                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))),date('Y-m-d', strtotime($request->query('end_date'))), $request->query('groupType')]);
            }else {
                $query .= 'GROUP BY a.CountryId ORDER BY d.Country ';
                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))), date('Y-m-d', strtotime($request->query('end_date')))]);
            }
        }elseif ($request->query('reportType') == 3){
            $query .= 'SELECT 
                          f.Activity name,
                          COUNT(*) total 
                        FROM
                          visa_individual a 
                          LEFT JOIN visa_group b 
                            ON a.GroupId = b.Id 
                          LEFT JOIN visa_entry c 
                            ON b.Id = c.GroupId 
                          LEFT JOIN visa_activity d 
                            ON b.Id = d.GroupId 
                            AND c.Id = d.VisaEntryId 
                          LEFT JOIN m_subactivity e 
                            ON d.SubActivityId = e.Id 
                          LEFT JOIN m_activity f 
                            ON e.ActivityId = f.Id 
                        WHERE a.StatusId IN (7, 10) 
                          AND c.EntryDate >= ? 
                          AND c.ExitDate <= ? ';
            if ($request->query('groupType') != "" ){
                $query .= 'AND b.GroupType = ? GROUP BY e.ActivityId ORDER BY f.Activity ';
                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))),date('Y-m-d', strtotime($request->query('end_date'))), $request->query('groupType')]);
            }else {
                $query .= 'GROUP BY e.ActivityId ORDER BY f.Activity ';

                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))), date('Y-m-d', strtotime($request->query('end_date')))]);
            }
        }elseif ($request->query('reportType') == 4){
            $query .= 'SELECT 
                          e.Name name,
                          COUNT(*) total 
                        FROM
                          visa_individual a 
                          LEFT JOIN visa_group b 
                            ON a.GroupId = b.Id 
                          LEFT JOIN visa_entry c 
                            ON b.Id = c.GroupId 
                          LEFT JOIN visa_activity d 
                            ON b.Id = d.GroupId 
                            AND c.Id = d.VisaEntryId 
                          LEFT JOIN master_data e 
                            ON d.DzongkhagId = e.Id   
                        WHERE a.StatusId IN (7, 10) 
                          AND c.EntryDate >= ?  
                          AND c.ExitDate <= ? ';
            if ($request->query('groupType') != "" ){
                $query .= 'AND b.GroupType = ? GROUP BY d.DzongkhagId ORDER BY e.Name ';
                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))),date('Y-m-d', strtotime($request->query('end_date'))), $request->query('groupType')]);
            }else {
                $query .= 'GROUP BY d.DzongkhagId ORDER BY e.Name ';

                $result = DB::connection('mysql2')->select($query, [date('Y-m-d', strtotime($request->query('start_date'))), date('Y-m-d', strtotime($request->query('end_date')))]);
            }
        }


        return $result;
    }
}
