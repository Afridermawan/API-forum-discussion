<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

/**
 *
 */
class TreadModel extends Model
{
  protected $table = 'treads';
  protected $primarykey = 'id';
  protected $fillable = ['title', 'content', 'user_id', 'deleted'];
  public $timestamps = true ;

   public function joinUser()
  {
    $data = $this->join('users', 'users.id', '=', 'treads.user_id')
                ->select('treads.title', 'treads.content', 'users.username');
    return $data;
  }
}


?>
