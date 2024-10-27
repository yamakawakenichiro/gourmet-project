<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'menu_id',
        'category_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
