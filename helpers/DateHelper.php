<?php
namespace app\helpers;

/**
 * Class Date хэлпер даты
 */
class DateHelper
{
	/**
	 * @param string $dateStart Дата начала '2020-03-20'
	 * @param string $dateFinish Дата окончания '2020-03-29'
	 *
	 * @return string[]
	 */
	public static function getDateDaysByRange($dateStart, $dateFinish)
	{
		$dates = [];
		$dtimeStart = strtotime($dateStart);
		$dtimeFinish = strtotime($dateFinish);
		$dtimeModify = $dtimeStart;
		
		while ($dtimeModify <= $dtimeFinish) {
			$dates[] = date('Y-m-d', $dtimeModify);
			$dtimeModify = strtotime('+1 day', $dtimeModify);
		}
		
		return $dates;
	}
}