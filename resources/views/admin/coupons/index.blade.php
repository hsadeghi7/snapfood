<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Create new coupon --}}
                    <a href="{{ route('coupons.create') }}">
                        <div class="flex items-center mb-3 gap-1">
                            <p class="text-green-500 font-bold ">
                                Add Discount
                            </p>
                        </div>
                    </a>

                    {{-- Coupon list --}}
                    @if (empty($coupons->first()))
                        <div
                            class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800">
                            No Coupons Found
                        </div>
                    @else
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Coupon Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Discount percentage
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Edit
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Delete
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="flex items-center">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium  text-gray-900">
                                                        {{ $coupon->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <div class="text-sm font-medium  text-gray-900">
                                                    {{ $coupon->percentage }}%
                                                </div>
                                            </td>
                                            <td class="px-6 py-2 whitespace-no-wrap">
                                                <a href="{{ route('coupons.edit', $coupon->id) }}"
                                                    class="text-sm font-bold  text-green-700  ">
                                                    <svg class="h-5 w-5 text-blue-500" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19"
                                                            y2="8" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <form action="{{ route('coupons.destroy', $coupon->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm font-bold  text-red-700">
                                                        <svg class="h-5 w-5 text-red-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-5">
                                {{ $coupons->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
