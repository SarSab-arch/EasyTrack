<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Task extends Model
{
    use HasFactory;

protected $fillable = [
    'tracking_id',     
    'customer_name',    
    'title',            
    'category_id', 
    'client_email', 
    'client_phone', 
    'deadline', 
    'order_description', 
    'payment_method', 
    'status'
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getStatusArabicAttribute()
{
    return [
        'under_review' => 'تحت المراجعة',
        'in_progress'  => 'جاري التنفيذ',
        'completed'    => 'مكتمل',
        'rejected'     => 'مرفوض',
    ][$this->status] ?? $this->status;
}
protected static function boot()
{
    parent::boot();
    static::creating(function ($task) {
        
        $task->tracking_id = 'ET-' . strtoupper(Str::random(4)) . '-' . rand(10, 99);
    });
}
}