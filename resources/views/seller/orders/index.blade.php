<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="min-height: 500px">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Restauarant List --}}
                    <form action="{{ route('orders.index') }}" method="GET">
                        <th scope="col" class="px-6 py-3">
                            <div class="flex gap-3">
                                <select name="restaurant_id"
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-2 rounded-md">
                                    <option selected disabled>Select Restaurant</option>
                                    @foreach ($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class=" text-blue-900 font-bold"> Get order list-></button>
                            </div>
                        </th>
                    </form>

                    {{-- Order list --}}
                    @empty(!$orders)
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Items
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Items price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Discount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Sum price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total payment
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            {{-- Order Items --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @foreach ($order->cart->cartItems as $item)
                                                            -<span> {{ $item->menu->food->name }}</span><br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Quantity --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        @foreach ($order->cart->cartItems as $item)
                                                            <span> {{ $item->quantity }}</span><br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Items Price --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        @foreach ($order->cart->cartItems as $item)
                                                            <span>
                                                                {{ $item->menu->food->price }}</span>$<br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Items Discount --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        @foreach ($order->cart->cartItems as $item)
                                                            <span>
                                                                {{ $item->menu->coupon }}</span>%<br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Sum Price --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        @foreach ($order->cart->cartItems as $item)
                                                            <span>
                                                                {{ $item->menu->food->price * (100 - $item->menu->coupon) * 0.01 * $item->quantity }}</span>$<br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- total Payments --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        {{ $order->cart->totalPayment($order->cart) / count($orders) }}$
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Status --}}
                                            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <div class="ml-2">
                                                        <div class="text-sm font-medium  text-gray-900">
                                                            <button type="submit"
                                                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-1 text-center">
                                                                {{ $order->status }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </form>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-5">
                                {{-- {{ $foods->links() }} --}}
                            </div>
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
