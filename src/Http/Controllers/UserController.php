<?php

namespace PhpCollective\MenuMaker\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpCollective\MenuMaker\Storage\Role;
use PhpCollective\MenuMaker\Jobs\RemoveUserMenuCache;

class UserController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = resolve('userModel');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->model->paginate();
        return view('menu-maker::users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $user
     * @return \Illuminate\View\View
     */
    public function edit($user)
    {
        $roles = Role::pluck('name', 'id');
        $selected = $user->roles()->pluck('id')->toArray();
        return view('menu-maker::users.edit', compact('user', 'roles', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($user, Request $request)
    {
        $user->roles()->sync($request->role_id);

        RemoveUserMenuCache::dispatch($user);

        return redirect()
            ->to($request->redirects_to)
            ->withMessage(__('menu-maker::alerts.updated', ['name' => $user->name]));
    }
}
