<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hikyo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hikyos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'place', 'introduction', 'lank', 'time_from_tokyo', 'how_much_from_tokyo', 'caution'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
