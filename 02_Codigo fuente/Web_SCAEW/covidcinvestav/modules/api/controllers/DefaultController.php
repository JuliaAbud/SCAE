<?php
namespace app\modules\api\controllers;

use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
		echo "API";exit;
        
    }
	public function actionView()
    {
		echo "API";exit;
        
    }
	public function actionIniciosesion()
    {
		$request = Yii::$app->request;
		Yii::$app->response->format = Response::FORMAT_JSON;		
       if ($request->isPost) {
			$model = new Negocio();
			$modelLogin = new LoginForm();
			$modelLogin->load(Yii::$app->request->post());
			$model->load(Yii::$app->request->post());
			if ($modelLogin->login()) {
				return $this->findModelnegocio($model->codigo);
			}
			else {
			   return $modelLogin->getErrors();
		   }			
        }
		return "Usuario y contraseña requeridos";
    }

}
