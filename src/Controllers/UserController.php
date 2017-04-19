<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\AuthModel;

/**
 *
 */
class UserController extends Controller
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
      $auth = AuthModel::where('key', $key)->first();

      if(!is_null($auth)){
          if($auth->expired < date('Y-m-d')){
              return true;
          } else{
              return false;
          }
      } else {
          return true;
      }
  }

  public function postSignIn($request, $response)
  {
    $request = $request->getParsedBody();
    $auth = $this->auth->attempt(
      $request['username'],
      $request['password']
    );

    if (!$auth) {
      $data['status'] = 401;
      $data['message'] = 'username atau password salah !';
    } else {
      $user = UserModel::where('username', $request['username'])->first();

      $data['token'] = AuthModel::where('user_id', $user->id)->first()->key;
      $data['status'] = 200;
      $data['message'] = 'Login berhasil';
    }

    return $this->returnJson($response, $data, $data['status']);
  }

  public function postSignUp($request, $response)
  {
    $request = $request->getParsedBody();

    if (is_null(UserModel::where('username', $request['username'])->first())) {
      UserModel::create([
        'name'      => $request['name'],
        'username'  => $request['username'],
        'email'     => $request['email'],
        'password'  => password_hash($request['password'], PASSWORD_BCRYPT),
      ]);

      $data['status']   = 200;
      $data['message']  = 'Registrasi berhasil';
    } else {
      $data['status']   = 400;
      $data['message']  = 'Registrasi gagal';
    }

    return $this->returnJson($response, $data, $data['status']);
  }
}

?>
