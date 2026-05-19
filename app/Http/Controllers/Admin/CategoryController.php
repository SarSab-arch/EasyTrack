<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
          */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
            'min_days_required' => 'required|integer|min:1',
            'is_visible' => 'boolean',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'تم إضافة الخدمة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
            'min_days_required' => 'required|integer|min:1',
            'is_visible' => 'boolean',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'تم حذف الخدمة بنجاح');
    }

    public function dashboard()
{
    // 1. حساب إجمالي الخدمات المتوفرة
    $categoriesCount = \App\Models\Category::count();

    // 2. حساب المهمات النشطة التي في قيد التنفيذ
    $activeTasksCount = \App\Models\Task::where('status', 'in_progress')->count();

    // 3. جلب أحدث 3 خدمات مضافة لتغذية الجدول الأسفل (وهذا هو المتغير الذي سبب المشكلة)
    $latestCategories = \App\Models\Category::latest()->take(3)->get();
    $settings = \App\Models\Setting::first();
    // 4. تمرير كافة المتغيرات إلى الـ Blade معاً بأمان
    return view('admin.dashboard', compact('categoriesCount', 'activeTasksCount', 'latestCategories','settings'));
}
}