<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 ">
                    <form action="{{ route('reports.showData') }}" method="POST" class="flex gap-3">
                        @csrf
                        <div>
                            <select name="time_period"
                                class="h-8 py-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/4  dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option disabled selected>Select Time Period</option>
                                <option value="0">Today</option>
                                <option value="1">Yesterday</option>
                                <option value="7">Last 7 Days</option>
                                <option value="30">Last 30 Days</option>
                                <option value="180">Last 180 Days</option>
                                <option value="365">Last 365 Days</option>
                            </select>
                            <div class="text-xs text-red-500"> {{ $errors->first('time_period') }} </div>
                        </div>

                        <div>
                            <select name="restaurant_id"
                                class="h-8 py-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/4  dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option disabled selected>Select Restaurant</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-xs text-red-500"> {{ $errors->first('restaurant_id') }} </div>
                        </div>

                        <x-button class="h-8">
                            {{ __('Get Data') }}
                        </x-button>
                    </form>
                </div>
                {{-- Reports --}}
                @isset($orders)
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Foods
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th
                                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Total Price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            {{ $order->cart->user->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            @foreach ($order->cart->cartItems as $cartItem)
                                                                <p>-{{ $cartItem->menu->food->name }}</p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            @foreach ($order->cart->cartItems as $cartItem)
                                                                <p>{{ $cartItem->quantity }}</p>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                                            @foreach ($order->cart->cartItems as $cartItem)
                                                                <p>{{ $cartItem->item_price }}</p>
                                                                @php
                                                                    $totalPrice += $cartItem->item_price;
                                                                @endphp
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="px-6 py-3 border-b text-xs  uppercase font-bold tracking-wider">
                                            SuM
                                        </th>
                                        <th class="py-3 border-b ">
                                        </th>
                                        <th class="py-3 border-b ">
                                        </th>
                                        <th class="px-6 py-3 border-b text-xs font-bold">
                                            {{ $totalPrice }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>
