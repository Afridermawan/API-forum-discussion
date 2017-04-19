<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class AuthModel extends Model
{
  protected $table        = 'auth';
  protected $primaryKey   = 'id';
  protected $fillable     = ['user_id', 'key', 'expired'];
  public $timestamps      = false;
}


?>
