<?php

namespace app\controllers;

use Yii;
use app\models\Respuestasiglesia;
use app\models\RespuestasiglesiaSearch;
use app\models\Iglesia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Rubro;
use app\models\RubroSearch;

/**
 * RespuestasiglesiaController implements the CRUD actions for Respuestasiglesia model.
 */
class RespuestasiglesiaController extends Controller
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
     * Lists all Respuestasiglesia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RespuestasiglesiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionRespuestas($id,$idrubro)
    {
        $searchModel = new RespuestasiglesiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $table = new respuestasiglesia;
        $modelRubros=$this->findRubros();
        //$model = $table->find()->all();


        if($idrubro==0)
        $idrubro=1;
        $query = "SELECT * FROM respuestasiglesia WHERE idiglesia = $id  and idrubro=$idrubro";
        $model = $table->findBySql($query)->all();

        return $this->render("respuestas", ['modelRubros'=> $modelRubros, 'searchModel' => $searchModel,'idrubro'=>$idrubro, 'dataProvider' => $dataProvider,"model" => $model,"id" => $id]);
    
    }

    /**
     * Displays a single Respuestasiglesia model.
     * @param string $id
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
     * Creates a new Respuestasiglesia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Respuestasiglesia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrespuestasiglesias]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Respuestasiglesia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrespuestasiglesias]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Respuestasiglesia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Respuestasiglesia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Respuestasiglesia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Respuestasiglesia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     protected function findIglesias($id)
    {
        if (($model = Respuestasiglesia::findBySql('SELECT * from Respuestasiglesia where Idiglesia='.$id)->all()) !== null) {//->where(['idiglesia'=>$id])->asArray()
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     protected function findRubros()
    {
        if (($modelRubros =Rubro::find()->all()) !== null) {
            return $modelRubros;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelIglesia($id)
    {
        if (($model = Iglesia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
