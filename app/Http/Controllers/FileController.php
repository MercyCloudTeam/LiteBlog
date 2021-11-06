<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file'  => 'required|mimes:png,jpg,jpeg,gif|max:5144',
      ]);

      if($validator->fails()) {
          return response()->json(['error'=>$validator->errors()], 401);
       }

      if ($file = $request->file('file')) {
          $path = $file->store('public/files');

          return $this->apiResult(['path'=>$path]);
        }
    }
}
