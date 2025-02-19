<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;

class CarouselController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
        if (!in_array('View Page Content carousels', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $carousels = Carousel::paginate(5);
        return view('carousels.index', compact('carousels'));
    }


    public function create()
    {
        if (!in_array('create carousels', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('carousels.create');
    }

    public function store(StoreCarouselRequest $request)
    {
        if (!in_array('create carousels', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $data = $request->only(['subheading', 'heading', 'button_text', 'button_link']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('images', 'public');
        }

        Carousel::create($data);
        return redirect()->route('carousels.index')->with('success', 'Carousel item created successfully!');
    }

    public function show(Carousel $carousel)
    {
        if (!in_array('View Page Content carousels', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('carousels.show', compact('carousel'));
    }

    public function edit(Carousel $carousel)
    {
        if (!in_array('edit carousels', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('carousels.edit', compact('carousel'));
    }

    public function update(UpdateCarouselRequest $request, Carousel $carousel)
    {
        if (!in_array('edit carousels', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $data = $request->only(['subheading', 'heading', 'button_text', 'button_link']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            if ($carousel->image_url) {
                \Storage::disk('public')->delete(str_replace('/storage/', '', $carousel->image_url));
            }
            $data['image_url'] = $request->file('image')->store('images', 'public');
        }

        $carousel->update($data);
        return redirect()->route('carousels.index')->with('success', 'Carousel item updated successfully!');
    }

    public function destroy(Carousel $carousel)
    {
        if (!in_array('delete carousels', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        if ($carousel->image_url) {
            \Storage::disk('public')->delete(str_replace('/storage/', '', $carousel->image_url));
        }

        $carousel->delete();
        return redirect()->route('carousels.index')->with('success', 'Carousel item deleted successfully!');
    }
}
