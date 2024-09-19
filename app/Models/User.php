<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ACTIVE = 1;
    const INACTIVE = 0;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_nummber',
        'notification_type',
        'address',
        'city',
        'remember_token',
        'admin',
        'missing_notification',
        'share_name',
        'share_other_contact',
        'share_contact',
        'share_address',
        'share_vet_info',
        'username',
        'status',
        'superadmin'
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

    public function getUsers()
    {
        $users = ($this->admin || $this->superadmin) ? User::all() : [$this];

        return $users;
    }

    public function getPets()
    {
        $pets = ($this->admin || $this->superadmin) ? $pets = Pet::all() : $this->pets;

        return $pets;
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function getNotificationAttribute(){

        $notification = $this->notification_type;

        $notification_name = 'N/A';

        switch ($notification) {
            case '1':
                $notification_name = 'Email';
                break;
            case '2':
                $notification_name = 'SMS';
                break;
            case '3':
                $notification_name = 'N/A';
                break;
            default:
                $notification_name = 'N/A';
                break;
        }

        return $notification_name;

    }

    protected static function booted () {
        static::deleting(function(User $user) { 
             $user->pets()->delete();
        });
    }
}
