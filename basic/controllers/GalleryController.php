<?php

namespace app\controllers;
use app\models\Album;
use yii\caching\DbDependency;
use Yii;


class GalleryController extends AppController {
    public function filters()
    {
        return array(
            array(
                'COutputCache',
                'duration'=> 3600,
                'varyByParam'=>array('id'),
            ),
        );
    }		
	public function actionIndex() {
        $dependency = new DbDependency([
            'sql' => 'SELECT MAX(updated_at) FROM album',
        ]);
        $gallery = Yii::$app->db->cache(function ($db) {
            return Album::find()->where(['public'=>1])->all();
        }, 0, $dependency);
        $company = $this->getCompany();
		$this->setMeta('Фотогалерея '.$company->name);
		return $this->render('index', compact('gallery'));
	}
	public function actionView($id) {
		$album =  Album::find()->where(['public'=>1])->andWhere(['id'=>$id])->one();
		if (empty($album)) throw new \yii\web\HttpException(404, 'К сожалению такого альбома не найдено.');
        $company = $this->getCompany();
		$this->setMeta('Фотогалерея '.$company->name.', '.$album->name, $album->meta_key, $album->description);
		return $this->render('view', compact('album'));
	}
}