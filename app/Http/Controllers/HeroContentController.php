<?php

namespace App\Http\Controllers;

use App\Models\HeroContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroContents = HeroContent::orderBy('sort_order')->get();
        return view('admin.hero-contents.index', compact('heroContents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-contents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('hero-content', 'public');
        }

        HeroContent::create($validated);

        return redirect()->route('admin.hero-contents.index')
            ->with('success', 'Hero content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroContent $heroContent)
    {
        return view('admin.hero-contents.show', compact('heroContent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroContent $heroContent)
    {
        return view('admin.hero-contents.edit', compact('heroContent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroContent $heroContent)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($request->hasFile('background_image')) {
            if ($heroContent->background_image) {
                Storage::disk('public')->delete($heroContent->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('hero-content', 'public');
        }

        $heroContent->update($validated);

        return redirect()->route('admin.hero-contents.index')
            ->with('success', 'Hero content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroContent $heroContent)
    {
        if ($heroContent->background_image) {
            Storage::disk('public')->delete($heroContent->background_image);
        }

        $heroContent->delete();

        return redirect()->route('admin.hero-contents.index')
            ->with('success', 'Hero content deleted successfully.');
    }

    /**
     * Toggle hero content status
     */
    public function toggleStatus(Request $request, HeroContent $heroContent)
    {
        $validated = $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $heroContent->update(['is_active' => $validated['is_active']]);

        return response()->json([
            'success' => true,
            'message' => 'Hero content status updated successfully.',
            'is_active' => $heroContent->is_active
        ]);
    }
}
