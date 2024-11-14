<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

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
        'latitude',
        'longitude',
    ];

    public function scopeGetPaginateByLimit(Builder $query, int $limitCount = 30, array $keywords = [])
    {
        $query->orderBy('updated_at', 'DESC');

        // キーワードが存在する場合に条件を追加
        if (!empty($keywords['name'])) {
            $query->where(function ($q) use ($keywords) {
                $q->where('shop_name', 'LIKE', "%{$keywords['name']}%")
                    ->orWhere('name', 'LIKE', "%{$keywords['name']}%");
            });
        }

        return $query->paginate($limitCount);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function like_users()
    {
        return $this->belongsToMany(User::class, 'likes', 'menu_id', 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
