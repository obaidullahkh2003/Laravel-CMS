<?php
namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Http\Requests\StoreNavigationRequest;
use App\Http\Requests\UpdateNavigationRequest;

class NavigationController extends Controller
{
    /**
     * Display a listing of the navigation items.
     */
    public function index()
    {
        $navigations = Navigation::paginate(5);
        return view('navigations.index', compact('navigations'));
    }

    /**
     * Show the form for creating a new navigation item.
     */
    public function create()
    {
        return view('navigations.create');
    }

    /**
     * Store a newly created navigation item in storage.
     */
    public function store(StoreNavigationRequest $request)
    {
        $data = $request->only(['label', 'url', 'order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        Navigation::create($data);
        return redirect()->route('navigations.index')->with('success', 'Navigation item created successfully!');
    }

    /**
     * Display the specified navigation item.
     */
    public function show(Navigation $navigation)
    {
        return view('navigations.show', compact('navigation'));
    }

    /**
     * Show the form for editing the specified navigation item.
     */
    public function edit(Navigation $navigation)
    {
        return view('navigations.edit', compact('navigation'));
    }

    /**
     * Update the specified navigation item in storage.
     */
    public function update(UpdateNavigationRequest $request, Navigation $navigation)
    {
        $data = $request->only(['label', 'url', 'order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        $navigation->update($data);
        return redirect()->route('navigations.index')->with('success', 'Navigation item updated successfully!');
    }

    /**
     * Remove the specified navigation item from storage.
     */
    public function destroy(Navigation $navigation)
    {
        $navigation->delete();
        return redirect()->route('navigations.index')->with('success', 'Navigation item deleted successfully!');
    }
}
