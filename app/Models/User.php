<?php

namespace App\Models;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

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
    ];

    public function textToken()
    {
        return $this->hasOne(TextToken::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function addToAuth()
    {
        Auth::login($this);
    }

    public function saveTextToken(TextToken $textToken)
    {
        $this->textToken()->save($textToken);
    }

    public function createNew(RegisterRequest $registerRequest)
    {
        $registerService = new RegisterService();
        $user = User::create($registerService->dataPrepare($registerRequest));
        $profile = new Profile();
        $user->profile()->save($profile);
        return $user;
    }

    public function getUserData()
    {
        return auth()->user()->with('profile')->where('id', auth()->user()->id)->first();
    }

    // проверяет есть ли роль
    private function hasRole($role)
    {
        if ($this->roles->contains('slug', $role)) {
            return true;
        }
        return false;
    }

    // проверяет на админа
    public function isAdmin()
    {
        if ($this->hasRole('admin')) {
            return true;
        }
        return false;
    }

    //сделать выдачу роли
}
