<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Discount') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('coupon.update', $coupon) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex gap-3">
                            <div class="mb-6">
                                <input type="text" name="name"  value="{{ $coupon->name }}" hidden >
                            </div>
                            <div class="mb-6">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Percentage
                                </label>
                                <input type="text" name="percentage"
                                    value="{{ request()->input('percentage', old('percentage')) ?? $coupon->percentage }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="text-sm text-red-500"> {{ $errors->first('percentage') }} </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
