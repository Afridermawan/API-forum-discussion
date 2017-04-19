<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\AuthModel;

class CommentController extends Controller
{
	/**
    *
    */
    public function postComment($request, $response, $args)
    {
        $id = AuthModel::where('key', $request->getHeader('Authorization')[0])->first();

    	$request = $request->getParsedBody();

    	$rules = [
    		'required' => [
    			['comment'],
    		],
    	];
    	$this->validator->rules($rules);
    	if ($this->validator->validate()) {
		$data['status'] = '200';
		$data['message'] = 'Comment berhasil !';
    	$data = new CommentModel;
        $data->comment = $request['comment'];
        $data->tread_id = $args['id'];
        $data->user_id = $id->user_id;
        $data->save();

        return $this->returnJson($response, $data, $data['status']);;
    	} else {
    		$data['status'] = '400';
				$data['message'] = 'Comment gagal !';

    		return $this->returnJson($response, $data, $data['status']);
    	}

    }

    /**
    *
    */
    public static function getByPost($args)
    {
    	return CommentModel::where('tread_id', $args)->where('deleted', 0)->get();
    }
}





?>
