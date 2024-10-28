<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    ];

    public function getPaginateByLimit(int $limit_count = 10, $search = null)
    {
        $query = $this->orderBy('updated_at', 'DESC');

        // 検索処理などで、`0`も有効なキーワードとして扱う
        if ($search !== '') {
            $query->where('shop_name', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('count', 'LIKE', "%{$search}%");
        }

        return $query->paginate($limit_count);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function like_users()
    {
        return $this->belongsToMany(User::class, 'likes', 'user_id', 'menu_id');
    }
}
