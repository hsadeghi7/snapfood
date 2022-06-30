        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('message'))
                        <div
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                            {{ session('message') }}
                        </div>
                    @endif

                    {{-- User list --}}
                    @if (count($users) < 2)
                        <div
                            class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800">
                            No User Found
                        </div>
                    @else
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Role
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Permission
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        @if ($user->role !== 'superAdmin')
                                            <tr>
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <div class="flex items-center">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="text-sm font-medium  text-gray-900">
                                                            {{ $user->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $user->role }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <div class="text-sm font-medium text-gray-900">

                                                        @if ($user->role == 'seller')
                                                            @if ($user->is_admin)
                                                                <a href="{{ route('users.edit', $user) }}"
                                                                    class="font-bold text-blue-600 dark:text-blue-500 hover:underline">Admin</a>
                                                            @else
                                                                <a href="{{ route('users.edit', $user) }}"
                                                                    class="font-bold text-red-500 dark:text-red-500 hover:underline">Not
                                                                    Admin</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                                <form action="{{ route('users.activityToggle', $user) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input name="id" type="text" value="{{ $user->id }}"
                                                        hidden>
                                                    <td class="px-6 py-4 whitespace-no-wrap">
                                                        <button type="submit">
                                                            @if ($user->deleted_at)
                                                                <p class="text-red-600 font-bold">Deactive</p>
                                                            @else
                                                                <p class="text-green-600 font-bold">Active</p>
                                                            @endif
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-5">
                                {{ $users->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
