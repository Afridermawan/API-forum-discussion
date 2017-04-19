<?php

namespace App\Auth\Api;

use App\Models\UserModel;
use App\Models\AuthModel;

/**
 *
 */
class Auth
{
  public function attempt($username, $password)
  {
      $user = UserModel::where('username', $username)->first();

      if (!$user) {
          return false;
      }

      if (password_verify($password, $user->password)) {
          if (is_null(AuthModel::where('key', md5($username))->first())) {
              AuthModel::create([
                  'user_id' => $user->id,
                  'key'     => md5($username),
                  'expired' => date('Y-m-d', strtotime('+6 days')),
              ]);
          }

          return true;
      }

      return false;
  }

  /**
  *
  */
  public function check($key)
  {
      return !is_null(AuthModel::where('key', $key)->first());
  }
}
