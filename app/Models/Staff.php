<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Config;

class Staff extends Model implements Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    const SECOND_TO_YEAR = 60 * 60 * 24 * 30 * 12;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['age', 'profile_photo_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'profile_photo',
        'phone_number',
        'address',
        'username',
        'password',
        'id_role_staffs',
        'birth_date'
    ];

    public function getAuthIdentifierName(): string
    {
        return "username";
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function getRememberToken(): string
    {
        return 'dummy-token';
    }

    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

    public function getAuthIdentifier()
    {
        return $this->username;
    }

    public function setRememberToken($value)
    {
        $this->attributes["token"] = $value;
    }
    public function getAgeAttribute()
    {
        return round((strtotime(date('D-m-y')) - strtotime($this->birth_date)) / (self::SECOND_TO_YEAR));
    }

    public function getProfilePhotoUrlAttribute()
    {
        $filename = $this->profile_photo;
        
        if(is_file(Config::get('filesystems.disks.public.profile') . '/' . $filename)){
            return url('storage/profile/' . $filename);    
        }
        
        return url('storage/profile/not-found.jpg');
    }
}
