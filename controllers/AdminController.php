<?php
namespace app\controllers;

use Yii;
#use yii\filters\AccessControl;
#use app\models\LoginForm;
#use yii\data\Pagination;
#use app\models\Admin;
use yii\web\Controller;
use app\helpers\AdminHelper;
class AdminController extends Controller
{
    #Login Functionality
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['dashboard']);
        }
        $model = new AdminHelper();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['dashboard']);
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    #Dashboard
    public function actionDashboard(){
        if (!Yii::$app->user->isGuest) {
            return $this->render('dashboard');
        }
        else{
            $model = new AdminHelper();
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    #Logout
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}