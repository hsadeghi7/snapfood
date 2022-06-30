<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Restaurant') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Restaurant Store Form -->
                    <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-between gap-3">

                            <!-- Restaurant Name -->
                            <div class="mt-4 w-full">
                                <x-label for="name" :value="__('Restaurant Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
                                <div class="text-sm text-red-500"> {{ $errors->first('name') }} </div>
                            </div>

                            <!-- Restaurant Type -->
                            <div class="mt-4 w-full">
                                <x-label for="type" :value="__('Restaurant Type')" />
                                <select id="type" name="type"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a Type</option>
                                    @foreach ($restaurantCategories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-red-500"> {{ $errors->first('type') }} </div>
                            </div>

                            <!-- Phone -->
                            <div class="mt-4 w-full">
                                <x-label for="phone" :value="__('Phone')" />
                                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                    :value="old('phone')" required />
                                <div class="text-sm text-red-500"> {{ $errors->first('phone') }} </div>
                            </div>
                        </div>
                        <!-- Restaurant Address -->
                        <div class="my-4">
                            <x-label for="title" :value="__('Address')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required autofocus />
                            <div class="text-sm text-red-500"> {{ $errors->first('title') }} </div>

                        </div>

                        <!-- Restaurant Image -->
                        <div class="my-4">
                            <x-label for="image" :value="__('Image')" />
                            <x-input id="image" class="block mt-1 w-full" type="file" name="image"
                                :value="old('image')" required autofocus />
                            <div class="text-sm text-red-500"> {{ $errors->first('image') }} </div>

                        </div>

                        <!-- Restaurant Location -->
                        <div class="relative my-4" style="width:100%; height:380px" >
                            <x-label for="location" :value="__('Location')" />
                            <input type="hidden" value="" id="latitude" name="latitude">
                            <input type="hidden" value="" id="longitude" name="longitude">
                            <x-mapbox id="mapId" class="absolute" style="  height: 360px; width: 100%;" 
                            :navigationControls="true"
                            :draggable="true"
                            />
                            <div class="text-sm text-red-500"> {{ $errors->first('latitude') }} </div>
                        </div>

                        <!-- Add Restaurant  -->
                        <div class="flex items-center justify-start mt-4">
                            <x-button >
                                {{ __('Add') }}
                            </x-button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script>
    marker.on('dragend', function(e) {
        $('#longitude').val(e.target.getLngLat().lng);
        $('#latitude').val(e.target.getLngLat().lat);
    });
</script>
