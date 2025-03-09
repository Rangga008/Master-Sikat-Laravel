<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Bagian untuk mengedit informasi rekening bank -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Informasi Rekening Bank</h3>
                <form action="{{ route('profile.update-bank-details') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="bank_account_number" class="block mb-2">Nomor Rekening</label>
                            <input type="text" name="bank_account_number" id="bank_account_number" 
                                   value="{{ auth()->user()->bank_account_number }}" 
                                   class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label for="bank_account_name" class="block mb-2">Nama Pemilik Rekening</label>
                            <input type="text" name="bank_account_name" id="bank_account_name" 
                                   value="{{ auth()->user()->bank_account_name }}" 
                                   class="w-full border rounded p-2" required>
                        </div>
                    </div>

                    <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        Simpan Informasi Rekening
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>