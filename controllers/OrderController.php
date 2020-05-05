<?php

namespace app\controllers;

use app\models\OrderForm;
use app\models\OrderService;
use app\models\Service;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Контроллер заказов
 * Class OrderController
 * @package app\controllers
 */
class OrderController extends Controller
{
	public function actionCreate()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$data = [
			'status' => 'OK',
			'errors' => []
		];
		$model = new OrderForm();
		$model->setScenario('create');
		
		if($model->load(\Yii::$app->request->post()) && $model->validate()) {
			if (!$model->save()) {
				throw new HttpException(400, "Не удалось создать заказ");
			}
		}
		
		if ($model->hasErrors()) {
			foreach ($model->getErrors() as $field => $messages) {
				throw new HttpException(400, $messages);
			}
		}
		
		return $data;
	}
}
