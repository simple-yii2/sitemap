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
	public function setOwner($owner, $key)
	{
		if ($key === null)
			$key = self::generateOwnerString($owner);

		$this->ownerKey = $key;
	}

	/**
	 * Find by owner
	 * @param ActiveRecord $owner 
	 * @return static|null
	 */
	public static function findByOwner($owner, $key)
	{
		if ($key === null)
			$key = self::generateOwnerString($owner);

		return static::findOne(['ownerKey' => $key]);
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
