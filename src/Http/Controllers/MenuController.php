<?php

namespace PhpCollective\MenuMaker\Http\Controllers;

use Illuminate\Routing\Controller;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Storage\Role;
use PhpCollective\MenuMaker\Http\Requests\MenuRequest as Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::with('ancestors')
            ->where('parent_id', '>', 0)
            ->paginate();
        return view('menu-maker::menus.index', compact('menus'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter()
    {
        $menus = Menu::filter()->pluck('name', 'id');
        $parent = request('p_id', '0');
        $parentCount = request('pCount', '0');
        return view('menu-maker::menus.menus', compact(
            'menus', 'parent', 'parentCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Menu::sections()->pluck('name', 'id');

        if(! $sections->count())
        {
            return redirect()
                ->route('menu-maker::sections.index')
                ->withErrors([__('menu-maker::alerts.no-section-exists')]);
        }
        $privileges = collect(Menu::$privileges);
        return view('menu-maker::menus.create', compact('sections', 'privileges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name', 'alias', 'link', 'icon', 'class', 'attr', 'privilege', 'visible'
        ]);
        $data['routes'] = $request->route_list;
        $data['parent_id'] = Menu::findParent();
        Menu::create($data);
        return redirect()
            ->route('menu-maker::menus.index')
            ->withMessage(__('menu-maker::alerts.created', ['name' => $request->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $menu->load('ancestors');
        return view('menu-maker::menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $sections = Menu::sections()->pluck('name', 'id');
        $privileges = collect(Menu::$privileges);
        $parent_ids = $menu->ancestors()->pluck('id')->toArray();
        return view('menu-maker::menus.edit', compact(
            'menu', 'sections', 'privileges', 'parent_ids'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->only([
            'name', 'alias', 'link', 'icon', 'class', 'attr', 'privilege', 'visible'
        ]);
        $data['routes'] = $request->route_list;
        $data['parent_id'] = Menu::findParent();

        $menu->update($data);
        return redirect()
            ->to($request->redirects_to)
            ->withMessage(__('menu-maker::alerts.updated', ['name' => $request->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $name = $menu->name;

        $childs = $menu->descendants()->count();
        if($childs > 0)
        {
            return redirect()
                ->back()
                ->withErrors([__('menu-maker::alerts.menu-child-exists', ['name' => $name, 'count' => $childs])]);
        }
        $menu->delete();
        return redirect()
            ->to(request('redirects_to'))
            ->withMessage(__('menu-maker::alerts.deleted', ['name' => $name]));
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $node
     * @return \Illuminate\Http\Response
     */
    public function tree(Menu $node)
    {
        $tree = Menu::descendantsOf($node)->toTree($node);
        $selected = [];
        if(request()->has('g') && request('g') > 0)
        {
            $selected = Role::findOrFail(request('g'))->menus()->descendantsOf($node)->pluck('id')->toArray();
        }
        return view('menu-maker::menus.tree', compact('tree', 'selected'));
    }

    public function selected() {

        if (request()->ajax()) {
            $group_id = request('g');
            $parent_id = request('p');
            $selected = Role::findOrFail($group_id)->menus()->descendantsOf($parent_id)->pluck('id')->toArray();
            return response()->json(compact('selected'), 200);
        }
        return response()->json([
            'responseText' => 'Not a ajax request'
        ], 400);

    }
}
