<x-app-layout title="Home Page">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
            <h1 class="font-bold text-gray-700 md:text-3xl">Posts</h1>

            @foreach ($posts as $post)
                <div class="mt-6">
                    <div class="max-w-4xl  bg-white rounded-lg shadow-md">
                        <a href="{{ route('frontend.post.show',$post->id) }}">
                            <img src="{{ $post->image_path }}"
                                alt="" class="w-100">
                        </a>
                        <div class="px-10 py-6">
                            <div>
                                <a href="{{ route('frontend.post.show',$post->id) }}" class="text-2xl text-gray-700 font-bold hover:underline">{{ $post->title }}</a>
                                <p class="mt-2 text-gray-600">{{ Str::limit($post->desc, 200, '...') }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('frontend.post.show',$post->id) }}" class="text-blue-500 hover:underline">Read more</a>
                                <div>
                                    <a href="{{ route('frontend.post.show',$post->id) }}" class="flex items-center"><img
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
                </div>
            @endforeach

          <div class="pt-5">
            {{ $posts->links() }}
          </div>

        </div>

        <x-front-tag />

    </div>
</x-app-layout>