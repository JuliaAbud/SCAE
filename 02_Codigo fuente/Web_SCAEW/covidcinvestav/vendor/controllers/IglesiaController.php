<?php

namespace app\controllers;

use Yii;
use app\models\Iglesia;
use app\models\IglesiaSearch;
use app\models\Cuestionario;
use app\models\CuestionarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IglesiaController implements the CRUD actions for Iglesia model.
 */
class IglesiaController extends Controller
{
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
     * Lists all Iglesia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IglesiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Iglesia model.
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
    public function actionConfirm($id)
    {
        return $this->render('actualizar', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Iglesia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Iglesia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idiglesia]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Iglesia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idiglesia]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
     public function actionActualizar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect( ['respuestasiglesia/respuestas', 'id' => $model->idiglesia,'idrubro' => 0]);
        }

        return $this->render('actualizar', ['id' => $model->idiglesia,
            'model' => $model,
        ]);
    }

 public function actionResponder($id)
    {
       // $model = $this->findModel($id);
        $model = Cuestionario::findOne($id);


        return $this->render('/cuestionario/index', [
            'model' => $model,
        ]);
    }
     public function actionLogin()
    {
        return $this->render('login');
    }

    /**
     * Deletes an existing Iglesia model.
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
     * Finds the Iglesia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Iglesia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Iglesia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
