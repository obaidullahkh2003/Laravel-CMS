<?php

namespace App\Http\Controllers;

use App\Models\Articale;
use App\Http\Requests\StoreArticaleRequest;
use App\Http\Requests\UpdateArticaleRequest;

class ArticaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Articale::paginate(5);
        return view('articale.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articale.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticaleRequest $request)
    {
        $data = $request->only(['title', 'content', 'is_published']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Articale::create($data);

        return redirect()->route('articale.index')->with('success', 'Block created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articale $articale)
    {
        return view('articale.show', compact('articale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articale $articale)
    {
        return view('articale.edit', compact('articale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticaleRequest $request, Articale $articale)
    {
        $data = $request->only(['title', 'content', 'is_published']);

        if ($request->hasFile('image')) {
            if ($articale->image) {
                \Storage::disk('public')->delete($articale->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $articale->update($data);

        return redirect()->route('articale.index')->with('success', 'Block updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articale $articale)
    {
        if ($articale->image) {
            \Storage::disk('public')->delete($articale->image);
        }

        $articale->delete();

        return redirect()->route('articale.index')->with('success', 'Block deleted successfully!');
    }
}
