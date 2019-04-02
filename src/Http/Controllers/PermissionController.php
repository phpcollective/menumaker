<?php

namespace PhpCollective\MenuMaker\Http\Controllers;

use Illuminate\Routing\Controller;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Storage\Permission;
use PhpCollective\MenuMaker\Http\Requests\PermissionRequest as Request;

class PermissionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sections = Menu::sections()->pluck('name', 'id');
        $actions = Permission::actions();
        return view('menu-maker::permissions.index', compact('sections', 'actions'));
    }

    public function selected() {

        if(request()->ajax())
        {
            $menu_id = request('m_id');
            $selected = Menu::findOrFail($menu_id)->permissions()->select('namespace', 'controller', 'method', 'action')->get()->toArray();
            $selectedActions = [];
            foreach ($selected as $action) {
                $selectedActions[] = $action['namespace'] . '-' . $action['controller'] . '-' . $action['method'] . '-' . $action['action'];
            }
            return response()->json(compact('selectedActions'), 200);
        }
        return response()->json([
            'responseText' => 'Not a ajax request'
        ], 400);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $menu_id = Menu::findParent();
        $actions = $request->input('actions');
        $data = [];
        if ($actions && count($actions) > 0) {
            foreach ($actions as $action) {
                $parts = explode('-', $action);
                $data[] = new Permission([
                    'namespace' => $parts[0],
                    'controller' => $parts[1],
                    'method' => $parts[2],
                    'action' => $parts[3]
                ]);
            }
        }
        $menu = Menu::findOrFail($menu_id);
        $menu->permissions()->delete();
        $menu->permissions()->saveMany($data);

        return redirect()
            ->back()
            ->withInput()
            ->withMessage(__('menu-maker::alerts.permissions-updated', ['name' => $menu->name]));
    }

}
