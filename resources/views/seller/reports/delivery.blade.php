<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set Delivery Fee for ') }}
            <span class="text-red-500 font-bold"> {{ $restaurant->name }} </span>
             Restaurant</h2>
        </h2>
    </x-slot>

    <div class="py-12" style="min-height: 500px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6" >

                    <form action="{{ route('restaurants.setDeliveryFee', $restaurant) }}" method="POST">
                        @csrf
                        <div class="flex gap-3">
                            <div class="mb-6">
                                <label class="block mb-2 text-sm text-gray-900 dark:text-gray-800 font-bold">Delivery Fee
                                </label>
                                <input type="text" name="deliveryFee"
                                    value="{{ request()->input('deliveryFee', old('deliveryFee')) }}"
                                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="text-sm text-red-500"> {{ $errors->first() }} </div>
                            </div>
                            <button type="submit" style="height: 53%;"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
