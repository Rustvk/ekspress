<?php

namespace app\modules\admin\components;
use app\modules\admin\models\Employees;
use yii\base\Widget;
// use app\modules\admin\models\CategoriesSearch;
use Yii;

class BirthdayWidget extends Widget{
	public $type; /* Шаблон UL для клиента или select для админа */

	public function init() {
			parent::init();
	}

	public function run() {
		$birthday = Employees::find()->all();
		$i = 0;
		$body = '';
		foreach ($birthday as $days) {
			if ($days->birthday) {
				$today = date('d-m-1970');
				$enddate = date('d-m-1970',strtotime($days->birthday));
				$startdate = date('d-m-1970',strtotime($today));
				$datediff = strtotime($enddate) - strtotime($startdate);
				$totalDays = floor($datediff/(60*60*24));
				if (($totalDays)<=5&&($totalDays>0)) {
					$i++;
					$body .= '
					<li class="hbitem">
					<p>'.$days->name.'</p>
					<p>Осталось дней: '.$totalDays.'</p>
					</li>';
				}
				if ($totalDays==0) {
					$i++;
					$body .= '
					<li class="hbitem red">
					<p>'.$days->name.'</p>
					<p>Необходимо поздравить сегодня!!!
					</li>
					';
				}
			}	
		}
		if ($this->type==1) {
			return $i;
		} 
		elseif ($this->type==2) {
			return $body;	
		}	

	}
}

