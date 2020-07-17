<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicReport extends Model
{
   
   
   public static function getReportName($reportTypeId){
     $query=\DB::table('t_admin_report_types as t1')
              ->select('t1.report_type')
              ->where('t1.id',$reportTypeId)
              ->first();
    return $query;
   }
    public static function getArrivalByModeOfTransporteports()
    {
        $query = \DB::select("
            SELECT 
                a.MainPurpose, 
                SUM(IF(a.Mode_Entry='Air',1,0)) air, 
                SUM(IF(a.Mode_Entry='Land',1,0)) land  ,
                SUM(IF(a.Mode_Entry='Air',1,0)) + SUM(IF(a.Mode_Entry='Land',1,0)) AS total
                FROM t_admin_data a
                WHERE a.MainPurpose<>'Paro'
                GROUP BY a.MainPurpose;
             ");
        return $query;
    }

    public static function getVisitorsByNights()
    {
        $query = \DB::select("
                        SELECT 
                        a.MainPurpose, 
                        SUM(IF(a.Nights<3,1,0)) one_two_nights,
                        SUM(IF(a.Nights>2 AND a.Nights<5,1,0)) three_four_nights,
                        SUM(IF(a.Nights>4 AND a.Nights<7,1,0)) five_six_nights,
                        SUM(IF(a.Nights>6 AND a.Nights<9,1,0)) seven_eight_nights,
                        SUM(IF(a.Nights>8 AND a.Nights<15,1,0)) nine_fourteen_nights,
                        SUM(IF(a.Nights>14,1,0)) fiveteennights,
                        COUNT(a.Nights) total
                        FROM t_admin_data a
                        WHERE a.MainPurpose<>'Paro'
                        GROUP BY a.MainPurpose;
                ");
        return $query;
    }

    public static function getArrivalByModeOfTransporteportsByMonth()
    {
        $query = \DB::select("
        SELECT
        a.MonthEn, 
        SUM(IF(a.Mode_Entry<>'Land',1,0)) air,
        SUM(IF(a.Mode_Entry='Land',1,0)) land,
        COUNT(a.Mode_Entry) total
        FROM t_admin_data a
        WHERE a.MonthEn<>'Holiday, Leisure and Recreation'
        GROUP BY STR_TO_DATE(a.MonthEn,'%M');
        ");
        return $query;
    }

    public static function ALoSByPurpose()
    {
        $query = \DB::select("
        SELECT 
        a.MainPurpose, 
        COUNT(a.Sl_No) visitors,
        SUM(a.Nights) visitors_nights,
        
        /*    cal  median   */
        (SELECT CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(
         GROUP_CONCAT(Nights ORDER BY Nights SEPARATOR ','),
          ',', 50/100 * COUNT(*) + 1), ',', -1) AS DECIMAL)
        FROM t_admin_data
        WHERE a.MainPurpose=t_admin_data.MainPurpose
        GROUP BY MainPurpose) median_night,
        
        /*    end  median   */
        
        ROUND(AVG(a.Nights)) mean_night
        FROM t_admin_data a
        WHERE a.MainPurpose<>'Paro'
        GROUP BY a.MainPurpose;
        ");
        return $query;
    }
    
    public static function getVDSByMajorMarkets(){

        $query = \DB::select("
        SELECT 
        a.Region, 
        SUM(IF(a.Nights<3,1,0)) one_two_nights,
        SUM(IF(a.Nights>2 AND a.Nights<5,1,0)) three_four_nights,
        SUM(IF(a.Nights>4 AND a.Nights<7,1,0)) five_six_nights,
        SUM(IF(a.Nights>6 AND a.Nights<9,1,0)) seven_eight_nights,
        SUM(IF(a.Nights>8 AND a.Nights<15,1,0)) nine_fourteen_nights,
        SUM(IF(a.Nights>14,1,0)) fiveteennights,
        COUNT(a.Nights) total
        FROM t_admin_data a
        WHERE a.MainPurpose<>'Paro'
        GROUP BY a.Region;
        ");
        return $query;
    }

    public static function getMajorMarketsByMainPurpose(){
        $query = \DB::select("
        SELECT 
        a.Region, 
        SUM(IF(a.MainPurpose='Business',1,0)) Business, 
        SUM(IF(a.MainPurpose='Education/Training/Exchange program',1,0)) ETE_Program,
        SUM(IF(a.MainPurpose='Holiday, Leisure and Recreation',1,0)) HLR,
        SUM(IF(a.MainPurpose='Incentives travel(FAM, Tour leader)',1,0)) IT,
        SUM(IF(a.MainPurpose='MICE',1,0)) MICE,
        SUM(IF(a.MainPurpose='Official',1,0)) Official,
        SUM(IF(a.MainPurpose='Others',1,0)) Others,
        SUM(IF(a.MainPurpose='Visiting friends and relatives/guest',1,0)) VFRG
        FROM t_admin_data a
        WHERE a.MainPurpose<>'Paro'
        GROUP BY a.Region;
        ");
        return $query;

    }

    public static function getALoSByMajorMarkets(){
        $query = \DB::select("
        SELECT 
        a.Region, 
        /*    cal  median   */
        (SELECT CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(
         GROUP_CONCAT(Nights ORDER BY Nights SEPARATOR ','),
          ',', 50/100 * COUNT(*) + 1), ',', -1) AS DECIMAL)
        FROM t_admin_data
        WHERE a.MainPurpose=t_admin_data.MainPurpose
        GROUP BY MainPurpose) median,
        
        /*    end  median   */
        
        ROUND(AVG(a.Nights)) mean
        FROM t_admin_data a
        WHERE a.MainPurpose<>'Paro'
        GROUP BY a.Region;
        ");
        return $query;

    }

    public static function getVisitorbyGlobalSegmentationbyGender(){
        $query = \DB::select("
        SELECT 
        a.Region, 
        SUM(IF(a.Sex_Id<>'F',1,0)) Female,
        SUM(IF(a.Sex_Id<>'M',1,0)) Male,
        COUNT(a.Sex_Id) Total
        FROM t_admin_data a
        WHERE a.MainPurpose<>'Paro'
        GROUP BY a.Region;
        ");
        return $query;
    }
}
