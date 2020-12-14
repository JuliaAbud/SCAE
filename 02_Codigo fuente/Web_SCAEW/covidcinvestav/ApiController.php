<?php

namespace app\controllers;

use Yii;
use app\models\Individuo;
use app\models\IndividuoSearch;
use app\models\LoginForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

/**
 * IndividuoController implements the CRUD actions for Individuo model.
 */
class ApiController extends Controller
{
	    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Individuo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndividuoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Individuo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Individuo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Individuo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idindividuo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	public function actionGetcode()
    {
        $model = new Individuo();
		$model->save();
        $model->codigo= Yii::$app->getSecurity()->generatePasswordHash($model->fechacreacion.$model->idindividuo);
		$model->save();
		$jaso["clave"]=$model->codigo;
		return  json_encode($jaso);
    }
	
	public function actionCodigo()
    {
	//	$request = Yii::$app->request;	
//        if ($request->isPost) {
// 			$username = $request->post('username');
// 			$pwd = $request->post('pwd');
// 		    $model = new LoginForm();
// 			$model->username=$username;
// 			$model->password=$pwd;
// 			$model->rememberMe=false;
// 			if ($model->login()) {
// 				$model2 = new Individuo();
// 				$model2->save();
// 				$model2->codigo= Yii::$app->getSecurity()->generatePasswordHash($model2->fechacreacion.$model2->idindividuo);
// 				$model2->save();
// 				$jaso["clave"]=$model2->codigo;
// 			return  json_encode($jaso);
// 			}
// 			else return "Usuario o contraseña incorrectos";
//         }
// 		return "Usuario y contraseña requeridos";
		return "hola";

    }
	
	public function actionCodigo2()
    {
		$model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			$model = new Individuo();
			$model->save();
			$model->codigo= Yii::$app->getSecurity()->generatePasswordHash($model->fechacreacion.$model->idindividuo);
			$model->save();
			$jaso["clave"]=$model->codigo;
			return  json_encode($jaso);
        }
		return "Usuario y contraseña requeridos";

    }

    /**
     * Updates an existing Individuo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idindividuo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Individuo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Individuo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Individuo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Individuo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
