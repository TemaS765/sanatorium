<?php

namespace app\controllers;

use app\models\OrderService;
use app\models\OrderServiceForm;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class OrderServiceController Заказы на дополнительные услуги
 * @package app\controllers
 */
class OrderServiceController extends Controller
{
	public function actionCreate()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$data = [
			'status' => 'OK',
			'errors' => []
		];
		$model = new OrderServiceForm();
		$model->setScenario('create');
		
		if($model->load(\Yii::$app->request->post()) && $model->validate()) {
			if (!$model->save()) {
				throw new HttpException(400, "Не удалось создать заказ");
			}
		}
		
		if ($model->hasErrors()) {
			foreach ($model->getErrors() as $messages) {
				throw new HttpException(400, reset($messages));
			}
		}
		
		return $data;
	}
	
	public function actionDelete()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;
		$params = $request->getBodyParams();
		$id = $params['id'] ?? null;
		$data = [
			'status' => 'OK',
			'errors' => []
		];
		
		if (!$request->isAjax) {
			throw new HttpException(404, "Метод неизвестен");
		}
		
		if (!$id) {
			throw new HttpException(400, "Параметр id обязателен");
		}
		
		if (OrderService::findOne(['id' => $id])->delete() === false) {
			throw new HttpException(400, "Не удалось удалить заказ на услугу");
		}
		
		return $data;
	}
}