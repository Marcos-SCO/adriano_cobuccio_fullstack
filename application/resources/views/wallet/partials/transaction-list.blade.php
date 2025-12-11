<div class="bg-white p-4 rounded shadow">
    <h3 class="font-semibold mb-3">Transactions</h3>

    <ul>
        @foreach ($transactions as $tx)
            <li class="flex justify-between py-2 border-b">
                <div>
                    <div class="text-sm">{{ ucfirst($tx->type) }} — ${{ number_format($tx->amount, 2) }}</div>
                    <div class="text-xs text-gray-500">{{ $tx->created_at->diffForHumans() }} • Status:
                        {{ $tx->status }}</div>
                </div>
                
                <div class="text-right">
                    @if ($tx->status === 'completed')
                        <form method="POST" action="{{ route('wallet.reverse', $tx) }}">
                            @csrf
                            <button class="bg-red-500 text-white px-2 py-1 rounded text-sm">Reverse</button>
                        </form>
                    @else
                        <span class="text-xs text-gray-500">{{ $tx->status }}</span>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>

</div>
