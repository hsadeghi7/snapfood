<x-app-layout>
    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-center">
                    <div
                        class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-3xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        {{-- Restaurant image --}}
                        <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="{{ asset('storage/' . $restaurant->image) }}" alt="">

                        {{-- Restaurant Descreptions --}}
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Restaurant
                                Name: {{ $restaurant->name }}</h5>
                            <p class="text-gray-700 dark:text-gray-400">Restaurant Type: {{ $restaurant->type }}</p>
                            @if ($restaurant->is_active == 1)
                                <svg class="h-8 w-8 text-green-700" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                            @elseif ($restaurant->is_active == 0)
                                <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            @endif

                            {{-- Status Toggle --}}


                            </p>
                            {{-- Time Table --}}
                            <h5 class="mb-2 mt-6 text-m font-bold tracking-tight text-gray-100 dark:text-white">
                                Restaurant Time Table</h5>

                            <table class="text-white text-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Day
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Open Time
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Close Time
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Delete
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($restaurant->workingHours as $workingHour)
                                        <tr>
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium  text-gray-100">
                                                        {{ $workingHour->day }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="text-sm font-medium  text-gray-100">
                                                    {{ $workingHour->open_time }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="text-sm font-medium  text-gray-100">
                                                    {{ $workingHour->close_time }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-1 whitespace-no-wrap">
                                                <form action="{{ route('workingHours.destroy', $workingHour) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm font-bold  text-red-700">
                                                        <svg class="h-6 w-6 text-red-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Time Table for Restaurant --}}
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-green-700 font-bold text-m "> Add Time Table </p>

                    <!-- Restaurant Time Table Store Form -->
                    <form action="{{ route('workingHours.store') }}" method="POST">
                        @csrf
                        <div class="flex justify-between gap-3">

                            <!-- Restaurant Day -->
                            <div class="mt-4 w-full">
                                <x-label for="day" :value="__('Week Day')" />
                                <select id="day" name="day"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>Choose a Day</option>
                                    @foreach ($week as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('day') }} </div>
                            </div>

                            <!-- Open Time -->
                            <div class="mt-4 w-full">
                                <x-label for="open_time" :value="__('Open_time')" />
                                <x-input id="open_time" class="block mt-1 w-full" type="time" name="open_time"
                                    :value="old('open_time')" required />
                                <div class="text-sm text-red-500"> {{ $errors->first('open_time') }} </div>
                            </div>
                            <!-- Close Time -->
                            <div class="mt-4 w-full">
                                <x-label for="close_time" :value="__('Close_time')" />
                                <x-input id="close_time" class="block mt-1 w-full" type="time" name="close_time"
                                    :value="old('close_time')" required />
                                <div class="text-sm text-red-500"> {{ $errors->first('close_time') }} </div>
                            </div>
                        </div>
                        {{-- restaurant Id --}}
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
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
