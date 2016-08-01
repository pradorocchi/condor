<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property BelongsToMany|Collection $accounts
 * @property HasManyThrough|Collection $boards
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = ['accounts'];

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

    public function boards()
    {
        return $this->hasManyThrough(
            Board::class, Account::class,
            'id', 'id'
        );
    }
}
