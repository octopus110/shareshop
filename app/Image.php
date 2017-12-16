<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function add($src, $classfiy)
    {
        $id = $this->insertGetId([
            'src' => $src,
            'classify' => $classfiy
        ]);

        return $id;
    }
}
