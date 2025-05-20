<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        // Fetch sales and paginate them, eager load the product
        $sales = Sales::with('product')->all();
            $products = Product::all(); // Or any other logic to get products

        // return view('sales.index', [
        //     'sales' => $sales,
        //     'transactions' => $transactions,
        // ]);
        // Pass the sales data to the view

        return view('sales.index', compact('sales', 'products' ));
    }

    // Optional: Method to handle deleting a sale
    public function destroy(Sales $sale)
    {
        // Find the related product
        $product = $sale->product;

        if ($product) {
            // Add the quantity sold back to the product stock
            $product->quantity += $sale->quantity;
            $product->save();
        }

        // Delete the sale
        $sale->delete();

        return redirect()->back()->with('success', 'Sale deleted and stock updated successfully.');
    }






    // SalesController.php
    // Save sales data to the sales history table
    public function saveSalesData(Request $request)
    {
        $salesData = $request->input('sales');

        try {
            foreach ($salesData as $sale) {
                Sales::create([
                    'product_id' => $sale['product']['id'],
                    'quantity' => $sale['quantity'],
                    'total_price' => $sale['total_price'],
                    'sale_date' => now(),
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Retrieve all saved sales records and pass them to the view
    public function viewSalesRecords()
    {
        $salesRecords = Sales::with('product')->orderBy('sale_date', 'desc')->get();
        return view('sales_records', ['salesRecords' => $salesRecords]);
    }

    public function clearAll()
{
    // Fetch all sales
    $sales = Sales::all();

    // Restore product quantities in the products table
    foreach ($sales as $sale) {
        // Update product stock by adding the quantity sold back
        $product = $sale->product;
        $product->quantity += $sale->quantity;  // Add the quantity sold back to the stock
        $product->save();  // Save the updated product
    }

    // Delete all sales records
    Sales::truncate();  // Deletes all records from the sales table

    // Redirect back with a success message
    // Redirect back with a success message
    return redirect()->route('product.index')->with('success', 'All sales records have been deleted successfully.');
}
public function showSales()
{
    $sales = Sales::with('product')->get(); // Get sales data with related products
    $total = $sales->sum('total_price'); // Calculate total from sales

    return view('product.index', compact('sales', 'total'));
}



// public function search(Request $request)
// {
//     $query = $request->query('query');

//     Log::info("Search query: {$query}"); // Log the search term

//     $product = Product::where('product_name', 'like', "%{$query}%")
//                 ->orWhere('code', 'like', "%{$query}%")
//                 ->first();

//     if ($product) {
//         Log::info("Product found: " . $product->product_name); // Log product found
//         return response()->json(['success' => true, 'product' => $product]);
//     } else {
//         Log::info("Product not found for query: {$query}"); // Log product not found
//         return response()->json(['success' => false, 'message' => 'Product not found']);
//     }
// }

// In SaleController.php
public function updateQuantity(Request $request, Sales $sale)
{
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
        'total_price' => 'required|numeric|min:0',
        'product_id' => 'required|integer|exists:products,id'
    ]);

    $product = Product::findOrFail($validated['product_id']);
    $quantityChange = $validated['quantity'] - $sale->quantity;

    // Update product stock
    $product->quantity -= $quantityChange;
    if ($product->quantity < 0) {
        return response()->json(['error' => 'Insufficient stock.'], 400);
    }
    $product->save();

    // Update sale
    $sale->quantity = $validated['quantity'];
    $sale->total_price = $validated['total_price'];
    $sale->save();

    return response()->json(['success' => true, 'new_stock' => $product->quantity]);
}


public function store(Request $request)
{
    // Validate the input data
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity_sold' => 'required|integer|min:1',
    ]);

    // Find the product
    $product = Product::findOrFail($request->product_id);

    // Calculate the total price
    $totalPrice = $product->price * $request->quantity_sold;

    // Create a new sale entry in the sales table
    $sale = new Sales();
    $sale->product_id = $request->product_id;
    $sale->quantity = $request->quantity_sold;
    $sale->total_price = $totalPrice;
    $sale->sale_date = now(); // current date and time
    $sale->save();

    // Update the product stock (reduce the quantity)
    $product->quantity -= $request->quantity_sold;
    $product->save();

    return response()->json(['success' => true, 'message' => 'Sale saved successfully.']);
}




}
