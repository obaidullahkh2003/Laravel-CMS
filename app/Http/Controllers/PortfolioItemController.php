<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Http\Requests\StorePortfolioItemRequest;
use App\Http\Requests\UpdatePortfolioItemRequest;
use Illuminate\Support\Facades\Storage;

class PortfolioItemController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
        if (!in_array('View Page Content portfolio', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $portfolioItem = PortfolioItem::paginate(5);
        return view('portfolio.index', compact('portfolioItem'));
    }

    public function create()
    {
        if (!in_array('create portfolio', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('portfolio.create');
    }

    public function store(StorePortfolioItemRequest $request)
    {
        if (!in_array('create portfolio', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $data = $request->only(['title', 'subtitle', 'client_name', 'category']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('images', 'public');
        }

        PortfolioItem::create($data);

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item created successfully!');
    }

    public function show($id)
    {
        if (!in_array('View Page Content portfolio', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $portfolioItem = PortfolioItem::findOrFail($id);
        return view('portfolio.show', compact('portfolioItem'));
    }

    public function edit($id)
    {
        if (!in_array('edit portfolio', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $portfolioItem = PortfolioItem::findOrFail($id);
        return view('portfolio.edit', compact('id', 'portfolioItem'));
    }

    public function update(UpdatePortfolioItemRequest $request, $id)
    {
        if (!in_array('edit portfolio', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $portfolioItem = PortfolioItem::findOrFail($id);

        $data = $request->only(['title', 'subtitle', 'client_name', 'category']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image_path')) {
            if ($portfolioItem->image_path) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $portfolioItem->image_path));
            }
            $data['image_path'] = $request->file('image_path')->store('images', 'public');
        }

        $portfolioItem->update($data);

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item updated successfully!');
    }

    public function destroy($id)
    {
        if (!in_array('delete portfolio', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $portfolioItem = PortfolioItem::findOrFail($id);

        if ($portfolioItem->image_path) {
            \Storage::disk('public')->delete(str_replace('/storage/', '', $portfolioItem->image_path));
        }

        $portfolioItem->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item deleted successfully!');
    }
}
