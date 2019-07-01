<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // 指定表名
	protected $table = 'order';

	// 指定主键的名称
	protected $primaryKey = 'id';

	// 时间戳
	public $timestamps = false;


}
