<?php

namespace app\controllers;

use app\models\MedicalCard;
use app\models\MedicalCardForm;
use app\models\TreatmentSchedule;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class TreatmentScheduleController График лечения
 * @package app\controllers
 */
class TreatmentScheduleController extends Controller
{
	/**
	 * Сохранить информацию о графике лечения
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
		
		$schedule = $params['treatment_schedule'] ?? null;
		
		if (!$request->isAjax) {
			throw new HttpException(404, "Метод неизвестен");
		}
		
		if (empty($schedule)) {
			throw new HttpException(400, "График лечения не заполнен");
		}
		
		$treatment_schedules = TreatmentSchedule::find()
			->where("id IN(".implode(',', array_keys($schedule)).")")
			->all();
		/** @var TreatmentSchedule[] $treatment_schedules */
		$treatment_schedules = ArrayHelper::index($treatment_schedules, 'id');
		
		foreach ($schedule as $id => $treatment_ids) {
			if (isset($treatment_schedules[$id])) {
				$treatment_schedules[$id]->treatment_ids = implode(',', $treatment_ids);
				if (!$treatment_schedules[$id]->save()) {
					throw new HttpException(400, "Не удалось сохранить график лечения");
				}
			}
		}
		
		return $data;
	}
}