<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // إحصائيات سريعة
        $totalCategories = Category::count();
        
        // توزيع الخدمات حسب تاريخ الإضافة (كمثال لتقرير زمني)
        $categoriesOverTime = Category::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.reports.index', compact('totalCategories', 'categoriesOverTime'));
    }
}