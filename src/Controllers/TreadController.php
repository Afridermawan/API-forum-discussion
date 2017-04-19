<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\CommentController;
use App\Models\UserModel;
use App\Models\TreadModel;
use App\Models\AuthModel;

/**
 *
 */
class TreadController extends Controller
{
  public function listTread($request, $response)
  {
    $data['status']   = 200;
    $data['message']  = 'Berhasil mengambil data';
    $tread = new TreadModel;
    $page = $request->getParam('page') ? $request->getParam('page') : 1;
    $data['data'] = $tread->joinUser()->paginate(1, ['*'], 'page', $page);

    return $this->returnJson($response, $data, $data['status']);
  }

  public function createTread($request, $response)
  {
    $id = AuthModel::where('key', $request->getHeader('Authorization')[0])->first();
    $request = $request->getParsedBody();
    $rules = [
      'required' => [
        ['title'],
        ['content'],
      ],
      'lengthMin' => [
        ['title', 5],
        ['content', 10]
      ],
      'lengthMax' => [
        ['title', 50],
        ['content', 50000],
      ],
    ];

    $this->validator->rules($rules);

    if ($this->validator->validate()) {
      $data['status']     = 200;
      $data['message']    = 'Tread berhasil di save';
      $data = new TreadModel;
      $data->title        = $request['title'];
      $data->content      = $request['content'];
      $data->user_id      = $id->user_id;
      $data->save();

      return $this->returnJson($response, $data, $data['status']);
    } else {
      $data['status']     = 400;
      $data['message']    = 'Tread gagal di save';

      return $this->returnJson($response, $data, $data['status']);
    }
  }

  public function editTread($request, $response, $args)
  {
      $id = AuthModel::where('key', $request->getHeader('Authorization')[0])->first();
      $request = $request->getParsedBody();
      $rules = [
          'required' => [
              ['title'],
              ['content']
          ],
          'lengthMax' => [
              ['title', 50],
              ['content', 50000]
          ],
      ];

      $this->validator->rules($rules);

      if ($this->validator->validate()) {
          $data['status']    = 200;
          $data['message']   = 'Berhasil mengedit Data tread !';
          $data = TreadModel::where('id', $args['id'])->first();
          $data->title       = $request['title'];
          $data->content     = $request['content'];
          $data->user_id     = $id->user_id;
          $data->update();

          return $this->returnJson($response, $data, $data['status']);
      } else {
          $data['status']    = 400;
          $data['message']   = 'Ada kesalahan saat melakukan edit !';

          return $this->returnJson($response, $data, $data['status']);
      }

  }

  public function softDelete($request, $response, $args)
  {
      $data['status'] = 200;
      $data['message'] = 'Berhasil Menghapus Data tread';
      $data = TreadModel::find($args['id']);
      $data->deleted = 1;
      $data->update();

      return $this->returnJson($response, $data, $data['status']);
  }

  public function readTread($request, $response, $args)
  {
      $data['status'] = 200;
      $data['message'] = 'Berhasil mengambil data tread';
      $tread = TreadModel::find($args['id']);
      $comment = CommentController::getByTread($args['id']);

      return $this->returnJson($response, $data, $data['status']);
  }
}


?>
