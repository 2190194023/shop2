<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    // 指定表名
	protected $table = 'link';

	// 指定主键的名称
	protected $primaryKey = 'id';

	// 时间戳
	public $timestamps = false;

}
