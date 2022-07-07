<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  border-b border-gray-200">
                    {{-- @if (session('message'))
                        <div
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                            {{ session('message') }}
                        </div>
                    @endif --}}

                    @can('fullPermission')
                        <h2 class="px-6 font-bold text-xl">Users list</h2>
                        @include('admin.users.index')
                    @endcan

                    @can('sellerPermission')
                        <div class="flex justify-between gap-3" style="min-height: 450px">
                            @if (App\Models\Profile::getProfile())
                                @include('seller.index')
                            @endif
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
