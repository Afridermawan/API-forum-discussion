<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TreadModel;

/**
 *
 */
class UserModel extends Model
{
  protected $table = 'users';
  protected $primarykey = 'id';
  protected $fillable = ['name', 'username', 'email', 'password', 'role_id', 'deleted'];
  public $timestamps = true;
}

?>
