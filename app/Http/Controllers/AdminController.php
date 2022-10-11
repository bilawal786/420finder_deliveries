<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Deal;
use App\Models\DeliveryProducts;
use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login()
    {
        if (Session::has('business_id')) {
            return redirect()->route('index');
        } else {
            return view('login');
        }
    }

    public function index()
    {
        $deals = Deal::whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])->selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
            ->groupBy('year', 'month')
            ->pluck('count')
            ->toArray();
        $totalDeals = Deal::where('retailer_id', session('business_id'))->count();
        $neworders = Order::where('retailer_id', session('business_id'))->where('status', 'Submitted')->count();
        $acceptorders = Order::where('retailer_id', session('business_id'))->where('status', 'Accepted')->count();
        $reviews = Business::where('id', session('business_id'))->select('reviews_count')->first();
        $visitor = DB::table('visitors')->where('business_id', session('business_id'))->count();
        $subscription = DB::table('subscription_details')->orderBy('id', 'DESC')->where('retailer_id', '=', session('business_id'))->first();
        $currentDate = date('Y-m-d');
        $currentDate = date('Y-m-d', strtotime($currentDate));
        $startDate = date('Y-m-d', strtotime($subscription->starting_date ?? '12-2-2021'));
        $endDate = date('Y-m-d', strtotime($subscription->ending_date ?? '12-2-2021'));
        if ($subscription != null) {
            if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
                $sub = 'Active';
            } else {
                $sub = 'Expired';
            }
        } else {
            $sub = 'Not Purchase';
        }
        $sales = [];
        for ($month = 1; $month <= date('m'); $month++) {
            $date = Carbon::create(date('Y'), $month);
            $date_end = $date->copy()->endOfMonth();
            $sale = Order::where('retailer_id', session('business_id'))
                ->where('created_at', '>=', $date)
                ->where('created_at', '<=', $date_end)
                ->sum('price');
            array_push($sales, (int)$sale);
        }
        $totalSales = Order::where('retailer_id', session('business_id'))
            ->sum('price');
        $chart = (new LarapexChart)->lineChart()
            ->setTitle('Sales')
            ->setSubtitle('Total sales this year')
            ->addData('Sales', $sales)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
        $customers = Order::where('retailer_id', session('business_id'))
            ->select('customer_id')
            ->groupBy('customer_id')
            ->get();
        $products = DeliveryProducts::where('delivery_id', session('business_id'))->count();
        $pieChart = (new LarapexChart)->pieChart()
            ->setTitle('Statistics')
            ->setSubtitle('Year 2022')
            ->addData([count($deals), $products, $customers->count()])
            ->setLabels(['Deals', 'Products', 'Customers']);
        $deal_wallet = Business::where('id', session('business_id'))->select('deal_wallet')->first();
        return view('index', [
            'deals' => $deals,
            'chart' => $chart,
            'customers' => $customers->count(),
            'products' => $products,
            'totalSales' => $totalSales,
            'pieChart' => $pieChart,
            'totalDeals' => $totalDeals,
            'neworders' => $neworders,
            'acceptorders' => $acceptorders,
            'reviews' => $reviews->reviews_count,
            'visitor' => $visitor,
            'sub' => $sub,
            'freedeals' => $deal_wallet,
        ]);
    }

    public function checkLogin(Request $request)
    {
        $business = Business::where('email', $request->email)->where('business_type', 'delivery')->get();
        if (count($business) > 0) {
            $savedpassword = $business[0]['password'];
            $newpass = $request->password;
            if (\Hash::check($newpass, $savedpassword)) {
                if ($business[0]['status'] == 0) {
                    return back()->with('error', 'Your account is under review by our account management team. Please have patience until you are approched by our account management team.');
                } elseif ($business[0]['status'] == 1) {
                    $business_id = $business[0]['id'];
                    $business_name = $business[0]['name'];
                    $business_id = $request->session()->put('business_id', $business_id);
                    $business_name = $request->session()->put('business_name', $business_name);
                    $business_type = $request->session()->put('business_type', $business[0]['business_type']);
                    if (Session::has("prevUrl")) {
                        return redirect()->to(Session::get('prevUrl'));
                    } else {
                        return redirect()->route('index');
                    }
                } elseif ($business[0]['status'] == 2) {
                    return back()->with('error', 'Your account is blocked due to some reason. For further information please contact us.');
                }
            } else {
                return back()->with('error', 'Password you entered is invalid!');
            }
        } else {
            return back()->with('error', 'Email you entered is invalid!');
        }
    }

    public function logoutadmin()
    {
        session()->forget('business_id');
        session()->forget('business_name');
        return redirect()->route('login');
    }
}
