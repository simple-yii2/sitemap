<?php

namespace cms\sitemap\common\models;

use yii\db\ActiveRecord;

class Sitemap extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'Sitemap';
	}

	/**
	 * Owner setter
	 * @param ActiveRecord $owner 
	 * @return void
	 */
	public function setOwner($owner)
	{
		$this->owner = self::generateOwnerString($owner);
	}

	/**
	 * Find by owner
	 * @param ActiveRecord $owner 
	 * @return static|null
	 */
	public static function findByOwner($owner)
	{
		return static::findOne(['owner' => self::generateOwnerString($owner)]);
	}

	/**
	 * Owner string generator
	 * @param ActiveRecord $owner 
	 * @return string
	 */
	private static function generateOwnerString($owner)
	{
		$result = $owner::className();
		$result .= ':' . serialize($owner->getPrimaryKey());

		return $result;
	}

}
