<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public function index() 
    {
      $categories = \App\Models\Category::latest()->take(3)->get();
    $settings = \App\Models\Setting::first();

    return view('welcome', compact('categories', 'settings'));
    }

    public function orderForm($id)
    {
        $category = Category::findOrFail($id);
        $settings = \App\Models\Setting::first();
        return view('client.order', compact('category','settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'customer_name' => 'required|string|max:255',
            'client_email' => 'required|email',
            'client_phone' => 'required',
            'deadline' => 'required|date',
        ]);

        $task = new Task();
        
        
        
        $task->customer_name = $request->customer_name; 
        $task->title = 'طلب من: ' . $request->customer_name;
        $task->category_id = $request->category_id;
        $task->client_email = $request->client_email;
        $task->client_phone = $request->client_phone;
        $task->deadline = $request->deadline;
        $task->order_description = $request->order_description;
        $task->status = 'under_review'; 
        
        $task->save();

        return redirect()->route('order.success', ['tracking_id' => $task->tracking_id]);
    }

    public function orderSuccess($tracking_id)
    {
        $task = Task::where('tracking_id', $tracking_id)->firstOrFail();
        $settings = \App\Models\Setting::first();
        return view('client.order_success', compact('task', 'settings'));
    }

    public function services() 
    {
        $categories = Category::all(); 
        $settings = Setting::first();
        return view('client.services', compact('categories', 'settings'));
    }

    public function track($tracking_id)
    {
        $task = Task::with('category')->where('tracking_id', $tracking_id)->firstOrFail();
        $settings = \App\Models\Setting::first();
        return view('client.track', compact('task' ,'settings'));
    }

    public function trackSearch(Request $request) 
    {
        $query = $request->input('order_number'); 

        $tasks = Task::where('tracking_id', $query)
                    ->orWhere('client_email', $query)
                    ->orWhere('client_phone', $query)
                    ->latest()
                    ->get();

        if ($tasks->isEmpty()) {
            return back()
            ->withFragment('#track')
            ->with('error', 'عذراً، لم نجد أي طلبات مرتبطة بهذه البيانات.');
        }

        if ($tasks->count() == 1) {
            return redirect()->route('client.track', ['tracking_id' => $tasks->first()->tracking_id]);
        }
        $settings = \App\Models\Setting::first();

        return view('client.my_orders', compact('tasks','settings'));
    }
}