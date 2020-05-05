<?php

namespace app\controllers;
use app\models\Customer;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class CustomerController Клиенты
 * @package app\controllers
 */
class CustomerController extends Controller
{
	public function actionDelete()
	{
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$request = \Yii::$app->request;
		$params = $request->getBodyParams();
		$id = $params['id'] ?? null;
		$data = [
			'status' => 'OK',
			'errors' => []
		];
		
		if (!$request->isAjax) {
			throw new HttpException(404, "Метод неизвестен");
		}
		
		$customer = Customer::findOne(['id' => $id]);
		
		if ($customer->delete() === false) {
			throw new HttpException(400,"Не удалось удалить клиента");
		}
		
		return $data;
	}
}