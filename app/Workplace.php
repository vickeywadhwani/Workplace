<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected  $fillable = ['title','price','user_id','address','latitude','longitude','image'];

    /**
     * Workplace belongs to some user
     */
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
