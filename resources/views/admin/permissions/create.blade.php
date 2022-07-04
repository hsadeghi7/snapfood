<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Discount') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="flex gap-3">
                            {{-- Name --}}
                            <div class="mt-4 w-full">
                                <x-label for="name" :value="__('Role Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
                                <div class="text-sm text-red-500"> {{ $errors->first('name') }} </div>
                            </div>
                            {{-- Permissions --}}
                            <div class="mt-4 w-full">
                                <x-label for="foodCategory" :value="__('Permissions')" />
                               
                                    @foreach ($permissions as $permission)
                                    <div class="flex items-center mb-4">
                                        <input name="permission[]" multiple type="checkbox" value="{{ $permission->name }}" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                        <label for="disabled-checkbox" class="ml-2 text-sm font-medium text-gray-400 dark:text-gray-500">{{ $permission->name }}</label>
                                    </div>
                                    @endforeach
                                <div class="text-sm text-red-500"> {{ $errors->first('permission') }} </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
