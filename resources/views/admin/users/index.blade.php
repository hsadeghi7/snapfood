        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="min-height: 450px">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                                            Permissions
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Edit Role
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
                                                {{-- User name --}}
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <div class="flex items-center">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="text-sm font-medium  text-gray-900">
                                                            {{ $user->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- Role --}}
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @foreach ($user->roles as $role)
                                                            <p> {{ $role->name }}</p>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                {{-- Permissions --}}
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @foreach ($user->roles as $role)
                                                            @foreach ($role->permissions as $permission)
                                                                <p> {{ $permission->name }}</p>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </td>
                                                {{-- Edit Permissions --}}
                                                <td class="px-6 py-2 whitespace-no-wrap">
                                                    <a href="{{ route('users.edit', $user) }}"
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
                                                {{-- Active Status --}}
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
