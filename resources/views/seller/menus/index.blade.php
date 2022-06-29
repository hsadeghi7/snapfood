<x-app-layout>
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
                    {{-- restaurant list --}}
                    @if (empty($restaurants->first()))
                        <div
                            class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800">
                            No Restaurant Found
                        </div>
                    @else
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Restaurant Name
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            Show Menu
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($restaurants as $restaurant)
                                        <tr>
                                            {{-- Restaurant Name --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        {{ $restaurant->name }}
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- show  Menu --}}
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="flex items-center mb-3 gap-1">
                                                    <p class="text-green-500 font-bold ">
                                                        <a href="{{ route('menus.show', $restaurant) }}">
                                                            Show Restuarant Menu</a>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-5">
                                {{-- {{ $restaurants->links() }} --}}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
