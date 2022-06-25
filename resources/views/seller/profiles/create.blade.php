<x-app-layout>

    <x-guest-layout>
        <x-auth-card>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('profiles.store') }}">
                @csrf

                <!-- Restaurant Name -->
                <div>
                    <x-label for="name" :value="__('Restaurant Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus />
                </div>

                <!-- Restaurant Name -->
                <div class="mt-4">
                    <x-label for="address" :value="__('Restaurant Address')" />

                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                        required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="phone" :value="__('Phone')" />

                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                        required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="account_number" :value="__('Account Number')" />

                    <x-input id="account_number" class="block mt-1 w-full" type="text" name="account_number"
                        required />
                </div>

                <!-- Restaurant Type -->
                <div class="mt-4">
                    <x-label for="type" :value="__('Restaurant Type')" />

                    <select id="type" name="type"
                        class="mt-2 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected >Choose a Type</option>
                        @foreach ($restaurantCategories as $category )
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('set restaurant INFO') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
