<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Restaurant') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Restaurant Store Form -->
                    <form action="{{ route('restaurants.update', $restaurant) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex justify-between gap-3">

                            <!-- Restaurant Name -->
                            <div class="mt-4 w-full">
                                <x-label for="name" :value="__('Restaurant Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name') ?? $restaurant->name" required autofocus />
                                <div class="text-sm text-red-500"> {{ $errors->first('name') }} </div>
                            </div>

                            <!-- Restaurant Type -->
                            <div class="mt-4 w-full">
                                <x-label for="type" :value="__('Restaurant Type')" />
                                <select id="type" name="type"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a Type</option>
                                    @foreach ($restaurantCategories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('type') }} </div>
                            </div>

                            <!-- Phone -->
                            <div class="mt-4 w-full">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                    :value="old('phone') ?? $restaurant->phone" phone />
                                <div class="text-sm text-red-500"> {{ $errors->first('phone') }} </div>
                            </div>
                        </div>
                        <!-- Restaurant Address -->
                        <div class="my-4">
                            <x-label for="tittle" :value="__('Address')" />
                            <x-input id="tittle" class="block mt-1 w-full" type="text" name="tittle"
                                :value="old('tittle') ?? $restaurant->tittle" required autofocus />
                            <div class="text-sm text-red-500"> {{ $errors->first('tittle') }} </div>

                        </div>

                        <!-- Restaurant Image -->
                        <div class="my-4">
                            <x-label for="image" :value="__('Image')" />
                            <x-input id="image" class="block mt-1 w-full" type="file" name="image"
                                :value="old('image')" />
                            <div class="text-sm text-red-500"> {{ $errors->first('image') }} </div>
                        </div>

                        <!-- Add Restaurant  -->
                        <div class="flex items-center justify-start mt-4">
                            <x-button >
                                {{ __('Update') }}
                            </x-button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
