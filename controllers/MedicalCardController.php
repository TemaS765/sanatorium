<?php

namespace app\controllers;

use app\models\MedicalCard;
use app\models\MedicalCardForm;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class MedicalCardController Медицинские карты
 * @package app\controllers
 */
class MedicalCardController extends Controller
{
	/**
	 * Сохранить информацию о медицинской карте
	 * @throws HttpException
	 * @throws \Throwable
	 * @throws \yii\base\InvalidConfigException
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionSave()
	{
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$request = \Yii::$app->request;
		$params = $request->getBodyParams();
		
		$data = [
			'status' => 'OK',
			'errors' => []
		];
		
		if (!$request->isAjax) {
			throw new HttpException(404, "Метод неизвестен");
		}
		
		$model = new MedicalCardForm();
		$model->setAttributes($params);
		
		if (!empty($params['has_certificate_health'])) {
			$model->has_certificate_health = 'YES';
		} else {
			$model->has_certificate_health = 'NO';
		}
		
		if($model->validate()) {
			if (!$model->save()) {
				throw new HttpException(400, "Не удалось сохранить информацию о медицинской карте");
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