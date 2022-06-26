<x-app-layout>

    <x-guest-layout>
        <x-auth-card>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('profiles.store') }}">
                @csrf

               <!--  Address -->
                <div class="mt-4">
                    <x-label for="address" :value="__('Address')" />

                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                        required autofocus />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-label for="phone" :value="__('Phone')" />

                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                        required />
                </div>

                <!-- Account Number -->
                <div class="mt-4">
                    <x-label for="account_number" :value="__('Account Number')" />

                    <x-input id="account_number" class="block mt-1 w-full" type="text" name="account_number"
                        required />
                </div>


                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('set profile INFO') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
