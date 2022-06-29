<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add item to
            <span class="text-red-600 font-bold">{{ $restaurant->name }}</span>
            Restaurant Menu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('message'))
                        <div
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                            {{ session('message') }}
                        </div>
                    @endif


                    {{-- Create new coupon --}}
                    {{-- form --}}
                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf
                        <div class="flex justify-between gap-3">
                            {{-- Name --}}
                            <div class="mt-4 w-full">
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
                                <div class="text-sm text-red-500"> {{ $errors->first('name') }} </div>
                            </div>

                            {{-- Food --}}
                            <div class="mt-4 w-full">
                                <x-label for="food" :value="__('Food')" />
                                <select id="food" name="food_id"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>Choose a Food</option>
                                    @foreach ($allFood as $food)
                                        <option value="{{ $food->id }}">{{ $food->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('food') }} </div>
                            </div>

                            {{-- Discount --}}
                            <div class="mt-4 w-full">
                                <x-label for="coupon" :value="__('Coupon')" />
                                <select id="coupon" name="coupon"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>Choose a Discount</option>
                                    <option value="">No Discount</option>
                                    @foreach ($coupons as $coupon)
                                        <option value="{{ $coupon->percentage }}">{{ $coupon->percentage }}%
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('coupon') }} </div>
                            </div>
                        </div>

                        <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                        <input type="hidden" value="{{ $restaurant->id }}" name="restaurant_id">
                        {{-- Submin Form --}}
                        <div class="flex items-center justify-start mt-4">
                            <x-button>
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>




                    {{-- restaurant list --}}
                    @if (empty($restaurant->foods->first()))
                        <div
                            class="p-4 my-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800">
                            No Menu Found
                        </div>
                    @else
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Food Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Food Category
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Food Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Food Discount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Food Party?
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Show
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Edit
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Delete
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($restaurant->foods as $food)
                                        <tr>
                                            {{-- name --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        {{ $food->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Type --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="text-sm font-medium  text-gray-900">
                                                    {{ $food->foodCategory }}
                                                </div>
                                            </td>


                                            {{-- Price --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="text-sm font-medium  text-gray-900">
                                                    {{ $food->price }}
                                                </div>
                                            </td>
                                            {{-- Discount --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="text-sm font-medium  text-gray-900">
                                                    {{ $food->coupon }}%
                                                </div>
                                            </td>
                                            {{-- Food Party Toggle --}}
                                            <form action="{{ route('food.statusToggle') }}" method="POST">
                                                @csrf
                                                <input name="id" type="text" value="{{ $food->id }}"
                                                    hidden>
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <button type="submit">
                                                        @if (!$food->foodParty)
                                                            <p class="text-green-600 font-bold">Active</p>
                                                        @else
                                                            <p class="text-red-600 font-bold">Deactive</p>
                                                        @endif
                                                    </button>
                                                </td>
                                            </form>
                                            {{-- show --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <a href="{{ route('foods.show', $food->id) }}"
                                                    class="text-sm font-bold  text-green-700  ">
                                                    <svg class="h-6 w-6 text-green-500" width="24" height="24"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                                        <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                                                    </svg>
                                                </a>
                                            </td>

                                            {{-- Edit --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <a href="{{ route('foods.edit', $food->id) }}"
                                                    class="text-sm font-bold  text-green-700  ">
                                                    <svg class="h-6 w-6 text-blue-500" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19"
                                                            y2="8" />
                                                    </svg>
                                                </a>
                                            </td>

                                            {{-- Delete --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <form action="{{ route('menus.destroy', $food) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{ $food->id }}" name="food_id">
                                                    <input type="hidden" value="{{ $restaurant->id }}" name="restaurant_id">
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
                            <div class="p-5">
                            </div>
                        </div>
                    @endif










                </div>
            </div>
        </div>
    </div>
</x-app-layout>
