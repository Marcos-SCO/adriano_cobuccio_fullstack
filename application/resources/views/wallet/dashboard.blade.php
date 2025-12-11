@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="col-span-1 bg-white p-4 rounded shadow">
            
            <h2 class="text-lg font-semibold">Account</h2>

            <p class="mt-2">Hello, {{ $user->name }}</p>
            <p class="mt-2">Balance: <strong>${{ number_format($user->balance, 2) }}</strong></p>


            <form action="{{ route('wallet.deposit') }}" method="POST" class="mt-4" hx-post="{{ route('wallet.deposit') }}"
                hx-target="#transaction-list" hx-swap="innerHTML">

                @csrf
                <label class="block">Deposit amount
                    <input type="number" step="0.01" name="amount" required class="w-full border p-2 rounded mt-1" />
                </label>
                <label class="block mt-2">Notes
                    <input type="text" name="notes" class="w-full border p-2 rounded mt-1" />
                </label>

                <button class="bg-green-500 text-white px-4 py-2 rounded mt-3">Deposit</button>
            </form>
        </div>


        <div class="col-span-2 bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Transfer</h2>

            <form action="{{ route('wallet.transfer') }}" method="POST" hx-post="{{ route('wallet.transfer') }}"
                hx-target="#transaction-list" hx-swap="innerHTML">
                @csrf

                <label class="block">Receiver
                    <select name="receiver_id" required class="w-full border p-2 rounded mt-1">
                        <option value="">Select a user</option>
                        @foreach (App\Models\User::where('id', '!=', auth()->id())->get() as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </label>

                <label class="block mt-2">Amount
                    <input type="number" step="0.01" name="amount" required class="w-full border p-2 rounded mt-1" />
                </label>

                <label class="block mt-2">Notes
                    <input type="text" name="notes" class="w-full border p-2 rounded mt-1" />
                </label>

                <button class="bg-blue-500 text-white px-4 py-2 rounded mt-3">Transfer</button>
            </form>

            <div id="transaction-list" class="mt-6">
                @include('wallet.partials.transaction-list', ['transactions' => $transactions])
            </div>
            
        </div>
    </div>
@endsection
