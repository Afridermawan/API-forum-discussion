<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

/**
 *
 */
class CommentModel extends Model
{
  protected $table = 'comments';
  protected $primarykey = 'id';
  protected $fillable = ['comment', 'tread_id', 'user_id', 'deleted'];
  public $timestamps = true;

  public function joinUser()
  {
    $data = $this->join('users', 'users.id', '=', 'comments.user_id')
                  ->select('comments.comment', 'users.username');
  }

  public function joinTread()
  {
    $data = $this->join('treads', 'treads.id', '=', 'comments.tread_id')
                  ->select('comments.comment', 'treads.title', 'treads.content');
  }
}
