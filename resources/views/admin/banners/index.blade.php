<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Create new Banner --}}
                    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="shadow-md sm:rounded-lg mb-3 p-2">
                            <p class="text-md font-bold text-blue-700"> Upload banner</p>
                            <div class="flex gap-3 items-center mb-3">
                                <div>
                                    <input type="file" class="block mt-1 w-1/8" type="file" name="image">
                                    <div class="text-sm text-red-500"> {{ $errors->first('image') }} </div>
                                </div>
                                <x-button>
                                    {{ __('upload') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                    {{-- Banners List --}}
                    @if (empty($banners->first()))
                        <div
                            class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800">
                            No Banner Found
                        </div>
                    @else
                        <hr>
                        <div class="flex gap-3">
                            @foreach ($banners as $banner)
                                <div class="shadow-md sm:rounded-lg w-1/3">
                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="w-1/2">
                                    <div class="flex gap-1 justify-start items-center mb-3 mt-2 w-1/2">
                                        {{-- Delete Banner --}}
                                        <form action="{{ route('banners.destroy', $banner) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-button>
                                                {{ __('delete') }}
                                            </x-button>
                                        </form>

                                        {{-- Set Banner --}}
                                        <form action="{{ route('banners.update', $banner) }}"method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-button>

                                                {{ __('Set Banner') }}
                                            </x-button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-5">
                            {{ $banners->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
