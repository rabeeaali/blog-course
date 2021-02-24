<?php

namespace App\Services;

use Illuminate\Support\Str;

class PostService
{
    public function create($request, $post, $method, $message)
    {
        $data = $request->validated();

        if ($image = $request->file('image')) {

            $post->deleteOldImage(); // true or false

            $data['image'] = Str::after($image->store('post_images'), '/'); 
        }

        $post->$method($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('message', "{$message} Post Successfully");
    }
}
