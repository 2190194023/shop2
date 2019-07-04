<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mycar extends Model
{
    public $table='mycar';

    // 指定主键的名称
	protected $primaryKey = 'id';

	// 时间戳
	public $timestamps = false;
}
