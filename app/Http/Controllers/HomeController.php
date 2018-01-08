<?php

namespace HASSLOGISTICS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use View;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authen');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = \HASSLOGISTICS\Client::orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $vessels = \HASSLOGISTICS\Vessel::join('Vessel_Operators', 'Vessel_Operators.vessel_operator_id', '=', 'Vessels.vessel_operator_id')
            ->orderBy('arrival_date', 'desc')
            ->take(20)
            ->get();

        $audits = \HASSLOGISTICS\Audit::join('Users', 'Users.username', '=', 'Audit.user')->whereRaw('Date(audit.created_at) = CURDATE()')->get();
        $totalClients = \HASSLOGISTICS\Client::count();
        $totalVessels = \HASSLOGISTICS\Vessel::count();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();

        $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where YEAR(created_at) = YEAR(CURDATE()); '))[0]->total;
        $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where YEAR(created_at) = YEAR(CURDATE()); '))[0]->total;

        return View::make('dashboard')
            ->with(compact('clients'))
            ->with(compact('vessels'))
            ->with(compact('audits'))
            ->with(compact('totalClients'))
            ->with(compact('unapprovedInvoices'))
            ->with(compact('totalVessels'))
            ->with(compact('pendingPayments'))
            ->with(compact('completedPayments'));

    }

    public function paymentSummary(Request $request)
    {
        $range = $request->val;
        if ($range == 'full-year') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where YEAR(created_at) = YEAR(CURDATE()); '))[0]->total;
            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where YEAR(created_at) = YEAR(CURDATE()); '))[0]->total;

            Log::debug($pendingPayments);
            Log::debug($completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        } else if ($range == 'first-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 1'))[0]->total;
            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 1'))[0]->total;

            Log::debug($pendingPayments);
            Log::debug($completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        } else if ($range == 'second-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 2'))[0]->total;

            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 2'))[0]->total;

            Log::debug($pendingPayments);
            Log::debug($completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        } else if ($range == 'third-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 3'))[0]->total;

            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 3'))[0]->total;

            Log::debug($pendingPayments);
            Log::debug($completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        } else if ($range == 'fourth-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 4'))[0]->total;

            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 4'))[0]->total;

            Log::debug($pendingPayments);
            Log::debug($completedPayments);
            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        }

    }

    public function paymentStatistics(Request $request)
    {
        $data = array();

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where MONTHNAME(invoice_header.created_at) = "January" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $firstMonth = ["period" => "Jan",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $firstMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "February" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $secondMonth = ["period" => "Feb",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $secondMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "March" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $thirdMonth = ["period" => "Mar",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $thirdMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "April" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $fourthMonth = ["period" => "Apr",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $fourthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "May" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $fifthMonth = ["period" => "May",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $fifthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "June" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $sixthMonth = ["period" => "Jun",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $sixthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "July" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $seventhMonth = ["period" => "Jul",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $seventhMonth);

        $eightMonth = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "August" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $eightMonth = ["period" => "Aug",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $eightMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "September" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $ninthMonth = ["period" => "Sep",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $ninthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "October" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $tenthMonth = ["period" => "Oct",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $tenthMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "November" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $eleventhMonth = ["period" => "Nov",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];

        array_push($data, $eleventhMonth);

        $result = \DB::select(\DB::raw('select SUM(amount_paid) as tot_amount_paid, SUM(total_amount) as tot_amount_invoiced
        from payments
        join invoice_header on invoice_header.invoice_no = payments.invoice_no
        where  MONTHNAME(invoice_header.created_at) = "December" and YEAR(invoice_header.created_at) = YEAR(CURDATE())'));

        $twelvethMonth = ["period" => "Dec",
            "Invoices" => $result[0]->tot_amount_invoiced == null ? 0.0 : $result[0]->tot_amount_invoiced,
            "Payments" => $result[0]->tot_amount_paid == null ? 0.0 : $result[0]->tot_amount_paid];
        array_push($data, $twelvethMonth);

        Log::debug($data);
        return response()->json($data);
    }

}
