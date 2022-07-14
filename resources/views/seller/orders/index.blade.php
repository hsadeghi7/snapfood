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
                                    <option selected value="all">Select Restaurant</option>
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
                                            Total payment
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Order details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            {{-- Order --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @foreach ($order->cart->cartItems as $item)
                                                            <span> {{ $item->menu->food->name }}</span>-
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- Items --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        {{ $order->cart->totalPayment($order->cart) }}
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
                                            {{-- Order details --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <a href="{{ route('orders.show', $order->id) }}"
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
