<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransactionHistoryController extends Controller
{
    public function store(Request $request)
    {
              // Get the cashier's name from the session (assuming it's stored there)
    $cashierName = session('cashierName', 'Unknown Cashier'); // Default to 'Unknown Cashier' if not set

         // Calculate tax (5% of total_amount)
    $totalAmount = $request->input('total_amount');
    $tax = $totalAmount * 0.05;

        // Retrieve discount and payment received
        // $discount = $request->input('discount', 0); // Default to 0 if not provided
        // $paymentReceived = $request->input('payment_received', 0); // Default to 0 if not provided

        // Save the transaction to the database
        TransactionHistory::create([
            'reference_id' => $request->input('reference_id'),
            'date' => Carbon::parse($request->input('date')),
            'sales_data' => json_encode($request->input('sales_data')), // Save as JSON string
            'total_amount' => $request->input('total_amount'),
            'tax' => $tax,
            'discount' => $request->input('discount',0),
            'payment_received' => $request->input('payment_received',0),
            'cashier_name' => $cashierName,  // Save cashier name
        ]);
         // Clear (truncate) sales data (reset or delete from the relevant table)
         DB::table('sales')->truncate(); // Assuming your sales data is stored in the 'sales' table

        return response()->json(['status' => 'success']);
    }

    // Optional: method to view transaction history
    public function index()
    {
        $transactions = TransactionHistory::All();
        // $transactions = TransactionHistory::with('cashier')->get(); // Eager load cashier relation
         // Group transactions by cashier name
    $groupedTransactions = $transactions->groupBy('cashier_name');

        return view('transaction_history.index', compact('transactions', 'transactionsForDate', 'groupedTransactions'));
    }

    public function showTransactionHistory(Request $request)
    {
        $query = TransactionHistory::query();

        // Filter by reference_id if input is provided
        if ($request->has('reference_id') && $request->reference_id) {
            $query->where('reference_id', 'like', '%' . $request->reference_id . '%');
        }

        // Filter by date if input is provided
        if ($request->has('date') && $request->date) {
            $date = Carbon::createFromFormat('Y-m-d', $request->date)->startOfDay();
            $query->whereDate('date', $date);
        }

        $transactions = $query->get(); // Or paginate if necessary
        $transactions = TransactionHistory::all(); // Get all transactions
        return view('transaction_history/index', compact('transactions'));
    }

    public function getLastReferenceID()
    {
        $lastID = DB::table('transaction_histories')->max('reference_id');

        if ($lastID) {
            // Extract numeric part if it's prefixed (e.g., "REF-00000001")
            $numericPart = preg_replace('/\D/', '', $lastID); // Remove non-numeric characters
            return response()->json(['lastReferenceID' => $numericPart ? (int) $numericPart : 0]);
        }

        return response()->json(['lastReferenceID' => 0]); // Default to 0 if table is empty
    }




}
