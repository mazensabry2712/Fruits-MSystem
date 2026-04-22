<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Get all transactions
    public function index()
    {
        $transactions = Transaction::orderBy('date', 'desc')->get();
        return response()->json($transactions);
    }

    // Store new transaction
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:شراء,بيع',
            'fruit' => 'required|exists:fruits,name',
            'quantity' => 'required|numeric|min:0.1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $validated['total_price'] = $validated['quantity'] * $validated['unit_price'];

        Transaction::create($validated);

        return response()->json(['message' => 'تمت إضافة العملية بنجاح']);
    }

    // Delete transaction
    public function destroy($id)
    {
        Transaction::find($id)->delete();
        return response()->json(['message' => 'تم حذف العملية']);
    }

    // Get daily summary
    public function dailySummary()
    {
        $summary = Transaction::select('date')
            ->selectRaw('SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) as total_purchase', ['شراء'])
            ->selectRaw('SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) as total_sales', ['بيع'])
            ->selectRaw('SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) - SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) as profit', ['بيع', 'شراء'])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return response()->json($summary);
    }

    // Get overall summary (total profit/loss across all transactions)
    public function overallSummary()
    {
        $totalPurchase = Transaction::where('type', 'شراء')->sum('total_price');
        $totalSales = Transaction::where('type', 'بيع')->sum('total_price');
        $totalProfit = $totalSales - $totalPurchase;

        return response()->json([
            'total_purchase' => round($totalPurchase, 2),
            'total_sales' => round($totalSales, 2),
            'total_profit' => round($totalProfit, 2),
            'status' => $totalProfit >= 0 ? 'profit' : 'loss'
        ]);
    }

    // Get summary by fruit type
    public function summaryByFruit()
    {
        $summary = DB::table('transactions')
            ->select('fruit')
            ->selectRaw('SUM(CASE WHEN type = ? THEN quantity ELSE 0 END) as quantity_bought', ['شراء'])
            ->selectRaw('SUM(CASE WHEN type = ? THEN quantity ELSE 0 END) as quantity_sold', ['بيع'])
            ->selectRaw('SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) as total_purchase_cost', ['شراء'])
            ->selectRaw('SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) as total_sales_revenue', ['بيع'])
            ->selectRaw('SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) - SUM(CASE WHEN type = ? THEN total_price ELSE 0 END) as profit', ['بيع', 'شراء'])
            ->groupBy('fruit')
            ->orderBy('profit', 'desc')
            ->get();

        return response()->json($summary);
    }

    // Update transaction
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:شراء,بيع',
            'fruit' => 'required|exists:fruits,name',
            'quantity' => 'required|numeric|min:0.1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $validated['total_price'] = $validated['quantity'] * $validated['unit_price'];

        Transaction::find($id)->update($validated);

        return response()->json(['message' => 'تم تحديث العملية']);
    }
}
