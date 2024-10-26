<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'image',
        'shop_name',
        'name',
        'price',
        'count',
        'body',
    ];

    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
