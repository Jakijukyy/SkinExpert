<form method="POST" action="{{ route('profile.password.update') }}" class="space-y-4">
    @csrf
    @method('PUT')

    {{-- Current password --}}
    <div>
        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1.5">Password Saat Ini</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                </svg>
            </div>
            <input
                id="current_password" type="password" name="current_password"
                autocomplete="current-password"
                placeholder="••••••••"
                class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition {{ $errors->updatePassword->get('current_password') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
            >
        </div>
        @foreach($errors->updatePassword->get('current_password') as $msg)
            <p class="mt-1.5 text-xs text-red-600">{{ $msg }}</p>
        @endforeach
    </div>

    {{-- New password --}}
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <input
                id="password" type="password" name="password"
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
                class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition {{ $errors->updatePassword->get('password') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
            >
        </div>
        @foreach($errors->updatePassword->get('password') as $msg)
            <p class="mt-1.5 text-xs text-red-600">{{ $msg }}</p>
        @endforeach
    </div>

    {{-- Confirm password --}}
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <input
                id="password_confirmation" type="password" name="password_confirmation"
                autocomplete="new-password"
                placeholder="Ketik ulang password baru"
                class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition border-gray-200"
            >
        </div>
    </div>

    <div class="pt-1">
        <button type="submit"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Perbarui Password
        </button>
    </div>
</form>
