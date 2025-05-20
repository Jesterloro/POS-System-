<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Cashier;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;



class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::all();
        $products = Product::paginate(100);

        $productCount = Product::count(); // Assuming you have a Product model
    // $totalProducts = $products->count(); // This counts the number of products
    // Check if a category filter is applied
    $query = Product::query();
    if ($request->has('category_id') && $request->category_id) {
        $query->where('category_id', $request->category_id);
    }

         $sales = Sales::with('product')->get();

         // Calculate subtotal
         $subtotal = $sales->sum('total_price');

         // If needed, you can calculate tax or other totals here
         $taxRate = 0.05; // Example: 5% tax rate
         $tax = $subtotal * $taxRate;

         // Calculate the total price
         $total = $subtotal + $tax;

        // Count the total number of cashiers
        // Count all cashiers without filtering by role
        $totalCashiers = Cashier::count();
        // Count the total transactions
    $totalTransactions = TransactionHistory::count();

     // Get the current date
     $today = Carbon::today();

     // Fetch the total number of transactions for today
     $totalTransactionsToday = TransactionHistory::whereDate('created_at', $today)->count();


      // Get all transactions
    $transactions = TransactionHistory::all();

    // Calculate total sales
    $totalSales = $transactions->sum('total_amount'); // Calculate the total sales

    // Get today's date
    $today = Carbon::today();

    // Filter transactions that were made today
    $todayTransactions = $transactions->filter(function($transaction) use ($today) {
        return Carbon::parse($transaction->date)->isToday(); // Check if the transaction's date is today
    });

    // Calculate today's total sales
    $todayTotalSales = $todayTransactions->sum('total_amount');

         // Generate a reference ID (you can customize this logic)
    $referenceId = uniqid('REF'); // For example, use a unique ID

    $query = $request->input('search');

    if ($query) {
        $products = Product::where('product_name', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->paginate(10) // Adjust pagination as needed
            ->appends(['search' => $query]);
    } else {
        $products = Product::paginate(100);
    }


    // search of low stocks products
    $search = $request->get('search');

    $lowStockProducts = Product::where('quantity', '<=', 10)
                               ->where(function($query) use ($search) {
                                   $query->where('product_name', 'like', '%'.$search.'%')
                                         ->orWhere('code', 'like', '%'.$search.'%');
                               })
                               ->paginate(10);
        return view('product.index', compact('products',  'sales','subtotal', 'tax','total','referenceId', 'productCount','lowStockProducts', 'totalCashiers', 'totalTransactions', 'totalTransactionsToday', 'transactions', 'totalSales', 'todayTotalSales' ));
    }
    public function create()
    {

        return view('product.create'); //
    }

    public function store(Request $request)
    {

        $request->validate([
            'code' => 'required|unique:products',
            'product_name' => 'required',
            'quantity' => 'required|integer',
            'barcode' => 'required',
            'price' => 'required|numeric',
        ]);

        // Create a new product with the original price saved
        $product = Product::create([
            'code' => $request->code,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'barcode' => $request->barcode,
            'price' => $request->price,
            'original_price' => $request->price, // Store the original price
        ]);

        // Save the product with the selected category (if applicable)

        return redirect()->route('product.index')
                         ->with('success', 'Product created successfully.');
    }



    public function update(Request $request, $id)
{
    $request->validate([
        'code' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'barcode' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0|max:100', // Validate the discount field
    ]);

    $product = Product::findOrFail($id);
      // If the original_price is not set, set it to the current price.
    if (!$product->original_price) {
        $product->original_price = $request->input('price');
    }

    // Always update price and original price together
    $product->price = $request->input('price');
    $product->original_price = $request->input('price'); // Ensure original_price mirrors price when price is updated


    $product->update([
        'code' => $request->input('code'),
        'product_name' => $request->input('product_name'),
        'barcode' => $request->input('barcode'),
        'price' => $request->input('price'),
        'discount' => $request->input('discount', 0), // If no discount is provided, default to 0

    ]);

    return redirect()->back()->with('success', 'Product updated successfully.');
}



