<?php

namespace PhpCollective\MenuMaker\Http\Controllers;

use Illuminate\Routing\Controller;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Http\Requests\MenuRequest as Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Menu::sections()->paginate();
        return view('menu-maker::sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu-maker::sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Menu::create($request->only('name', 'alease'));
        return redirect()
            ->route('menu-maker::sections.index')
            ->withMessage(__('menu-maker::alerts.created', ['name' => $request->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Menu $section
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $section)
    {
        return view('menu-maker::sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Menu $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $section)
    {
        return view('menu-maker::sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Menu $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $section)
    {
        $section->update($request->all());
        return redirect()
            ->to($request->redirects_to)
            ->withMessage(__('menu-maker::alerts.updated', ['name' => $request->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Menu $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $section)
    {
        $name = $section->name;
        $section->delete();
        return redirect()
            ->to(request('redirects_to'))
            ->withMessage(__('menu-maker::alerts.deleted', ['name' => $name]));
    }
}
