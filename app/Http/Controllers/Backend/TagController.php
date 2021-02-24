<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        return view('backend.tags.index', [
            'tags' => Tag::query()
                ->when(request('search'), function ($query) {
                    $query->search(request('search'));
                })->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('backend.tags.create');
    }

    public function store(TagRequest $request)
    {
        Tag::create($request->validated());

        return $this->redirectRotes('admin.tags.index', 'Added Tag Successfully');
    }

    public function edit(Tag $tag)
    {
        return view('backend.tags.update', compact('tag'));
    }

    public function update(Tag $tag, TagRequest $request)
    {
        $tag->update($request->validated());

        return $this->redirectRotes('admin.tags.index', 'Updated Tag Successfully');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return $this->redirectRotes('admin.tags.index', 'Deleted Tag Successfully');
    }
}
