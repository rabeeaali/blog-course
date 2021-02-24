<x-app-admin-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center">
            <h3 class="text-gray-700 text-3xl font-medium">Create A New User</h3>
            <a href="{{ route('admin.posts.index') }}">
                <svg class="w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </a>
        </div>

        <div class="mt-8">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" id="title"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('title')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="password" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="desc"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                rows="4">{{ old('desc') }}</textarea>
                            @error('desc')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <x-tag />

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">
                                Post Image
                            </label>
                            <div class="mt-2 flex items-center" x-data="imageData()">
                                <div>
                                    <span class="inline-block h-32 w-32 object-contain overflow-hidden bg-gray-100"
                                        x-show="previewUrl == ''" x-cloak>
                                        <svg class="h-full w-full text-gray-300" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>

                                    <div class="h-full w-full  text-gray-300" x-show="previewUrl != ''" x-cloak>
                                        <img class="inline-block h-32 w-32 object-contain rounded" :src="previewUrl">
                                    </div>
                                </div>

                                <input type="file" name="image" id="thumbnail" class="hidden" @change="updatePreview()">
                                <label for="thumbnail"
                                    class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Change
                                </label>
                            </div>
                            @error('image')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function imageData() {
            return {
                previewUrl: "",
                updatePreview() {
                    var reader,
                        files = document.getElementById("thumbnail").files;
    
                    reader = new FileReader();
    
                    reader.onload = e => {
                        this.previewUrl = e.target.result;
                    };
    
                    reader.readAsDataURL(files[0]);
                },
            };
        }
    </script>
</x-app-admin-layout>