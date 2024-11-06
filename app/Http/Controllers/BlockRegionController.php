<?php

namespace App\Http\Controllers;

use App\Models\BlockRegion;
use App\Http\Requests\StoreBlockRegionRequest;
use App\Http\Requests\UpdateBlockRegionRequest;

class BlockRegionController extends Controller
{
    public function index()
    {
        $blockRegions = BlockRegion::paginate(5);
        return view('blockRegions.index', compact('blockRegions'));
    }

    public function create()
    {
        return view('blockRegions.create');
    }

    public function store(StoreBlockRegionRequest $request)
    {
        $blockRegion = BlockRegion::create($request->validated());
        return redirect()->route('blockRegions.index')->with('success', 'Block region created successfully.');
    }

    public function show(BlockRegion $blockRegion)
    {
        return view('blockRegions.show', compact('blockRegion'));
    }

    public function edit(BlockRegion $blockRegion)
    {
        return view('blockRegions.edit', compact('blockRegion'));
    }

    public function update(UpdateBlockRegionRequest $request, BlockRegion $blockRegion)
    {
        $blockRegion->update($request->validated());
        return redirect()->route('blockRegions.index')->with('success', 'Block region updated successfully.');
    }

    public function destroy(BlockRegion $blockRegion)
    {
        $blockRegion->delete();
        return redirect()->route('blockRegions.index')->with('success', 'Block region deleted successfully.');
    }
}
