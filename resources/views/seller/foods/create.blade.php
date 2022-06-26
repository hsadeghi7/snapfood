<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add foods') }}
        </h2>
    </x-slot>
{{ $errors }}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- form --}}
                    <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-between gap-3">
                            {{-- Name --}}
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Food
                                    Name</label>
                                <input type="text" name="name" 
                                    value="{{ request()->input('name', old('name')) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="text-sm text-red-500"> {{ $errors->first('name') }} </div>
                            </div>
                            {{-- Price --}}
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Food
                                    Price</label>
                                <input type="text" name="price"
                                    value="{{ request()->input('price', old('price')) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="text-sm text-red-500"> {{ $errors->first('price') }} </div>
                            </div>
                            {{-- Food Category --}}
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Food
                                    Category</label>
                                <select name="foodCategory"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  pr-24 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>Category</option>
                                    @foreach ($foodCategories as $foodCategory)
                                        <option value="{{ $foodCategory->name }}">{{ $foodCategory->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('foodCategory') }} </div>
                            </div>
                            {{-- Discount --}}
                            <div class="mb-6">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Discount</label>
                                <select name="coupon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-24  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="0">No Discount</option>
                                    @foreach ($coupons as $coupon)
                                        <option value="{{ $coupon->percentage }}">{{ $coupon->percentage }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('coupon') }} </div>

                                {{-- Food Party --}}
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Add to Food Party</label>
                                <div class="flex items-center mb-4">
                                    <input type="checkbox" name="foodParty"
                                        class="w-6 h-6 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </div>
                        </div>
                        {{-- Ingredients --}}
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Ingredients
                            </label>
                            <textarea type="text" name="ingredients" value="{{ request()->input('ingredients', old('ingredients')) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>
                        {{-- Image --}}
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-800">Upload file</label>
                            <input name="image" type="file"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="text-sm text-red-500"> {{ $errors->first('image') }} </div>
                        </div>

                        {{-- Submin Form --}}
                        <button type="submit"
                            class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
