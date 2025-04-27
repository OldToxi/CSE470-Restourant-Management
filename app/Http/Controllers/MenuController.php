<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $starters = MenuItem::where('category', 'starters')->get();
        $mains = MenuItem::where('category', 'mains')->get();
        $drinks = MenuItem::where('category', 'drinks')->get();

        return view('admin.menu.index', compact('starters', 'mains', 'drinks'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:starters,mains,drinks',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'sometimes|boolean',
        ]);

        $menuItem = new MenuItem();
        $menuItem->name = $validated['name'];
        $menuItem->description = $validated['description'] ?? null;
        $menuItem->price = $validated['price'];
        $menuItem->category = $validated['category'];
        $menuItem->is_available = $request->has('is_available');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu_images', 'public');
            $menuItem->image_path = $path;
        }

        $menuItem->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully');
    }

    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return view('admin.menu.edit', compact('menuItem'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:starters,mains,drinks',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'sometimes|boolean',
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->name = $validated['name'];
        $menuItem->description = $validated['description'] ?? null;
        $menuItem->price = $validated['price'];
        $menuItem->category = $validated['category'];
        $menuItem->is_available = $request->has('is_available');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menuItem->image_path) {
                Storage::disk('public')->delete($menuItem->image_path);
            }
            
            $path = $request->file('image')->store('menu_images', 'public');
            $menuItem->image_path = $path;
        }

        $menuItem->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully');
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        
        // Delete image if exists
        if ($menuItem->image_path) {
            Storage::disk('public')->delete($menuItem->image_path);
        }
        
        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully');
    }

    public function toggleAvailability($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->is_available = !$menuItem->is_available;
        $menuItem->save();

        return redirect()->route('admin.menu.index')->with('success', 'Availability updated');
    }
}