public function destroy($id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);
      // Check if the product exists in sales
      if ($product->sales()->exists()) {
        return redirect()->back()->withErrors(['message' => 'Product cannot be deleted as it is associated with sales.']);
    }
    // Delete the product
    $product->delete();

        // Re-fetch and reorder the products by ID
        $products = Product::orderBy('id')->get();
    return redirect()->route('product.index')->with('success', 'Product deleted successfully');
}

 // Method to record sales and update product quantity
 public function importSales(Request $request, $id)
 {
     $request->validate([
         'quantity_sold' => 'required|integer|min:1',
         'total_price' => 'required|numeric',
     ]);

     // Find the product
     $product = Product::findOrFail($id);

     // Check if the product has enough quantity in stock
     $totalPrice = $product->price * $request->quantity_sold;
     if ($product->quantity < $request->quantity_sold) {
         return redirect()->back()->with('error', 'Not enough stock available.');
     }

     // Begin transaction to ensure atomicity
     DB::beginTransaction();
     try {
         // Create the sale record
         Sales::create([
             'product_id' => $product->id,
             'quantity' => $request->quantity_sold,
             'total_price' => $request->total_price,
             'sale_date' => now(),
         ]);

         // Update the product quantity
         $product->quantity -= $request->quantity_sold;
         $product->save();

         // Commit the transaction
         DB::commit();

         // Return success message
         return redirect()->route('product.index')->with('success', 'Sale imported successfully!');
     } catch (\Exception $e) {
         // Rollback in case of error
         DB::rollBack();
         return redirect()->route('product.index')->with('error', 'Something went wrong, please try again.');
     }
 }

 public function getSalesData()
{
    $sales = Sales::with('product')->get(); // Get all sales with their products
    return response()->json($sales);
}


public function submitTransaction()
{
    // Save transaction details as needed
    // Clear sales records for a fresh transaction
    Sales::truncate(); // Warning: This deletes all records in the Sale table
    // Redirect back with a success message
    return redirect()->route('product.index')->with('success', 'Transaction completed and sales data cleared.');
}


public function getProductData()
{
    return DataTables::of(Product::query())->make(true);
}



public function search(Request $request)
{
    $query = $request->input('search');
    $products = Product::where('product_name', 'like', "%{$query}%")
                    ->orWhere('code', 'like', "%{$query}%")
                    ->get();

    return response()->json(['products' => $products]);
}



public function getStockStatus()
{
    // Get paginated results for low stock and out of stock products
$lowStockProducts = Product::where('quantity', '<=', 10)->paginate(10);
$outOfStockProducts = Product::where('quantity', 0)->paginate(10);


    return view('settings.stock_status', compact('lowStockProducts', 'outOfStockProducts'));
}



public function updateQuantity(Request $request, $id)
{
    // Validate input
    $request->validate([
        'quantity' => 'required|integer|min:0',
    ]);

    // Find the product and update the quantity
    $product = Product::findOrFail($id);
    $product->quantity = $request->quantity;
    $product->save();

    return response()->json(['success' => true, 'message' => 'Quantity updated successfully.']);
}


// In ProductController.php
public function updateStock(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $quantitySold = $request->input('quantity_sold');

    // Decrease the stock by the quantity sold
    $product->quantity -= $quantitySold;
    $product->save();

    return response()->json(['success' => true]);
}
public function searchByBarcode($barcode)
{
    $product = Product::where('barcode', $barcode)->first();

    if ($product) {
        return response()->json(['product' => $product]);
    }

    return response()->json(['product' => null]);
}
public function updatePrice(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'new_price' => 'required|numeric|min:0',
        'new_discount' => 'required|numeric|min:0|max:100',
    ]);

    $product = Product::findOrFail($request->product_id);

    // If the discount is zero, revert the price to the original price
    if ($request->new_discount == 0) {
        $product->price = $product->original_price; // Revert to original price
    } else {
        $product->price = $request->new_price;  // Apply the discounted price
    }

    $product->discount = $request->new_discount;  // Save the discount in the database

    $product->save();

    return response()->json(['success' => true]);
}





public function updatePriceWithDiscount(Request $request)
{
    // Validate the discount value
    $request->validate([
        'new_discount' => 'required|numeric|min:0|max:100', // Ensure discount is between 0% and 100%
        'product_id' => 'required|exists:products,id', // Validate the product ID
    ]);

    // Find the product by ID
    $product = Product::find($request->product_id);

    // If the original price is not set, save the current price as the original price
    if (!$product->original_price) {
        $product->original_price = $product->price;
    }

    // Apply the discount and calculate the new price
    if ($request->new_discount > 0) {
        $product->price = $product->original_price - ($product->original_price * ($request->new_discount / 100));
    } else {
        // If the discount is zero, revert to the original price
        $product->price = $product->original_price;
    }

    // Save the discount value in the database
    $product->discount = $request->new_discount;

    // Save the updated product
    $product->save();

    return response()->json(['success' => true, 'new_price' => $product->price, 'discount' => $product->discount]);
}




}
