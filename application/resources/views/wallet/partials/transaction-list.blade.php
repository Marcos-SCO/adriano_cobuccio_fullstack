<div class="bg-white p-4 rounded shadow">
    <h3 class="font-semibold mb-3">Transactions</h3>

    @if ($transactions->isEmpty())
        <p class="text-gray-500">No transactions found.</p>
    @endif

    @if (!$transactions->isEmpty())
        <ul>
            @foreach ($transactions as $tx)
                <li class="flex justify-between py-2 border-b">
                    <div>
                        <div class="text-sm">{{ Str::ucfirst($tx->type->value) }} — ${{ number_format($tx->amount, 2) }}
                        </div>

                        @if ($tx->type !== \App\Enums\TransactionType::DEPOSIT)
                            <div class="text-xs text-gray-500">
                                <p>• From: {{ $tx->sender->name }} </p>
                                <p>• To: {{ $tx->receiver->name }}</p>
                            </div>
                        @endif

                        <div class="text-xs text-gray-500">• Message:
                            {{ $tx->notes ?? 'N/A' }}
                        </div>

                        <div class="text-xs text-gray-500">{{ $tx->created_at->diffForHumans() }} • Status:
                            {{ $tx->status }}
                        </div>

                    </div>

                    <div class="text-right">
                        @if ($tx->status->value === \App\Enums\TransactionStatus::COMPLETED->value)
                            <form method="POST" action="{{ route('wallet.reverse', $tx) }}">
                                @csrf
                                <button
                                    class="bg-red-500 text-white px-2 py-1 rounded text-sm cursor-pointer">Reverse</button>
                            </form>
                        @else
                            <span class="text-xs text-gray-500">{{ $tx->status }}</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>
