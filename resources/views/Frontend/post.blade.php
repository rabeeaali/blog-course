<x-app-layout title="post">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
            <div class="mt-6">
                <div class="max-w-4xl px-10 py-6 bg-white rounded-lg shadow-md">
                    <div class="pb-3">
                        <h1 class="text-3xl">{{ $post->title }}</h1>
                        <p class="font-light text-gray-600 py-3">{{ $post->created_at->diffForHumans() }}</p>
                        <img src="{{ $post->image_path }}" class="w-100">

                        <p class="mt-2 text-gray-600 pt-2">
                            {{$post->desc }}
                        </p>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <a href="#"
                            class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500">{{ $post->tag->name }}</a>
                        <a href="#" class="flex items-center"><img
                                src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80"
                                alt="avatar" class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block">
                            <h1 class="text-gray-700 font-bold hover:underline">
                                @if ($post->user_id)
                                    {{ $post->user->name }}
                                @else
                                    Admin
                                @endif
                            </h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
       <x-front-tag />
    </div>
</x-app-layout>