<?php

namespace cms\sitemap\frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

use cms\sitemap\common\models\Sitemap;

class SitemapController extends Controller
{

	/**
	 * Render sitemap xml file
	 * @return string
	 */
	public function actionIndex()
	{
		Yii::$app->response->format = Response::FORMAT_RAW;

		$headers = Yii::$app->response->headers;
		$headers->add('Content-Type', 'application/xml');

		$dataProvider = new ActiveDataProvider([
			'query' => Sitemap::find(),
			'pagination' => [
				'pageSize' => 200,
			],
		]);

		return $this->renderPartial('index', [
			'dataProvider' => $dataProvider,
		]);
	}

}
