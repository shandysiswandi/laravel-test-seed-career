<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // use Notifiable;
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * Relation Model
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
