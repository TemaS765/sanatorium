<?php

namespace app\models;

use yii\db\ActiveRecord;

class Housing extends ActiveRecord
{
	public static function tableName()
	{
		return 'housing';
	}
}
