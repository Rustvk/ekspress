<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
   
	public function actionLogout()
	{
	Yii::$app->user->logout();
	return $this->redirect(Yii::$app->user->loginUrl);
	}
	    public function beforeAction($action)
		{
		if (parent::beforeAction($action)) {
		// change layout for error action
		if ($action->id=='login')
		$this->layout = 'login';
		return true;
		} else {
		return false;
		}
		}
	}
