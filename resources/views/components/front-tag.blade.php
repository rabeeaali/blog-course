 <div class="-mx-8 w-4/12 hidden lg:block">
    <div class="mt-10 px-8">
        <h1 class="mb-4 text-xl font-bold text-gray-700">Tags</h1>
        <div class="flex flex-col bg-white px-4 py-6 max-w-sm mx-auto rounded-lg shadow-md">
            <ul>
                @foreach ($tags as $tag)
                    <li class="pb-3">
                        <a href="tag.html"
                            class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">-
                            {{ $tag->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>