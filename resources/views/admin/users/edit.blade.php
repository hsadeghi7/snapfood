<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Discount') }}
        </h2>
    </x-slot>

    <div class="py-12" style="min-height: 500px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- roles --}}
                        <div class="mt-4">
                            <x-label for="role" :value="__('Roles')" />
                            <div class="mt-4 w-1/3 ">
                                <select id="role" name="role"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 px-6 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>Choose a Role</option>
                                    @foreach ($roles as $role)
                                        @if ($role->name !== 'superAdmin')
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-sm text-red-500"> {{ $errors->first('role') }} </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 h-8 mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
