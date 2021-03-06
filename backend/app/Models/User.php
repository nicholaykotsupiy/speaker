<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Boolean;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getSubscribersCountAttribute() // Подпищики
    {
        return Auth::user()->subscribers->count();
    }
    public function getSubscribeCountAttribute() // Подписки
    {
        return Subscriber::where('subscriber_id', Auth::id())->get()->count();
    }

    public function subscribed(Int $id)
    {
        return boolval(Auth::user()->subscribe->find($id));
    }


    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class);
    }

    public function subscribe(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscribers', 'subscriber_id', 'user_id');
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscribers', 'user_id', 'subscriber_id');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }
}
