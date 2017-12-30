<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Storage;

class updateController extends Controller
{
    //多图片上传接口
    public function images(Request $request, $type = 0)
    {
        $file = $request->file('image');

        if ($file->isValid()) {
            dd(1);
            if (in_array(strtolower($file->getClientOriginalExtension()), ['jpeg', 'jpg', 'gif', 'png'])) {
                $newName = 'commodity_' . time() . rand(1, 999999) . '.' . $file->getClientOriginalExtension();

                $realPath = $file->getRealPath();

                $bool = Storage::disk('uploads')->put($newName, file_get_contents($realPath));

                if ($bool) {
                    $imageModel = new Image();
                    $id = $imageModel->add($newName, $type);

                    if ($id) {
                        return response()->json(['statusCode' => 200, 'id' => $id]);
                    }
                }
            }
        }
        return response()->json(['statusCode' => 100, 'confirmMsg' => '上传失败']);
    }

    //banner图上传
    public function banner(Request $request)
    {
        $file = $request->file('image');
        $src = $request->input('src');
        if (count($file)) {
            foreach ($file as $k => $item) {
                if ($item->isValid()) {
                    if (in_array(strtolower($item->getClientOriginalExtension()), ['jpeg', 'jpg', 'gif', 'png'])) {
                        $newName = 'banner_' . time() . rand(1, 999999) . '.' . $item->getClientOriginalExtension();

                        $realPath = $item->getRealPath();

                        $bool = Storage::disk('uploads')->put($newName, file_get_contents($realPath));

                        if ($bool) {
                            $imageModel = new Image();
                            $id = $imageModel->add($newName, 1, $src[$k]);
                        }
                    }
                }
            }
        }

    }
}
