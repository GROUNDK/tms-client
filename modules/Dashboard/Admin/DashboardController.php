<?php
namespace Modules\Dashboard\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminController;
use Modules\Booking\Models\Booking;

class DashboardController extends AdminController
{
    public function index(Request $request,Response $res)
    {
        $f = strtotime('monday this week');
        $data = [
            'recent_bookings'    => Booking::getRecentBookings(),
            'top_cards'          => Booking::getTopCardsReport(),
            'earning_chart_data' => Booking::getDashboardChartData($f, time())
        ];


        if ($request->isMethod('post')) {
            return view('Dashboard::index', $data);
        }else{
            return response()->json($data, 200);
        }
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => Booking::getDashboardChartData(strtotime($from), strtotime($to))
                ]);
                break;
        }
    }
}