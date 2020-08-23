<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['cotent', 'status', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
