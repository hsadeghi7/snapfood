<x-app-layout>
    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-8" style="min-height: 500px">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-center">
                    <div
                        class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-3xl hover:bg-gray-100 ">
                        {{-- Orders --}}

                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Items
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($items as $item) --}}
                                    <tr>
                                        {{-- Orders --}}
                                        <td class="px-6 py-2 whitespace-no-wrap">
                                            <div class="ml-2">
                                                <div class="text-sm font-medium text-gray-900">
                                                    @foreach ($items->first()->cart->cartItems as $value)
                                                        -<span> {{ $value->menu->food->name }}</span><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        {{-- price --}}
                                        <td class="px-6 py-2 whitespace-no-wrap">
                                            <div class="ml-2">
                                                <div class="text-sm font-medium text-gray-900">
                                                    @foreach ($items->first()->cart->cartItems as $value)
                                                        <span>
                                                            {{ $value->menu->food->price * (100 - $value->menu->coupon)*0.01 }}$
                                                            {{-- {{ $value->cart }} --}}
                                                        </span><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                {{-- @endforeach --}}
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
