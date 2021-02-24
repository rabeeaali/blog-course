<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.index', [
            'users' => User::query()
                ->when(request('search'), function ($query) {
                    $query->search(request('search'));
                })->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return $this->redirectRotes('admin.users.index', 'Added User Successfully');
    }

    public function edit(User $user)
    {
        return view('backend.users.update', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->validated());

        return $this->redirectRotes('admin.users.index', 'Updated User Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $this->redirectRotes('admin.users.index', 'Deleted User Successfully');
    }
}
