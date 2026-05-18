<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     
    protected $fillable = ['name', 'icon', 'description', 'is_visible','min_days_required'];
    

  
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
