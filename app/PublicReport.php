<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicReport extends Model
{
   
   
   public static function getReportName($report_name_id){
     $query=\DB::table('t_report_names as t1')
              ->select('t1.report_name')
              ->where('t1.report_name_id',$report_name_id)
              ->first();
    return $query;
   }

   public static function getReportContent($report_type_id,$report_category_id,$report_name_id,$year)
   {
      
	 $query ="";
	//inbound tourism
     if($report_type_id==1){
		//Arrival by mode of transport by purpose(number of visitors)
        if($report_name_id==1){
			$query = \DB::select("SELECT * FROM (SELECT t.* FROM(
				SELECT 
				a.MainPurpose, 
				FORMAT(SUM(IF(a.Mode_Entry='Air',1,0)),'de_DE') air, 
				FORMAT(SUM(IF(a.Mode_Entry='Land',1,0)),'de_DE') land  ,
				FORMAT(SUM(IF(a.Mode_Entry='Air',1,0)) + SUM(IF(a.Mode_Entry='Land',1,0)),'de_DE') AS total
				FROM t_admin_data a
				WHERE a.MainPurpose<>'Paro' 
				GROUP BY a.MainPurpose)t
				UNION
				(SELECT 
				'Total' MainPurpose,
				FORMAT(SUM(t.air),'de_DE') air,
				FORMAT(SUM(t.land),'de_DE')land,
				FORMAT(SUM(t.total),'de_DE')total
				FROM
				(
				SELECT 
				a.MainPurpose, 
				FORMAT(SUM(IF(a.Mode_Entry='Air',1,0)),'de_DE') air, 
				FORMAT(SUM(IF(a.Mode_Entry='Land',1,0)),'de_DE') land  ,
				FORMAT(SUM(IF(a.Mode_Entry='Air',1,0)) + SUM(IF(a.Mode_Entry='Land',1,0)),'de_DE') AS total
				FROM t_admin_data a
				WHERE a.MainPurpose<>'Paro' 
				GROUP BY a.MainPurpose)t))t1
			");
		}
		//Monthly AloS by Purpose
		else if($report_name_id==2){
			$query = \DB::select("SELECT 
					a.MainPurpose,
					ROUND(AVG(CASE a.MonthEn WHEN 'Jan' THEN a.Nights END)) Jan,
					ROUND(AVG(CASE a.MonthEn WHEN 'Feb' THEN a.Nights END)) Feb,
					ROUND(AVG(CASE a.MonthEn WHEN 'Mar' THEN a.Nights END)) Mar,
					ROUND(AVG(CASE a.MonthEn WHEN 'Apr' THEN a.Nights END)) Apr,
					ROUND(AVG(CASE a.MonthEn WHEN 'May' THEN a.Nights END)) May,
					ROUND(AVG(CASE a.MonthEn WHEN 'Jun' THEN a.Nights END)) Jun,
					ROUND(AVG(CASE a.MonthEn WHEN 'Jul' THEN a.Nights END)) Jul,
					ROUND(AVG(CASE a.MonthEn WHEN 'Aug' THEN a.Nights END)) Aug,
					ROUND(AVG(CASE a.MonthEn WHEN 'Sep' THEN a.Nights END)) Sep,
					ROUND(AVG(CASE a.MonthEn WHEN 'Oct' THEN a.Nights END)) Octo,
					ROUND(AVG(CASE a.MonthEn WHEN 'Nov' THEN a.Nights END)) Nov,
					ROUND(AVG(CASE a.MonthEn WHEN 'Dec' THEN a.Nights END)) Dece
					FROM
					t_admin_data a WHERE a.MainPurpose <> 'Paro'
					GROUP BY a.MainPurpose ; 
			");
		
		}
		//AloS by purpose
		else if($report_name_id==3){
			$query = \DB::select("SELECT 
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
		}
		//Visitor nights by Purpose in Numbers
		else if($report_name_id==4){
			$query = \DB::select("SELECT 
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
		}
		//Monthly Arrivals by mode of Transport(Numbers of persons)	
		else if($report_name_id==5){
			$query = \DB::select("SELECT
					a.MonthEn, 
					SUM(IF(a.Mode_Entry='Air',1,0)) air,
					SUM(IF(a.Mode_Entry='Land',1,0)) land,
					COUNT(a.Mode_Entry) total
					FROM t_admin_data a
					WHERE a.MonthEn<>'Holiday, Leisure and Recreation'
					GROUP BY STR_TO_DATE(a.MonthEn,'%M');
				");
		
		}
		//ALoS by major markets
		else if($report_name_id==6){
			$query = \DB::select("SELECT 
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
		}
		//Visitors by duration of stay by major markets
		else if($report_name_id==7){
			$query = \DB::select("SELECT 
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
		}
		//Major markets by main purpose
		else if($report_name_id==8){
			$query = \DB::select("SELECT 
					a.Region, 
					SUM(IF(a.MainPurpose='Business',1,0)) Business, 
					SUM(IF(a.MainPurpose='Education/Training/Exchange program',1,0)) ETE_Program,
					SUM(IF(a.MainPurpose='Holiday, Leisure and Recreation',1,0)) HLR,
					SUM(IF(a.MainPurpose='Incentives travel(FAM, Tour leader)',1,0)) IT,
					SUM(IF(a.MainPurpose='MICE',1,0)) MICE,
					SUM(IF(a.MainPurpose='Official',1,0)) Official,
					SUM(IF(a.MainPurpose='Others',1,0)) Others,
					SUM(IF(a.MainPurpose='Visiting friends and relatives/guest',1,0)) VFRG,
					COUNT(a.MainPurpose)total
					FROM t_admin_data a
					WHERE a.MainPurpose<>'Paro'
					GROUP BY a.Region;
			");
		}
		//Visitor by Global Segmentation by Gender
		else{
		$query = \DB::select("SELECT 
				a.Region, 
				SUM(IF(a.Sex_Id<>'F',1,0)) Female,
				SUM(IF(a.Sex_Id<>'M',1,0)) Male,
				COUNT(a.Sex_Id) Total
				FROM t_admin_data a
				WHERE a.MainPurpose<>'Paro'
				GROUP BY a.Region; 
			");
		}
	 }
	//outbound tourism
	 else if($report_type_id==2){
		 //Outbound Overnight Trips
		 if($report_category_id==1){
			 //Outbound overnight visitors by main destination
			 if($report_name_id==41){
				$query = \DB::select("SELECT * FROM
							(SELECT t2.* FROM
							(SELECT
							t1.dropdown_name,
							t1.visitors,
							FORMAT((t1.visitors/t1.grand_total)*100,2) AS percent
							FROM 
							(SELECT 
							b.dropdown_name,
							SUM(
								IF(a.visitor_type_id = 316, a.value, 0)
							)visitors,
							(SELECT SUM(VALUE) FROM t_purpose_survey WHERE visitor_type_id = 316
							AND report_category_id = $report_category_id
							AND YEAR = $year) AS grand_total
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dropdown_lists b 
								ON a.location_id = b.id 
							LEFT JOIN t_totexpenditure_survey c 
								ON a.location_id = c.location_id 
								AND a.year = c.year 
								AND a.report_category_id = c.report_category_id 
							WHERE a.report_category_id = $report_category_id
							AND a.year = $year
							GROUP BY a.location_id )t1)t2
							UNION
							(SELECT
							'Total' dropdown_name,
							SUM(visitors) visitors,
							FORMAT(SUM(percent),2) percent
							FROM
							(SELECT
							t1.dropdown_name,
							t1.visitors,
							FORMAT((t1.visitors/t1.grand_total)*100,2) AS percent
							FROM 
							(SELECT 
							b.dropdown_name,
							SUM(
								IF(a.visitor_type_id = 316, a.value, 0)
							)visitors,
							(SELECT SUM(VALUE) FROM t_purpose_survey WHERE visitor_type_id = 316
							AND report_category_id = $report_category_id
							AND YEAR = $year) AS grand_total
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dropdown_lists b 
								ON a.location_id = b.id 
							LEFT JOIN t_totexpenditure_survey c 
								ON a.location_id = c.location_id 
								AND a.year = c.year 
								AND a.report_category_id = c.report_category_id 
							WHERE a.report_category_id = $report_category_id
							AND a.year = $year
							GROUP BY a.location_id )t1)t2))t3
				");
			 }
			 else if($report_name_id==42){
			//Outbound total and mean visitor nights by main destionation
			$query = \DB::select("SELECT 
						b.dropdown_name,
						SUM(IF(a.visitor_type_id = 317, a.value, 0))nights,
						c.mean 
						FROM
						t_purpose_survey a 
						LEFT JOIN t_dropdown_lists b 
						ON a.location_id = b.id 
						LEFT JOIN t_totexpenditure_survey c 
						ON a.location_id = c.location_id 
						AND a.year = c.year 
						AND a.report_category_id = c.report_category_id 
						WHERE a.report_category_id = $report_category_id
						AND a.year = $year
						GROUP BY a.location_id ;
					 ");
			    }
            //Outbound overnight trips by main purpose and destionation
			 else if($report_name_id==43){
				$query = \DB::select("SELECT 
							b.dropdown_name,
							SUM(IF(a.purpose_id = 318, a.value, 0)) business,
							SUM(IF(a.purpose_id = 319, a.value, 0)) education,
							SUM(IF(a.purpose_id = 320, a.value, 0)) health,
							SUM(IF(a.purpose_id = 321, a.value, 0)) holiday,
							SUM(IF(a.purpose_id = 322, a.value, 0)) others,
							SUM(IF(a.purpose_id = 323, a.value, 0)) personal,
							SUM(IF(a.purpose_id = 324, a.value, 0)) religion,
							SUM(IF(a.purpose_id = 325, a.value, 0)) visiting,
							SUM(a.value) total 
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dropdown_lists b 
							ON a.location_id = b.id 
							WHERE a.visitor_type_id = 316 
							AND a.report_category_id = $report_category_id
							AND a.year = $year
							GROUP BY a.location_id 
				     ");
			 }
			//Outbound visitors nights by main purpose and destionation
			else if($report_name_id==44){
				$query = \DB::select("SELECT 
							b.dropdown_name,
							SUM(IF(a.purpose_id = 318, a.value, 0)) business,
							SUM(IF(a.purpose_id = 319, a.value, 0)) education,
							SUM(IF(a.purpose_id = 320, a.value, 0)) health,
							SUM(IF(a.purpose_id = 321, a.value, 0)) holiday,
							SUM(IF(a.purpose_id = 322, a.value, 0)) others,
							SUM(IF(a.purpose_id = 323, a.value, 0)) personal,
							SUM(IF(a.purpose_id = 324, a.value, 0)) religion,
							SUM(IF(a.purpose_id = 325, a.value, 0)) visiting,
							SUM(a.value) total 
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dropdown_lists b 
							ON a.location_id = b.id 
							WHERE a.visitor_type_id = 317 
							AND a.report_category_id = $report_category_id
							AND a.year = $year
							GROUP BY a.location_id 
				     ");
			 }
	   //Outbound overnight trips by main destination by mode of transport(%)
		else if($report_name_id==46){
			$query = \DB::select("SELECT b.dropdown_name, 
							ROUND((SUM(IF(a.transport_mode_id=326,a.value,0))/SUM(a.value))*100,2) air, 
							ROUND((SUM(IF(a.transport_mode_id=327,a.value,0))/SUM(a.value))*100,2) car, 
							ROUND((SUM(IF(a.transport_mode_id=328,a.value,0))/SUM(a.value))*100,2) others, 
							ROUND((SUM(IF(a.transport_mode_id=329,a.value,0))/SUM(a.value))*100,2) own_vehicle, 
							ROUND((SUM(IF(a.transport_mode_id=330,a.value,0))/SUM(a.value))*100,2) public_transport, 
							ROUND((SUM(IF(a.transport_mode_id=331,a.value,0))/SUM(a.value))*100,2) vehicle_arranged, 
							100 total
							FROM
							t_transport_survey a 
							LEFT JOIN t_dropdown_lists b ON a.location_id = b.id
							WHERE a.year = $year 
							GROUP BY a.location_id 
							UNION 
							SELECT 'Total' dropdown_name, 
							ROUND((SUM(IF(a.transport_mode_id=326,a.value,0))/SUM(a.value))*100,2) air, 
							ROUND((SUM(IF(a.transport_mode_id=327,a.value,0))/SUM(a.value))*100,2) car, 
							ROUND((SUM(IF(a.transport_mode_id=328,a.value,0))/SUM(a.value))*100,2) others, 
							ROUND((SUM(IF(a.transport_mode_id=329,a.value,0))/SUM(a.value))*100,2) own_vehicle, 
							ROUND((SUM(IF(a.transport_mode_id=330,a.value,0))/SUM(a.value))*100,2) public_transport, 
							ROUND((SUM(IF(a.transport_mode_id=331,a.value,0))/SUM(a.value))*100,2) vehicle_arranged, 
							100 total
							FROM
							t_transport_survey a   
							WHERE a.year = $year
				");
			}
		//Outbound overnight visitors by main destination and package options
		else if($report_name_id==48){
			$query = \DB::select("SELECT b.dropdown_name,
					SUM(IF(a.package_option='Y',a.value,0)) yes_option,
					SUM(IF(a.package_option='N',a.value,0)) no_option,
					SUM(a.value) total 
					FROM
					t_package_option_survey a 
					LEFT JOIN t_dropdown_lists b ON a.location_id = b.id
					WHERE a.year = $year
					GROUP BY a.location_id ");
			 }
		//Total and mean expenditure by main destination
		else if($report_name_id==50){
			$query = \DB::select("SELECT 
						b.dropdown_name,
						FORMAT(a.tot_expenditure/1000000,2) AS tot_expenditure ,
						a.avg_expenditure_trip 
					FROM
						t_totexpenditure_survey a 
						LEFT JOIN t_dropdown_lists b 
						ON a.location_id = b.id 
					WHERE a.report_category_id = $report_category_id
						AND a.year = $year 
					GROUP BY a.location_id 
			    ");
		 }
		 //Outbound overnight total trip expenditure by main destination and item of expenditure(in Nu.Million)
		 else if($report_name_id==52){
			$query = \DB::select("SELECT * FROM
						(SELECT 
						b.dropdown_name,
						FORMAT(SUM(IF(a.exp_item_id = 344, a.value, 0))/1000000,2) tour_package,
						FORMAT(SUM(IF(a.exp_item_id = 332, a.value, 0))/1000000,2) accommodation,
						FORMAT(SUM(IF(a.exp_item_id = 333, a.value, 0))/1000000,2) air,
						FORMAT(SUM(IF(a.exp_item_id = 334, a.value, 0))/1000000,2) car_rental,
						FORMAT(SUM(IF(a.exp_item_id = 335, a.value, 0))/1000000,2) entertainment,
						FORMAT(SUM(IF(a.exp_item_id = 336, a.value, 0))/1000000,2) fuel_cost,
						FORMAT(SUM(IF(a.exp_item_id = 337, a.value, 0))/1000000,2) food,
						FORMAT(SUM(IF(a.exp_item_id = 338, a.value, 0))/1000000,2) local_transport,
						FORMAT(SUM(IF(a.exp_item_id = 339, a.value, 0))/1000000,2) long_distance,
						FORMAT(SUM(IF(a.exp_item_id = 340, a.value, 0))/1000000,2) medical,
						FORMAT(SUM(IF(a.exp_item_id = 341, a.value, 0))/1000000,2) mice,
						FORMAT(SUM(IF(a.exp_item_id = 342, a.value, 0))/1000000,2) others,
						FORMAT(SUM(IF(a.exp_item_id = 343, a.value, 0))/1000000,2) shopping,
						FORMAT(SUM(a.value)/1000000,2) total 
						FROM
						t_tripexpenditure_survey a 
						LEFT JOIN t_dropdown_lists b 
						ON a.purpose_id = b.id 
						WHERE a.trip_type_id = 347 
						AND a.report_category_id =$report_category_id
						AND a.year =$year
						GROUP BY a.purpose_id
						UNION
						(SELECT 
						'Total' dropdown_name,
						FORMAT(SUM(IF(a.exp_item_id = 344, a.value, 0))/1000000,2) tour_package,
						FORMAT(SUM(IF(a.exp_item_id = 332, a.value, 0))/1000000,2) accommodation,
						FORMAT(SUM(IF(a.exp_item_id = 333, a.value, 0))/1000000,2) air,
						FORMAT(SUM(IF(a.exp_item_id = 334, a.value, 0))/1000000,2) car_rental,
						FORMAT(SUM(IF(a.exp_item_id = 335, a.value, 0))/1000000,2) entertainment,
						FORMAT(SUM(IF(a.exp_item_id = 336, a.value, 0))/1000000,2) fuel_cost,
						FORMAT(SUM(IF(a.exp_item_id = 337, a.value, 0))/1000000,2) food,
						FORMAT(SUM(IF(a.exp_item_id = 338, a.value, 0))/1000000,2) local_transport,
						FORMAT(SUM(IF(a.exp_item_id = 339, a.value, 0))/1000000,2) long_distance,
						FORMAT(SUM(IF(a.exp_item_id = 340, a.value, 0))/1000000,2) medical,
						FORMAT(SUM(IF(a.exp_item_id = 341, a.value, 0))/1000000,2) mice,
						FORMAT(SUM(IF(a.exp_item_id = 342, a.value, 0))/1000000,2) others,
						FORMAT(SUM(IF(a.exp_item_id = 343, a.value, 0))/1000000,2) shopping,
						FORMAT(SUM(a.value)/1000000,2) total 
						FROM
						t_tripexpenditure_survey a 
						LEFT JOIN t_dropdown_lists b 
						ON a.purpose_id = b.id 
						WHERE a.trip_type_id = 347 
						AND a.report_category_id =$report_category_id
						AND a.year =$year))t");
		 }
		 //Outbound overnight mean trip expenditure by main destination and item of expenditure(in Nu.)
		 else if($report_name_id==53){
			$query = \DB::select("SELECT 
					b.dropdown_name,
					SUM(IF(a.exp_item_id = 344, a.value, 0)) tour_package,
					SUM(IF(a.exp_item_id = 332, a.value, 0)) accommodation,
					SUM(IF(a.exp_item_id = 333, a.value, 0)) air,
					SUM(IF(a.exp_item_id = 334, a.value, 0))car_rental,
					SUM(IF(a.exp_item_id = 335, a.value, 0))entertainment,
					SUM(IF(a.exp_item_id = 336, a.value, 0))fuel_cost,
					SUM(IF(a.exp_item_id = 337, a.value, 0))food,
					SUM(IF(a.exp_item_id = 338, a.value, 0))local_transport,
					SUM(IF(a.exp_item_id = 339, a.value, 0))long_distance,
					SUM(IF(a.exp_item_id = 340, a.value, 0))medical,
					SUM(IF(a.exp_item_id = 341, a.value, 0))mice,
					SUM(IF(a.exp_item_id = 342, a.value, 0))others,
					SUM(IF(a.exp_item_id = 343, a.value, 0))shopping,
					SUM(IF(a.exp_item_id = 345, a.value, 0))total
					FROM
					t_tripexpenditure_survey a 
					LEFT JOIN t_dropdown_lists b 
					ON a.purpose_id = b.id 
					WHERE a.trip_type_id = 348
					AND a.report_category_id =$report_category_id
					AND a.year =$year
					GROUP BY a.purpose_id
				");
	    	 }
		 }
		 //Outbound Excursion/ Daytrip
		 else{
			 //Outbound excursion trip by purpose and sex
			if($report_name_id==55){
				$query = \DB::select("SELECT 
						b.dropdown_name,
						SUM(IF(a.gender='M', a.value,0)) male,
						ROUND((SUM(IF(a.gender='M', a.value,0))/SUM(a.value))*100,2) male_percent,
						SUM(IF(a.gender='F', a.value, 0)) female,
						ROUND((SUM(IF(a.gender='F', a.value, 0))/SUM(a.value))*100,2) female_percent,
						SUM(a.value) total 
						FROM
						t_purpose_survey a 
						LEFT JOIN t_dropdown_lists b ON a.purpose_id=b.id
						WHERE a.report_category_id = $report_category_id
						AND a.year = $year
						GROUP BY a.purpose_id
					"); 
			}
			//Outbound overnight total trip expenditure by main destination and item of expenditure(in Nu.Million)
			else if($report_name_id==59){
				$query = \DB::select("SELECT * FROM
							(SELECT 
							b.dropdown_name,
							FORMAT(SUM(IF(a.exp_item_id = 334, a.value, 0))/1000000,2) car_rental,
							FORMAT(SUM(IF(a.exp_item_id = 335, a.value, 0))/1000000,2) entertainment,
							FORMAT(SUM(IF(a.exp_item_id = 336, a.value, 0))/1000000,2) fuel_cost,
							FORMAT(SUM(IF(a.exp_item_id = 337, a.value, 0))/1000000,2) food,
							FORMAT(SUM(IF(a.exp_item_id = 338, a.value, 0))/1000000,2) local_transport,
							FORMAT(SUM(IF(a.exp_item_id = 339, a.value, 0))/1000000,2) long_distance,
							FORMAT(SUM(IF(a.exp_item_id = 340, a.value, 0))/1000000,2) medical,
							FORMAT(SUM(IF(a.exp_item_id = 341, a.value, 0))/1000000,2) mice,
							FORMAT(SUM(IF(a.exp_item_id = 342, a.value, 0))/1000000,2) others,
							FORMAT(SUM(IF(a.exp_item_id = 343, a.value, 0))/1000000,2) shopping,
							FORMAT(SUM(a.value)/1000000,2) total 
							FROM
							t_tripexpenditure_survey a 
							LEFT JOIN t_dropdown_lists b 
							ON a.purpose_id = b.id 
							WHERE a.trip_type_id = 347 
							AND a.report_category_id =$report_category_id
							AND a.year =$year
							GROUP BY a.purpose_id
							UNION
							(SELECT 
							'Total' dropdown_name,
							FORMAT(SUM(IF(a.exp_item_id = 334, a.value, 0))/1000000,2) car_rental,
							FORMAT(SUM(IF(a.exp_item_id = 335, a.value, 0))/1000000,2) entertainment,
							FORMAT(SUM(IF(a.exp_item_id = 336, a.value, 0))/1000000,2) fuel_cost,
							FORMAT(SUM(IF(a.exp_item_id = 337, a.value, 0))/1000000,2) food,
							FORMAT(SUM(IF(a.exp_item_id = 338, a.value, 0))/1000000,2) local_transport,
							FORMAT(SUM(IF(a.exp_item_id = 339, a.value, 0))/1000000,2) long_distance,
							FORMAT(SUM(IF(a.exp_item_id = 340, a.value, 0))/1000000,2) medical,
							FORMAT(SUM(IF(a.exp_item_id = 341, a.value, 0))/1000000,2) mice,
							FORMAT(SUM(IF(a.exp_item_id = 342, a.value, 0))/1000000,2) others,
							FORMAT(SUM(IF(a.exp_item_id = 343, a.value, 0))/1000000,2) shopping,
							FORMAT(SUM(a.value)/1000000,2) total 
							FROM
							t_tripexpenditure_survey a 
							LEFT JOIN t_dropdown_lists b 
							ON a.purpose_id = b.id 
							WHERE a.trip_type_id = 347 
							AND a.report_category_id =$report_category_id
							AND a.year =$year))t
				");
			}
			//Outbound overnight mean trip expenditure by main destination and item of expenditure(in Nu.)
			else if($report_name_id==60){
				$query = \DB::select("SELECT 
						b.dropdown_name,
						SUM(IF(a.exp_item_id = 334, a.value, 0))car_rental,
						SUM(IF(a.exp_item_id = 335, a.value, 0))entertainment,
						SUM(IF(a.exp_item_id = 336, a.value, 0))fuel_cost,
						SUM(IF(a.exp_item_id = 337, a.value, 0))food,
						SUM(IF(a.exp_item_id = 338, a.value, 0))local_transport,
						SUM(IF(a.exp_item_id = 339, a.value, 0))long_distance,
						SUM(IF(a.exp_item_id = 340, a.value, 0))medical,
						SUM(IF(a.exp_item_id = 341, a.value, 0))mice,
						SUM(IF(a.exp_item_id = 342, a.value, 0))others,
						SUM(IF(a.exp_item_id = 343, a.value, 0))shopping,
						SUM(IF(a.exp_item_id = 345, a.value, 0))total
						FROM
						t_tripexpenditure_survey a 
						LEFT JOIN t_dropdown_lists b 
						ON a.purpose_id = b.id 
						WHERE a.trip_type_id = 348
						AND a.report_category_id =$report_category_id
						AND a.year =$year
						GROUP BY a.purpose_id
				");
			}
		 }
	 }
	//domestic tourism
	else if($report_type_id==3){
		//Domestic Overnight Trips
		 if($report_category_id==3){
			 //Overnight visitors by purpose by Dzongkhag visited
			 //Visitor by purpose and Dzongkhag visited
			if($report_name_id==10 || $report_name_id==19){
				if($report_name_id==10){
					$visitor_type_id=316;
				}else{
					$visitor_type_id=317;
				}
				$query = \DB::select("SELECT 
						b.dzongkhag_name,
						SUM(IF(a.purpose_id=318, a.value,0)) business,
						SUM(IF(a.purpose_id=319, a.value,0)) education,
						SUM(IF(a.purpose_id=320, a.value,0)) health,
						SUM(IF(a.purpose_id=321, a.value,0)) holiday,
						SUM(IF(a.purpose_id=322, a.value,0)) others,
						SUM(IF(a.purpose_id=323, a.value,0)) personal,
						SUM(IF(a.purpose_id=324, a.value,0)) religion,
						SUM(IF(a.purpose_id=325, a.value,0)) visiting,
						SUM(a.value) total  
						FROM
						t_purpose_survey a 
						LEFT JOIN t_dzongkhag_masters b ON a.location_id = b.id
						WHERE a.visitor_type_id = $visitor_type_id
						AND a.report_category_id = $report_category_id
						AND a.year = $year
						GROUP BY a.location_id 
						ORDER BY a.location_id;
				");
			}
			//Visitor by purpose by sex by Dzongkhag visited
			else if($report_name_id==12){
				$query = \DB::select("SELECT a.* FROM (SELECT 
							b.dzongkhag_name,
							a.gender,
							SUM(IF(a.purpose_id = 318, a.value, 0)) business, 
							SUM(IF(a.purpose_id = 319, a.value, 0)) education, 
							SUM(IF(a.purpose_id = 320, a.value, 0)) health, 
							SUM(IF(a.purpose_id = 321, a.value, 0)) holiday, 
							SUM(IF(a.purpose_id = 322, a.value, 0)) others, 
							SUM(IF(a.purpose_id = 323, a.value, 0)) personal, 
							SUM(IF(a.purpose_id = 324, a.value, 0)) religion, 
							SUM(IF(a.purpose_id = 325, a.value, 0)) visiting 
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dzongkhag_masters b 
								ON a.location_id = b.id 
							WHERE a.visitor_type_id = 316 
							AND a.report_category_id = $report_category_id 
							AND a.year = $year
							GROUP BY a.gender,
							a.location_id  
							UNION 
							SELECT 
							'Total' dzongkhag_name,
							a.gender,
							SUM(IF(a.purpose_id = 318, a.value, 0)) business, 
							SUM(IF(a.purpose_id = 319, a.value, 0)) education, 
							SUM(IF(a.purpose_id = 320, a.value, 0)) health, 
							SUM(IF(a.purpose_id = 321, a.value, 0)) holiday, 
							SUM(IF(a.purpose_id = 322, a.value, 0)) others, 
							SUM(IF(a.purpose_id = 323, a.value, 0)) personal, 
							SUM(IF(a.purpose_id = 324, a.value, 0)) religion, 
							SUM(IF(a.purpose_id = 325, a.value, 0)) visiting 
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dzongkhag_masters b 
								ON a.location_id = b.id 
							WHERE a.visitor_type_id = 316 
							AND a.report_category_id = $report_category_id
							AND a.year = $year
							GROUP BY a.gender 
							UNION 
							SELECT 
							'Total' dzongkhag_name,
							'total' gender,
							SUM(IF(a.purpose_id = 318, a.value, 0)) business, 
							SUM(IF(a.purpose_id = 319, a.value, 0)) education, 
							SUM(IF(a.purpose_id = 320, a.value, 0)) health, 
							SUM(IF(a.purpose_id = 321, a.value, 0)) holiday, 
							SUM(IF(a.purpose_id = 322, a.value, 0)) others, 
							SUM(IF(a.purpose_id = 323, a.value, 0)) personal, 
							SUM(IF(a.purpose_id = 324, a.value, 0)) religion, 
							SUM(IF(a.purpose_id = 325, a.value, 0)) visiting 
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dzongkhag_masters b 
								ON a.location_id = b.id 
							WHERE a.visitor_type_id = 316 
							AND a.report_category_id = $report_category_id
							AND a.year = $year)a ORDER BY a.dzongkhag_name,a.gender ;
				   ");
		    	}
			//Visitors by destination and origin Dzongkhag(Number)
			//Visitor nights by destination and origin Dzongkhag
			else if($report_name_id==13 || $report_name_id==15){
				if($report_name_id==13){
					$visitor_type_id=316;
				}else{
					$visitor_type_id=317;
				}
				$query = \DB::select("SELECT 
						b.dzongkhag_name,
						SUM(IF(a.location_id = 1, a.value, 0)) bumthang, 
						SUM(IF(a.location_id = 2, a.value, 0)) chukha, 
						SUM(IF(a.location_id = 3, a.value, 0)) dagana, 
						SUM(IF(a.location_id = 4, a.value, 0)) gasa, 
						SUM(IF(a.location_id = 5, a.value, 0)) haa, 
						SUM(IF(a.location_id = 6, a.value, 0)) lhuentse, 
						SUM(IF(a.location_id = 7, a.value, 0)) mongar, 
						SUM(IF(a.location_id = 8, a.value, 0)) paro, 
						SUM(IF(a.location_id = 9, a.value, 0)) pemagatshel, 
						SUM(IF(a.location_id = 10, a.value, 0)) punakha, 
						SUM(IF(a.location_id = 11, a.value, 0)) samdrupjongkhar, 
						SUM(IF(a.location_id = 12, a.value, 0)) samtse, 
						SUM(IF(a.location_id = 13, a.value, 0)) sarpang, 
						SUM(IF(a.location_id = 14, a.value, 0)) thimphu, 
						SUM(IF(a.location_id = 15, a.value, 0)) trashigang, 
						SUM(IF(a.location_id = 16, a.value, 0)) trashiyangtse, 
						SUM(IF(a.location_id = 17, a.value, 0)) trongsa, 
						SUM(IF(a.location_id = 18, a.value, 0)) tsirang, 
						SUM(IF(a.location_id = 19, a.value, 0)) wangduephodrang, 
						SUM(IF(a.location_id = 20, a.value, 0)) zhemgang, 
						SUM(a.value) total
					FROM
						t_origin_survey a 
						LEFT JOIN t_dzongkhag_masters b 
						ON a.origin_id = b.id 
					WHERE a.visitor_type_id = $visitor_type_id
						AND a.report_category_id = $report_category_id
						AND a.year = $year
					GROUP BY a.origin_id 
					ORDER BY a.origin_id;  
				");
			}
			//Visitors by destination and origin Dzongkhag(Percent)
			else if($report_name_id==14){
				$query = \DB::select("SELECT 
							b.dzongkhag_name,
							ROUND((SUM(IF(a.location_id = 1, a.value, 0))/SUM(a.value)*100),2) bumthang, 
							ROUND((SUM(IF(a.location_id = 2, a.value, 0))/SUM(a.value)*100),2) chukha, 
							ROUND((SUM(IF(a.location_id = 3, a.value, 0))/SUM(a.value)*100),2) dagana, 
							ROUND((SUM(IF(a.location_id = 4, a.value, 0))/SUM(a.value)*100),2) gasa, 
							ROUND((SUM(IF(a.location_id = 5, a.value, 0))/SUM(a.value)*100),2) haa, 
							ROUND((SUM(IF(a.location_id = 6, a.value, 0))/SUM(a.value)*100),2) lhuentse, 
							ROUND((SUM(IF(a.location_id = 7, a.value, 0))/SUM(a.value)*100),2) mongar, 
							ROUND((SUM(IF(a.location_id = 8, a.value, 0))/SUM(a.value)*100),2) paro, 
							ROUND((SUM(IF(a.location_id = 9, a.value, 0))/SUM(a.value)*100),2) pemagatshel, 
							ROUND((SUM(IF(a.location_id = 10, a.value, 0))/SUM(a.value)*100),2) punakha, 
							ROUND((SUM(IF(a.location_id = 11, a.value, 0))/SUM(a.value)*100),2) samdrupjongkhar, 
							ROUND((SUM(IF(a.location_id = 12, a.value, 0))/SUM(a.value)*100),2) samtse, 
							ROUND((SUM(IF(a.location_id = 13, a.value, 0))/SUM(a.value)*100),2) sarpang, 
							ROUND((SUM(IF(a.location_id = 14, a.value, 0))/SUM(a.value)*100),2) thimphu, 
							ROUND((SUM(IF(a.location_id = 15, a.value, 0))/SUM(a.value)*100),2) trashigang, 
							ROUND((SUM(IF(a.location_id = 16, a.value, 0))/SUM(a.value)*100),2) trashiyangtse, 
							ROUND((SUM(IF(a.location_id = 17, a.value, 0))/SUM(a.value)*100),2) trongsa, 
							ROUND((SUM(IF(a.location_id = 18, a.value, 0))/SUM(a.value)*100),2) tsirang, 
							ROUND((SUM(IF(a.location_id = 19, a.value, 0))/SUM(a.value)*100),2) wangduephodrang, 
							ROUND((SUM(IF(a.location_id = 20, a.value, 0))/SUM(a.value)*100),2) zhemgang,
							ROUND((SUM(a.value)/SUM(a.value)*100),0) total 
							FROM
							t_origin_survey a 
							LEFT JOIN t_dzongkhag_masters b 
								ON a.origin_id = b.id 
							WHERE a.visitor_type_id = 316 
							AND a.report_category_id = $report_category_id
							AND a.year = $year
							GROUP BY a.origin_id 
							UNION 
							SELECT 
							'Total',
							ROUND((SUM(IF(a.location_id = 1, a.value, 0))/SUM(a.value)*100),2) bumthang, 
							ROUND((SUM(IF(a.location_id = 2, a.value, 0))/SUM(a.value)*100),2) chukha, 
							ROUND((SUM(IF(a.location_id = 3, a.value, 0))/SUM(a.value)*100),2) dagana, 
							ROUND((SUM(IF(a.location_id = 4, a.value, 0))/SUM(a.value)*100),2) gasa, 
							ROUND((SUM(IF(a.location_id = 5, a.value, 0))/SUM(a.value)*100),2) haa, 
							ROUND((SUM(IF(a.location_id = 6, a.value, 0))/SUM(a.value)*100),2) lhuentse, 
							ROUND((SUM(IF(a.location_id = 7, a.value, 0))/SUM(a.value)*100),2) mongar, 
							ROUND((SUM(IF(a.location_id = 8, a.value, 0))/SUM(a.value)*100),2) paro, 
							ROUND((SUM(IF(a.location_id = 9, a.value, 0))/SUM(a.value)*100),2) pemagatshel, 
							ROUND((SUM(IF(a.location_id = 10, a.value, 0))/SUM(a.value)*100),2) punakha, 
							ROUND((SUM(IF(a.location_id = 11, a.value, 0))/SUM(a.value)*100),2) samdrupjongkhar, 
							ROUND((SUM(IF(a.location_id = 12, a.value, 0))/SUM(a.value)*100),2) samtse, 
							ROUND((SUM(IF(a.location_id = 13, a.value, 0))/SUM(a.value)*100),2) sarpang, 
							ROUND((SUM(IF(a.location_id = 14, a.value, 0))/SUM(a.value)*100),2) thimphu, 
							ROUND((SUM(IF(a.location_id = 15, a.value, 0))/SUM(a.value)*100),2) trashigang, 
							ROUND((SUM(IF(a.location_id = 16, a.value, 0))/SUM(a.value)*100),2) trashiyangtse, 
							ROUND((SUM(IF(a.location_id = 17, a.value, 0))/SUM(a.value)*100),2) trongsa, 
							ROUND((SUM(IF(a.location_id = 18, a.value, 0))/SUM(a.value)*100),2) tsirang, 
							ROUND((SUM(IF(a.location_id = 19, a.value, 0))/SUM(a.value)*100),2) wangduephodrang, 
							ROUND((SUM(IF(a.location_id = 20, a.value, 0))/SUM(a.value)*100),2) zhemgang ,
							ROUND((SUM(a.value)/SUM(a.value)*100),0) total  
							FROM
							t_origin_survey a   
							WHERE a.visitor_type_id = 316 
							AND a.report_category_id = $report_category_id
							AND a.year = $year;
		        ");
			}
			//Visitor,visitor nights and expenditure by Dzongkhag visited
			else if($report_name_id==24){
				$query = \DB::select("SELECT 
						b.dzongkhag_name,
						c.visitors,
						ROUND((c.visitors/d.total_visitors)*100,2) visitors_percent,
						c.nights,
						ROUND((c.nights/d.total_nights)*100,2) nights_percent,
						a.avg_expenditure_night,
						a.avg_expenditure_trip,
						ROUND(a.tot_expenditure/1000000,2)tot_expenditure  
					FROM
						t_totexpenditure_survey a 
						LEFT JOIN t_dzongkhag_masters b 
						ON a.location_id = b.id 
						LEFT JOIN 
						(SELECT 
							a.report_category_id,
							a.year,
							a.location_id,
							SUM(
							IF(a.visitor_type_id = 316, a.value, 0)
							) visitors,
							SUM(
							IF(a.visitor_type_id = 317, a.value, 0)
							) nights 
						FROM
							t_purpose_survey a 
						WHERE a.report_category_id = $report_category_id
							AND a.year = $year
						GROUP BY a.location_id 
						ORDER BY a.location_id) c 
						ON a.location_id = c.location_id 
						AND a.report_category_id = c.report_category_id 
						AND a.year = c.year 
						LEFT JOIN (SELECT 
						a.report_category_id,
						a.year,
						SUM(
							IF(a.visitor_type_id = 316, a.value, 0)
						) total_visitors,
						SUM(
							IF(a.visitor_type_id = 317, a.value, 0)
						) total_nights 
						FROM
						t_purpose_survey a WHERE a.report_category_id = $report_category_id
						AND a.year = $year ) d ON c.year = d.year AND c.report_category_id = d.report_category_id 
					WHERE a.report_category_id = $report_category_id 
						AND a.year = $year;
	         	");
			}
			//Total expenditure by purpose and expenditure item(in Nu.Million)
			else if($report_name_id==26){
				$query = \DB::select("SELECT 
							b.dropdown_name,
							ROUND(SUM(IF(a.exp_item_id = 332, a.value, 0))/1000000,3) accommodation,
							ROUND(SUM(IF(a.exp_item_id = 333, a.value, 0))/1000000,3) air,
							ROUND(SUM(IF(a.exp_item_id = 334, a.value, 0))/1000000,3) car_rental,
							ROUND(SUM(IF(a.exp_item_id = 335, a.value, 0))/1000000,3) entertainment,
							ROUND(SUM(IF(a.exp_item_id = 336, a.value, 0))/1000000,3) fuel_cost,
							ROUND(SUM(IF(a.exp_item_id = 337, a.value, 0))/1000000,3) food,
							ROUND(SUM(IF(a.exp_item_id = 338, a.value, 0))/1000000,3) local_transport,
							ROUND(SUM(IF(a.exp_item_id = 339, a.value, 0))/1000000,3) long_distance,
							ROUND(SUM(IF(a.exp_item_id = 340, a.value, 0))/1000000,3) medical,
							ROUND(SUM(IF(a.exp_item_id = 341, a.value, 0))/1000000,3) mice,
							ROUND(SUM(IF(a.exp_item_id = 342, a.value, 0))/1000000,3) others,
							ROUND(SUM(IF(a.exp_item_id = 343, a.value, 0))/1000000,3) shopping,
							ROUND(SUM(IF(a.exp_item_id = 344, a.value, 0))/1000000,3) tour_package,
							ROUND(SUM(a.value)/1000000,3) total 
						FROM
							t_tripexpenditure_survey a 
							LEFT JOIN t_dropdown_lists b 
							ON a.purpose_id = b.id 
						WHERE a.trip_type_id = 347 
							AND a.report_category_id =$report_category_id 
							AND a.year =$year
						GROUP BY a.purpose_id ");
				 }
			//Mean expenditure by purpose and expenditure item
			else if($report_name_id==27){
				$query = \DB::select("SELECT 
						b.dropdown_name,
						SUM(IF(a.exp_item_id = 332, a.value, 0)) accommodation,
						SUM(IF(a.exp_item_id = 333, a.value, 0)) air,
						SUM(IF(a.exp_item_id = 334, a.value, 0)) car_rental,
						SUM(IF(a.exp_item_id = 335, a.value, 0)) entertainment,
						SUM(IF(a.exp_item_id = 336, a.value, 0)) fuel_cost,
						SUM(IF(a.exp_item_id = 337, a.value, 0)) food,
						SUM(IF(a.exp_item_id = 338, a.value, 0)) local_transport,
						SUM(IF(a.exp_item_id = 339, a.value, 0)) long_distance,
						SUM(IF(a.exp_item_id = 340, a.value, 0)) medical,
						SUM(IF(a.exp_item_id = 341, a.value, 0)) mice,
						SUM(IF(a.exp_item_id = 342, a.value, 0)) others,
						SUM(IF(a.exp_item_id = 343, a.value, 0)) shopping,
						SUM(IF(a.exp_item_id = 344, a.value, 0)) tour_package,
						SUM(IF(a.exp_item_id = 345, a.value, 0)) total 
					FROM
						t_tripexpenditure_survey a 
						LEFT JOIN t_dropdown_lists b 
						ON a.purpose_id = b.id 
					WHERE a.trip_type_id = 348 
						AND a.report_category_id = $report_category_id 
						AND a.year = $year 
					GROUP BY a.purpose_id ");
			    }
		 }
		//Domestic Excursion/ Daytrip
		 else if($report_category_id==4){
			 //Daytrip(excursion) visitors by Dzongkhag visited and sex
			if($report_name_id==30){
				$query = \DB::select("SELECT 
						b.dzongkhag_name,
						SUM(IF(a.gender='M',a.value,0)) male,
						ROUND((SUM(IF(a.gender='M',a.value,0))/SUM(a.value))*100,2) male_percent,
						SUM(IF(a.gender='F',a.value,0)) female,
						ROUND((SUM(IF(a.gender='F',a.value,0))/SUM(a.value))*100,2) female_percent,
						SUM(a.value) total 
						FROM
						t_purpose_survey a 
						LEFT JOIN t_dzongkhag_masters b 
						ON a.location_id = b.id 
						WHERE a.report_category_id = $report_category_id 
						AND a.year = $year 
						GROUP BY a.location_id 
						ORDER BY a.location_id");
			 }
			//Daytrip(excursion) visitors by purpose,sex and Dzongkhag visited 
			else if($report_name_id==34){
				$query = \DB::select("SELECT a.* FROM (SELECT 
						b.dzongkhag_name,
						a.gender,
						SUM(IF(a.purpose_id = 318, a.value, 0)) business, 
						SUM(IF(a.purpose_id = 319, a.value, 0)) education, 
						SUM(IF(a.purpose_id = 320, a.value, 0)) health, 
						SUM(IF(a.purpose_id = 321, a.value, 0)) holiday, 
						SUM(IF(a.purpose_id = 322, a.value, 0)) others, 
						SUM(IF(a.purpose_id = 323, a.value, 0)) personal, 
						SUM(IF(a.purpose_id = 324, a.value, 0)) religion, 
						SUM(IF(a.purpose_id = 325, a.value, 0)) visiting 
					FROM
						t_purpose_survey a 
						LEFT JOIN t_dzongkhag_masters b 
						ON a.location_id = b.id 
					WHERE a.report_category_id =$report_category_id  
						AND a.year = $year 
					GROUP BY a.gender,
						a.location_id  
					UNION 
					SELECT 
						'Total' dzongkhag_name,
						a.gender,
						SUM(IF(a.purpose_id = 318, a.value, 0)) business, 
						SUM(IF(a.purpose_id = 319, a.value, 0)) education, 
						SUM(IF(a.purpose_id = 320, a.value, 0)) health, 
						SUM(IF(a.purpose_id = 321, a.value, 0)) holiday, 
						SUM(IF(a.purpose_id = 322, a.value, 0)) others, 
						SUM(IF(a.purpose_id = 323, a.value, 0)) personal, 
						SUM(IF(a.purpose_id = 324, a.value, 0)) religion, 
						SUM(IF(a.purpose_id = 325, a.value, 0)) visiting 
					FROM
						t_purpose_survey a 
						LEFT JOIN t_dzongkhag_masters b 
						ON a.location_id = b.id 
					WHERE a.report_category_id = $report_category_id 
						AND a.year = $year 
					GROUP BY a.gender 
					UNION 
					SELECT 
						'Total' dzongkhag_name,
						'total' gender,
						SUM(IF(a.purpose_id = 318, a.value, 0)) business, 
						SUM(IF(a.purpose_id = 319, a.value, 0)) education, 
						SUM(IF(a.purpose_id = 320, a.value, 0)) health, 
						SUM(IF(a.purpose_id = 321, a.value, 0)) holiday, 
						SUM(IF(a.purpose_id = 322, a.value, 0)) others, 
						SUM(IF(a.purpose_id = 323, a.value, 0)) personal, 
						SUM(IF(a.purpose_id = 324, a.value, 0)) religion, 
						SUM(IF(a.purpose_id = 325, a.value, 0)) visiting 
					FROM
						t_purpose_survey a 
						LEFT JOIN t_dzongkhag_masters b 
						ON a.location_id = b.id 
					WHERE a.report_category_id = $report_category_id  
						AND a.year = $year)a ORDER BY a.dzongkhag_name,a.gender");
				}
				//Daytrip(excursion) visitors and expenditure by Dzongkhag visited and purpose of visited
				else if($report_name_id==35){
					$query = \DB::select("SELECT * FROM (SELECT t.* FROM
							(SELECT 
							b.dzongkhag_name,
							SUM(IF(a.purpose_id=318, a.value,0)) business,
							SUM(IF(a.purpose_id=319, a.value,0)) education,
							SUM(IF(a.purpose_id=320, a.value,0)) health,
							SUM(IF(a.purpose_id=321, a.value,0)) holiday,
							SUM(IF(a.purpose_id=322, a.value,0)) others,
							SUM(IF(a.purpose_id=323, a.value,0)) personal,
							SUM(IF(a.purpose_id=324, a.value,0)) religion,
							SUM(IF(a.purpose_id=325, a.value,0)) visiting,
							SUM(a.value) total_visitor,
							(SELECT 
							FORMAT(tot_expenditure/1000000,2) 
							FROM
							t_totexpenditure_survey WHERE location_id=a.location_id AND report_category_id=a.report_category_id) AS  total_expenditure
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dzongkhag_masters b ON a.location_id = b.id
							WHERE a.report_category_id = $report_category_id 
							AND a.year = $year
							GROUP BY a.location_id 
							ORDER BY a.location_id
							)t
							UNION
							(SELECT 
							'Total' AS dzongkhag_name,
							SUM(business) AS business,
							SUM(education) AS education,
							SUM(health) AS health,
							SUM(holiday) AS holiday,
							SUM(others) AS others,
							SUM(personal) AS personal,
							SUM(religion) AS religion,  
							SUM(visiting) AS visiting,
							SUM(total_visitor) AS total_visitor,
							SUM(total_expenditure) AS total_expenditure 
							FROM (SELECT 
							b.dzongkhag_name,
							SUM(IF(a.purpose_id=318, a.value,0)) business,
							SUM(IF(a.purpose_id=319, a.value,0)) education,
							SUM(IF(a.purpose_id=320, a.value,0)) health,
							SUM(IF(a.purpose_id=321, a.value,0)) holiday,
							SUM(IF(a.purpose_id=322, a.value,0)) others,
							SUM(IF(a.purpose_id=323, a.value,0)) personal,
							SUM(IF(a.purpose_id=324, a.value,0)) religion,
							SUM(IF(a.purpose_id=325, a.value,0)) visiting,
							SUM(a.value) total_visitor,
							(SELECT 
							FORMAT(tot_expenditure/1000000,2) 
							FROM
							t_totexpenditure_survey WHERE location_id=a.location_id AND report_category_id=a.report_category_id) AS  total_expenditure
							FROM
							t_purpose_survey a 
							LEFT JOIN t_dzongkhag_masters b ON a.location_id = b.id
							WHERE a.report_category_id = $report_category_id 
							AND a.year = $year
							GROUP BY a.location_id 
							ORDER BY a.location_id
							)t))t1;
			     	"); 
				}
				//Daytrip(excursion) mean trip expenditure by item of expenditure and main purpose
				else if($report_name_id==36){
					$query = \DB::select("SELECT 
								b.dropdown_name,
								SUM(IF(a.exp_item_id = 334, a.value, 0)) car_rental,
								SUM(IF(a.exp_item_id = 335, a.value, 0)) entertainment,
								SUM(IF(a.exp_item_id = 336, a.value, 0)) fuel_cost,
								SUM(IF(a.exp_item_id = 337, a.value, 0)) food,
								SUM(IF(a.exp_item_id = 338, a.value, 0)) local_transport,
								SUM(IF(a.exp_item_id = 339, a.value, 0)) long_distance,
								SUM(IF(a.exp_item_id = 340, a.value, 0)) medical,
								SUM(IF(a.exp_item_id = 341, a.value, 0)) mice,
								SUM(IF(a.exp_item_id = 342, a.value, 0)) others,
								SUM(IF(a.exp_item_id = 343, a.value, 0)) shopping,
								SUM(IF(a.exp_item_id = 345, a.value, 0)) total_expenditure 
								FROM
								t_tripexpenditure_survey a 
								LEFT JOIN t_dropdown_lists b 
								ON a.purpose_id = b.id 
								WHERE a.trip_type_id = 348 
								AND a.report_category_id = $report_category_id 
								AND a.year = $year
								GROUP BY a.purpose_id
					   ");
					}
				//Daytrip(excursion) total trip expenditure by item of expenditure and main purpose(Nu.Million)
				else if($report_name_id==37){
					$query = \DB::select("SELECT t2.* FROM (SELECT t1.* FROM 
								(SELECT 
								b.dropdown_name,
								FORMAT(SUM(IF(a.exp_item_id = 334, a.value, 0))/1000000,3) car_rental,
								FORMAT(SUM(IF(a.exp_item_id = 335, a.value, 0))/1000000,3) entertainment,
								FORMAT(SUM(IF(a.exp_item_id = 336, a.value, 0))/1000000,3) fuel_cost,
								FORMAT(SUM(IF(a.exp_item_id = 337, a.value, 0))/1000000,3) food,
								FORMAT(SUM(IF(a.exp_item_id = 338, a.value, 0))/1000000,3) local_transport,
								FORMAT(SUM(IF(a.exp_item_id = 339, a.value, 0))/1000000,3) long_distance,
								FORMAT(SUM(IF(a.exp_item_id = 340, a.value, 0))/1000000,3) medical,
								FORMAT(SUM(IF(a.exp_item_id = 341, a.value, 0))/1000000,3)mice,
								FORMAT(SUM(IF(a.exp_item_id = 342, a.value, 0))/1000000,3) others,
								FORMAT(SUM(IF(a.exp_item_id = 343, a.value, 0))/1000000,3)shopping,
								SUM(a.value)/1000000 total_expenditure
								FROM
								t_tripexpenditure_survey a 
								LEFT JOIN t_dropdown_lists b 
								ON a.purpose_id = b.id 
								WHERE a.trip_type_id = 347
								AND a.report_category_id =$report_category_id 
								AND a.year = $year
								GROUP BY a.purpose_id)t1
								UNION 
								(SELECT 
								'Total' dropdown_name,
								FORMAT(SUM(car_rental),3) car_rental,
								FORMAT(SUM(entertainment),3) entertainment,
								FORMAT(SUM(fuel_cost),0) fuel_cost,
								FORMAT(SUM(food),0) food,
								FORMAT(SUM(local_transport),0) local_transport,
								FORMAT(SUM(long_distance),0) long_distance,
								FORMAT(SUM(medical),0) medical,
								FORMAT(SUM(mice),0)mice,
								FORMAT(SUM(others),0) others,
								FORMAT(SUM(shopping),0)shopping,
								FORMAT(SUM(total_expenditure),3) total_expenditure
								FROM 
								(SELECT 
								b.dropdown_name,
								FORMAT(SUM(IF(a.exp_item_id = 334, a.value, 0))/1000000,3) car_rental,
								FORMAT(SUM(IF(a.exp_item_id = 335, a.value, 0))/1000000,3) entertainment,
								FORMAT(SUM(IF(a.exp_item_id = 336, a.value, 0))/1000000,3) fuel_cost,
								FORMAT(SUM(IF(a.exp_item_id = 337, a.value, 0))/1000000,3) food,
								FORMAT(SUM(IF(a.exp_item_id = 338, a.value, 0))/1000000,3) local_transport,
								FORMAT(SUM(IF(a.exp_item_id = 339, a.value, 0))/1000000,3) long_distance,
								FORMAT(SUM(IF(a.exp_item_id = 340, a.value, 0))/1000000,3) medical,
								FORMAT(SUM(IF(a.exp_item_id = 341, a.value, 0))/1000000,3)mice,
								FORMAT(SUM(IF(a.exp_item_id = 342, a.value, 0))/1000000,3) others,
								FORMAT(SUM(IF(a.exp_item_id = 343, a.value, 0))/1000000,3)shopping,
								SUM(a.value)/1000000 total_expenditure
								FROM
								t_tripexpenditure_survey a 
								LEFT JOIN t_dropdown_lists b 
								ON a.purpose_id = b.id 
								WHERE a.trip_type_id = 347
								AND a.report_category_id =$report_category_id 
								AND a.year = $year
								GROUP BY a.purpose_id)t1))t2
					    ");
					}
				//Daytrip(excursion) visitors and expenditure by Dzongkhag visited
				else if($report_name_id==40){
					$query = \DB::select("SELECT 
							b.dzongkhag_name,
							c.visitors,
							a.avg_expenditure_trip,
							FORMAT(a.tot_expenditure/1000000,3)tot_expenditure 
							FROM
							t_totexpenditure_survey a 
							LEFT JOIN t_dzongkhag_masters b 
							ON a.location_id = b.id 
							LEFT JOIN 
							(SELECT 
							a.report_category_id,
							a.year,
							a.location_id,
							SUM(a.value)visitors
							FROM
							t_purpose_survey a 
							WHERE a.report_category_id = $report_category_id 
							AND a.year =$year
							GROUP BY a.location_id 
							ORDER BY a.location_id) c 
							ON a.location_id = c.location_id 
							AND a.report_category_id = c.report_category_id 
							AND a.year = c.year 
							LEFT JOIN (SELECT 
							a.report_category_id,
							a.year,
							a.location_id,
							SUM(a.value)visitors
							FROM
							t_purpose_survey a WHERE a.report_category_id = $report_category_id 
							AND a.year = $year) d ON c.year = d.year AND c.report_category_id = d.report_category_id 
							WHERE a.report_category_id = $report_category_id 
							AND a.year = $year;
						");
				}
			}
      }
    return $query;
   }
}
