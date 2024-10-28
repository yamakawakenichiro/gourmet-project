<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PgSql\Lob;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //リレーション
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    public function reports()
    {
        return $this->belongsToMany(Report::class);
    }
    public function likes()
    {
        return $this->belongsToMany(Menu::class, 'likes', 'user_id', 'menu_id');
    }

    //投稿をいいねしている状態か確認
    public function is_like($menuId)
    {
        return $this->likes()->where('menu_id', $menuId)->exists();
    }
    //いいねする
    public function like(Menu $menu)
    {
        $exist = $this->is_like($menu->id);

        if ($exist) {
            return false;
        } else {
            $this->likes()->attach($menu->id);
            return true;
        }
    }
    //いいね解除
    public function unlike(Menu $menu)
    {
        $exist = $this->is_like($menu->id);

        if ($exist) {
            $this->likes()->detach($menu->id);
            return true;
        } else {
            return false;
        }
    }
}
