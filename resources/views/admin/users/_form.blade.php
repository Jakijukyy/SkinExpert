@php $u = $user ?? null; @endphp

@if($errors->any())
<div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-5">
    <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
</div>
@endif

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
    <input type="text" name="name" value="{{ old('name', $u?->name) }}"
        class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('name') border-red-300 @enderror">
</div>
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
    <input type="email" name="email" value="{{ old('email', $u?->email) }}"
        class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('email') border-red-300 @enderror">
</div>
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Password @if($u) <span class="text-gray-400 font-normal text-xs">(kosongkan jika tidak diubah)</span> @else <span class="text-red-500">*</span> @endif
    </label>
    <input type="password" name="password"
        class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('password') border-red-300 @enderror">
</div>
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
    <input type="password" name="password_confirmation"
        class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm">
</div>
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
    <select name="role" class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('role') border-red-300 @enderror">
        <option value="user" {{ old('role', $u?->role) === 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role', $u?->role) === 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
</div>
