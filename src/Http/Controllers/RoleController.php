<?php

namespace PhpCollective\MenuMaker\Http\Controllers;

use Illuminate\Routing\Controller;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Storage\Role;
use PhpCollective\MenuMaker\Jobs\RemoveUserMenuCache;
use PhpCollective\MenuMaker\Http\Requests\MenuRoleRequest;
use PhpCollective\MenuMaker\Http\Requests\RoleRequest as Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withoutGlobalScopes()->paginate();
        return view('menu-maker::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu-maker::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Role::create($request->all());
        return redirect()
            ->route('menu-maker::roles.index')
            ->withMessage(__('menu-maker::alerts.created', ['name' => $request->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::withoutGlobalScopes()->findOrFail($id);
        return view('menu-maker::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::withoutGlobalScopes()->findOrFail($id);
        return view('menu-maker::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::withoutGlobalScopes()->findOrFail($id);
        $role->update($request->all());
        return redirect()
            ->to($request->redirects_to)
            ->withMessage(__('menu-maker::alerts.updated', ['name' => $request->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::withoutGlobalScopes()->findOrFail($id);
        $name = $role->name;
        $users = $role->users()->count();
        if ($users > 0) {
            return redirect()
                ->to(request('redirects_to'))
                ->withErrors(__($name . ' role has ' . $users . ' active user(s).'));
        }
        
        $role->delete();
        return redirect()
            ->to(request('redirects_to'))
            ->withMessage(__('menu-maker::alerts.deleted', ['name' => $name]));
    }

    public function menus()
    {
        $roles = Role::admin(false)->pluck('name', 'id');
        $sections = Menu::sections()->pluck('name', 'id');
        return view('menu-maker::roles.menus', compact('roles', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function assign(MenuRoleRequest $request)
    {
        $role = Role::findOrFail($request->role_id);
        $previous_ids = $role->menus()->descendantsOf($request->section_id)->pluck('id')->toArray();
        if(count($previous_ids) > 0)
        {
            $role->menus()->detach($previous_ids);
        }
        $role->menus()->attach($request->menu_ids);

        $role->users->each(function ($user) {
            RemoveUserMenuCache::dispatch($user);
        });

        return redirect()
            ->back()
            ->withMessage(__('menu-maker::alerts.updated', ['name' => $role->name]));
    }
}
