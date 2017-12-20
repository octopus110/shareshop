<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function add($src, $classfiy,$href)
    {
        $id = $this->insertGetId([
            'src' => $src,
            'classify' => $classfiy,
            'href'=>$href
        ]);

        return $id;
    }
}
