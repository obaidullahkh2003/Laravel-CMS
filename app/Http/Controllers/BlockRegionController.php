<?php

namespace App\Http\Controllers;

use App\Models\BlockRegion;
use App\Http\Requests\StoreBlockRegionRequest;
use App\Http\Requests\UpdateBlockRegionRequest;

class BlockRegionController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
                                if (!in_array('View Regions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $blockRegions = BlockRegion::paginate(5);
        return view('blockRegions.index', compact('blockRegions'));
    }

    public function create()
    {
                                if (!in_array('add regions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('blockRegions.create');
    }

    public function store(StoreBlockRegionRequest $request)
    {
                                if (!in_array('add regions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $blockRegion = BlockRegion::create($request->validated());
        return redirect()->route('blockRegions.index')->with('success', 'Block region created successfully.');
    }

    public function show(BlockRegion $blockRegion)
    {
                                if (!in_array('View Regions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('blockRegions.show', compact('blockRegion'));
    }

    public function edit(BlockRegion $blockRegion)
    {
                                if (!in_array('edit regions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('blockRegions.edit', compact('blockRegion'));
    }

    public function update(UpdateBlockRegionRequest $request, BlockRegion $blockRegion)
    {
                                if (!in_array('edit regions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $blockRegion->update($request->validated());
        return redirect()->route('blockRegions.index')->with('success', 'Block region updated successfully.');
    }

    public function destroy(BlockRegion $blockRegion)
    {
                                if (!in_array('delete regions', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $blockRegion->delete();
        return redirect()->route('blockRegions.index')->with('success', 'Block region deleted successfully.');
    }
}
