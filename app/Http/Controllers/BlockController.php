<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Http\Requests\StoreBlockRequest;
use App\Http\Requests\UpdateBlockRequest;
use App\Models\BlockRegion;

class BlockController extends Controller
{
    protected $permissionsArray = [];

    public function __construct()
    {
        $this->permissionsArray = getPermissionsArray();
    }
    public function index()
    {
        if (!in_array('View Blocks', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $blocks = Block::paginate(5);
        return view('blocks.index', compact('blocks'));
    }

    public function create()
    {
        if (!in_array('add block', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $regions = BlockRegion::all();
        return view('blocks.create', compact('regions'));
    }

    public function store(StoreBlockRequest $request)
    {
        if (!in_array('add block', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $data = $request->only(['region_id', 'title', 'content']);

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('images', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Block::create($data);

        return redirect()->route('blocks.index')->with('success', 'Block created successfully.');
    }



    public function show(Block $block)
    {
        if (!in_array('View Blocks', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('blocks.show', compact('block'));
    }

    public function edit(Block $block)
    {
        if (!in_array('edit block', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        return view('blocks.edit', compact('block'));
    }

    public function update(UpdateBlockRequest $request, Block $block)
    {
        if (!in_array('edit block', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $data = $request->only(['region_id', 'title', 'content']);

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('images', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $block->update($data);

        return redirect()->route('blocks.index')->with('success', 'Block updated successfully.');
    }



    public function destroy(Block $block)
    {
        if (!in_array('delete block', array_keys(getPermissionsArray())))
            abort(403, 'You are not authorized to view this resource.');
        $block->delete();
        return redirect()->route('blocks.index')->with('success', 'Block deleted successfully.');
    }
}
