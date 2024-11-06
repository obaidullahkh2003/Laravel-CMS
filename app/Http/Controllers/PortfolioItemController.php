<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Http\Requests\StorePortfolioItemRequest;
use App\Http\Requests\UpdatePortfolioItemRequest;
use Illuminate\Support\Facades\Storage;

class PortfolioItemController extends Controller
{
    public function index()
    {
        $portfolioItem = PortfolioItem::paginate(5);
        return view('portfolio.index', compact('portfolioItem'));
    }

    public function create()
    {

        return view('portfolio.create');
    }

    public function store(StorePortfolioItemRequest $request)
    {

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
        $portfolioItem = PortfolioItem::findOrFail($id);
        return view('portfolio.show', compact('portfolioItem'));
    }

    public function edit($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        return view('portfolio.edit', compact('id', 'portfolioItem'));
    }

    public function update(UpdatePortfolioItemRequest $request, $id)
    {
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
        $portfolioItem = PortfolioItem::findOrFail($id);

        if ($portfolioItem->image_path) {
            \Storage::disk('public')->delete(str_replace('/storage/', '', $portfolioItem->image_path));
        }

        $portfolioItem->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item deleted successfully!');
    }
}
