@props(['tagId' => false ])

<div class="col-span-6">
    <label for="role" class="block text-sm font-medium text-gray-700">Tags</label>
    <select id="role" name="tag_id" autocomplete="role"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Choose One..</option>
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" {{ $tagId == $tag->id ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
    @error('tag_id')
    <p class="mt-1 text-sm text-red-600">
        {{ $message }}
    </p>
    @enderror
</div>