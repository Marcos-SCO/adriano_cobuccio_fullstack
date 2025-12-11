<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WalletController extends Controller
{
    protected WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->middleware('auth');
        $this->walletService = $walletService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return view('wallet.dashboard', compact('user', 'transactions'));
    }

    public function deposit(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:0.01']);

        $transaction = $this->walletService->deposit($request->user(), (float)$request->amount, $request->notes ?? null);


        if ($request->header('HX-Request')) {

            $transactions = Transaction::where('receiver_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();

            return view('wallet.partials.transaction-list', compact('transactions'));
        }

        return redirect()->back()->with('success', 'Deposit completed');
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id|not_in:' . $request->user()->id,
            'amount' => 'required|numeric|min:0.01',
        ]);


        $receiver = User::findOrFail($request->receiver_id);

        try {
            $transaction = $this->walletService->transfer($request->user(), $receiver, (float)$request->amount, $request->notes ?? null);
        } catch (\Exception $e) {
            return back()->withErrors(['amount' => $e->getMessage()])->withInput();
        }

        if ($request->header('HX-Request')) {
            $transactions = Transaction::where('sender_id', $request->user()->id)
                ->orWhere('receiver_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();

            return view('wallet.partials.transaction-list', compact('transactions'));
        }

        return redirect()->back()->with('success', 'Transfer completed');
    }

    // reverse transaction endpoint (admin or owner)
    public function reverse(Request $request, Transaction $transaction)
    {
        // simple authorization: only involved user or admin can reverse
        $user = $request->user();
        if ($transaction->sender_id !== $user->id && $transaction->receiver_id !== $user->id && !$user->is_admin) {
            abort(403);
        }

        try {
            $reversal = $this->walletService->reverseTransaction($transaction, $request->reason ?? null);
        } catch (\Exception $e) {
            return back()->withErrors(['reverse' => $e->getMessage()]);
        }

        return back()->with('success', 'Transaction reversed');
    }
}
