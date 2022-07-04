<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add foods') }}
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
                    {{-- form --}}
                    <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-between gap-3">
                            {{-- Name --}}
                            <div class="mt-4 w-full">
                                <x-label for="name" :value="__('Food Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
                                <div class="text-sm text-red-500"> {{ $errors->first('name') }} </div>
                            </div>

                            {{-- Price --}}
                            <div class="mt-4 w-full">
                                <x-label for="price" :value="__('Price ')" />
                                <x-input id="price" class="block mt-1 w-full" type="text" name="price"
                                    :value="old('price')" required autofocus />
                                <div class="text-sm text-red-500"> {{ $errors->first('price') }} </div>
                            </div>
                            {{-- Food Category --}}
                            <div class="mt-4 w-full">
                                <x-label for="foodCategory" :value="__('FoodCategory')" />
                                <select id="foodCategory" name="foodCategory"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a Type</option>
                                    @foreach ($foodCategories as $foodCategory)
                                        <option value="{{ $foodCategory->name }}">{{ $foodCategory->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('foodCategory') }} </div>
                            </div>

                        </div>
                        {{-- Ingredients --}}
                        <div class="mt-4 w-full">
                            <x-label for="ingredients" :value="__('Ingredients ')" />
                            <x-input id="ingredients" class="block mt-1 w-full" type="text" name="ingredients"
                                :value="old('ingredients')" required autofocus />
                            <div class="text-sm text-red-500"> {{ $errors->first('ingredients') }} </div>
                        </div>
                        {{-- Image --}}

                        <div class="my-4">
                            <x-label for="image" :value="__('Image')" />
                            <x-input id="image" class="block mt-1 w-full" type="file" name="image"
                                required autofocus />
                            <div class="text-sm text-red-500"> {{ $errors->first('image') }} </div>

                        </div>
                        {{-- Submin Form --}}
                        <div class="flex items-center justify-start mt-4">
                            <x-button>
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
