<div x-data="{ open: false }">
    <p class="text-sm text-gray-600 mb-4 leading-relaxed">
        Setelah akun dihapus, semua data konsultasi dan informasi Anda akan dihapus secara permanen.
        Tindakan ini <strong>tidak dapat dibatalkan</strong>.
    </p>

    <button
        type="button"
        @click="open = true"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition shadow-sm"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        Hapus Akun Saya
    </button>

    {{-- Confirmation modal --}}
    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
        style="display: none;"
    >
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            @click.outside="open = false"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6"
        >
            <div class="flex items-start gap-4 mb-5">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.07 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Hapus Akun?</h3>
                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                        Masukkan password Anda untuk mengkonfirmasi penghapusan akun secara permanen.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('DELETE')

                <div>
                    <label for="del_password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input
                            id="del_password" type="password" name="password"
                            placeholder="Masukkan password Anda"
                            class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition {{ $errors->userDeletion->get('password') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
                        >
                    </div>
                    @foreach($errors->userDeletion->get('password') as $msg)
                        <p class="mt-1.5 text-xs text-red-600">{{ $msg }}</p>
                    @endforeach
                </div>

                <div class="flex gap-3 pt-1">
                    <button
                        type="submit"
                        class="flex-1 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition"
                    >
                        Ya, Hapus Akun
                    </button>
                    <button
                        type="button"
                        @click="open = false"
                        class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Auto-open modal if there are deletion errors --}}
@if($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.dispatchEvent(new CustomEvent('open-delete-modal'));
    });
</script>
@endif
