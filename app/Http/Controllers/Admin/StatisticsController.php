<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class StatisticsController extends Controller
{
    public function getRevenue(){
        
        $time = Carbon::now();
        $now = $time->format('Y-m-d');
        $before  = $time->subDays(19)->format('Y-m-d');
        // lấy doanh thu 20 ngày gần nhất
        $doanhthu = DB::select("
            select dates.date as date, ifNull(sum(bills.total_price),0) as total_price, ifnull(count(bills.id),0) as total_bill 
            from dates LEFT JOIN bills on Cast(dates.date as date) = Cast(bills.created_at  as date)
            where dates.date >= :before  and dates.date <= :now
            group by dates.date
            ORDER BY dates.date ASC
        ",['before'=>$before,'now'=>$now]); // truyền tham số

        return view('admin.statistics.revenue', compact('doanhthu'));
    }

    public function postReportDate(Request $request){
        $type = $request->type;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $from_date_format = Carbon::parse($from_date)->format('d-m-Y');
        $to_date_format = Carbon::parse($to_date)->format('d-m-Y');
    
        // GROUP BY year(CAST(dates.date as date)), month(CAST(dates.date as date))
        switch($type){
            case 'day': 
                $query = "SELECT dates.date as day, YEAR(CAST(dates.date as date)) as year, ifnull(sum(bills.total_price),0) as total_price, ifnull(count(bills.id),0) as total_bill 
                FROM dates LEFT JOIN bills on Cast(dates.date as date) = Cast(bills.created_at as date) 
                WHERE dates.date >= :from_date  and dates.date <= :to_date
                GROUP BY day
                ORDER BY day ASC";
                $title = "Lọc theo ngày từ ngày ".$from_date_format." đến ".$to_date_format;
                break;
            case 'month' :
                $query = "SELECT MONTH(CAST(dates.date as date)) as month, YEAR(CAST(dates.date as date)) as year, IFNULL(sum(bills.total_price),0) as total_price, IFNULL(count(bills.id),0) as total_bill 
                FROM dates LEFT JOIN bills on Cast(dates.date as date) = Cast(bills.created_at as date) 
                WHERE dates.date >= :from_date  and dates.date <= :to_date 
                GROUP BY year, month
                ORDER BY year, month ASC
                ";
                $title = "Lọc theo tháng từ ngày ".$from_date_format." đến ".$to_date_format;
                break;
            case 'year' : 
                $query = "SELECT YEAR(CAST(dates.date as date)) as year,IFNULL(sum(bills.total_price),0) as total_price, ifnull(count(bills.id),0) as total_bill
                FROM dates LEFT JOIN bills on Cast(dates.date as date) = Cast(bills.created_at as date)
                WHERE dates.date >= :from_date  and dates.date <= :to_date 
                GROUP BY year
                ORDER BY year ASC
                ";
                $title = "Lọc theo năm từ ngày ".$from_date_format." đến ".$to_date_format;
                break;
            defaut: 
                $query = null;
        }

        if(!empty($query)){
            $data = DB::select($query,['from_date'=>$from_date, 'to_date'=>$to_date]);
            return view('admin.statistics.result_data',compact('data','title','type'));
        }else{
        }
    }
}