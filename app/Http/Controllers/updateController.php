<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Storage;

class updateController extends Controller
{
    //多图片上传接口
    public function images(Request $request)
    {
        $file = $request->file('image');
        if ($file->isValid()) {
            if (in_array(strtolower($file->getClientOriginalExtension()), ['jpeg', 'jpg', 'gif', 'png'])) {
                $newName = 'commodity_' . time() . rand(1, 999999) . '.' . $file->getClientOriginalExtension();

                $realPath = $file->getRealPath();

                $bool = Storage::disk('uploads')->put($newName, file_get_contents($realPath));

                if ($bool) {
                    $imageModel = new Image();
                    $id = $imageModel->add($newName, 0);

                    if ($id) {
                        return response()->json(['statusCode' => 200, 'id' => $id]);
                    }
                }
            }
        }
        return response()->json(['statusCode' => 100, 'confirmMsg' => '上传失败']);
    }
}
