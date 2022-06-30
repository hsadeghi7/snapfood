<x-app-layout>

    <x-guest-layout>
        <x-auth-card>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('profiles.update', $profile) }}">
                @csrf
                @method('PUT')
                <!-- Restaurant Address -->
                <div class="mt-4">
                    <x-label for="title" :value="__('Address')" />

                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ?? $profile->addresses->first()->title"
                        required autofocus />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-label for="phone" :value="__('Phone')" />

                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone') ?? $profile->phone"
                        required />
                </div>

                <!-- Account Number -->
                <div class="mt-4">
                    <x-label for="account_number" :value="__('Account Number')" />

                    <x-input id="account_number" class="block mt-1 w-full" type="text" name="account_number"
                        :value="old('account_number') ?? $profile->account_number" required />
                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('update profile INFO') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
