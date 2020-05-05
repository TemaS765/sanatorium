<?php

namespace app\controllers;

use app\models\Housing;
use app\models\HousingScheme;
use app\models\Order;
use yii\web\Controller;

/**
 * Class HousingSchemeController Схемы корпусов
 * @package app\controllers
 */
class BookingController extends Controller
{
	/**
	 * Отобразить рассписание бронирования
	 */
	public function actionView()
	{
		$params = \Yii::$app->request->getBodyParams();
		$date_from = $params['date_from'] ?? date('Y-m-d');
		$date_to = $params['date_to'] ?? date('Y-m-d');
		
		$housingScheme = HousingScheme::find()->all();
		$housings = Housing::find()->all();
		$scheduleBooking = [];
		/** @var HousingScheme $hs */
		foreach ($housingScheme as $hs) {
			$scheduleBooking[$hs->housing_id][$hs->room] = [
				'capacity_room' => (int) $hs->room_type,
				'reserved_seats' => 0
			];
		}
		/** @var Order[] $orders */
		$orders = Order::find()->where(
			'(departure_date >= :date_to and arrival_date < :date_to) OR '.
			'(arrival_date >= :date_from and arrival_date <= :date_to)',
			[
				':date_from' => $date_from,
				':date_to' => $date_to
			]
		)->all();
		
		foreach ($orders as $order) {
			$scheduleBooking[$order->housing_id][$order->room]['reserved_seats']++;
		}
		return $this->renderPartial('view', ['scheduleBooking' => $scheduleBooking, 'housings' => $housings]);
	}
}