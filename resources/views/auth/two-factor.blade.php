<x-guest-layout>
    <form method="POST" action="{{ route('two-factor.verify') }}">
        @csrf
        <label class="text-gray-800 dark:text-gray-200" for="code">Two-Factor Code</label>
        <input type="text" name="code" id="code" required>
        <button class="ms-2 text-sm text-gray-600 dark:text-gray-400" type="submit">Verfity</button>
    </form>
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)  {{-- Fix: Use $errors->all() --}}
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

</x-guest-layout>
