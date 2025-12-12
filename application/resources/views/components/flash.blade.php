@props(['success' => session('success'), 'error' => session('error')])

@if ($success || $error)
    <div id="flash-message"
        class="fixed top-6 right-6 z-50 px-4 py-2 rounded shadow-lg text-white transition-opacity duration-500
            {{ $success ? 'bg-green-500' : '' }}
            {{ $error ? 'bg-red-500' : '' }}">
        {{ $success ?? $error }}
    </div>

    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-message');
            if (el) {
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 4000);
            }
        }, 4000);
    </script>
@endif
