<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\Flysystem\Exception;

class Classify extends Model
{
    protected $table = 'classifys';

    public function getInfo()
    {
        $res = $this->select('id', 'name', 'sort')->get();

        return $res;
    }

    public function add($data)
    {
        if (is_array($data)) {
            $this->name = $data['name'];
            $this->sort = $data['sort'];
            $res = $this->save();

            if ($res) {
                return true;
            }

            return false;
        }
        return false;
    }
}
