<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                    @if (auth()->user()->role === 'superAdmin')
                        <h2 class="px-12 font-bold text-xl">Users list</h2>
                        @include('admin.users.index')
                    @endif
                    @if (auth()->user()->role === 'seller')
                        <h2 class="px-12 font-bold text-xl">You're Seller!</h2>
                        @include('seller.index')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
