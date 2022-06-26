<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Restaurant') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Restaurant Store Form -->
                    <form action="{{ route('restaurants.store') }}" method="POST">
                        @csrf
                        <div class="flex justify-between gap-3">

                            <!-- Restaurant Name -->
                            <div class="mt-4 w-full">
                                <x-label for="name" :value="__('Restaurant Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
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
                            </div>

                            <!-- Phone -->
                            <div class="mt-4 w-full">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                    :value="old('phone')" required />
                            </div>
                        </div>
                        <!-- Restaurant Address -->
                        <div class="my-4">
                            <x-label for="address" :value="__('Address')" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old('address')" required autofocus />
                        </div>
                        <!-- Restaurant Working Date and Hours -->
                        <div class="my-4">
                            <x-label for="working_hours" :value="__('Working Hours')" />
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                        <tr>
                                            <th class="px-4 py-2">Day</th>
                                            <th class="px-4 py-2">Open</th>
                                            <th class="px-4 py-2">Close</th>
                                            <th class="px-4 py-2">Deactiv?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($week as $day)
                                            <tr class="text-xs text-gray-800">
                                                <td class="px-4 py-1">{{ $day }}</td>
                                                <td class="px-4 py-1">
                                                    <x-input id="open_{{ $day }}" class="block mt-1 w-full"
                                                        type="time" name="open_{{ $day }}"
                                                        :value="old('open_' . $day)" />
                                                </td>
                                                <td class="px-4 py-1">
                                                    <x-input id="close_{{ $day }}" class="block mt-1 w-full"
                                                        type="time" name="close_{{ $day }}"
                                                        :value="old('close_' . $day)" />
                                                </td>
                                                <td class="px-4 py-1">
                                                    <x-input id="deactivate_{{ $day }}"
                                                        class="block mt-1 w-6 h-6 " type="checkbox"
                                                        name="deactivate_{{ $day }}" :value="old('deactivate_' . $day)" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add Restaurant  -->
                            <div class="flex items-center justify-start mt-4">
                                <x-button class="ml-4">
                                    {{ __('Add') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
