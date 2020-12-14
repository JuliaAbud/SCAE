<?php

namespace app\controllers;

use Yii;
use app\models\Informerespuestas;
use app\models\InformerespuestasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


/**
 * InformerespuestasController implements the CRUD actions for Informerespuestas model.
 */
class InformerespuestasController extends Controller
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
     * Lists all Informerespuestas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InformerespuestasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRespuestasiglesia($id)
    {
        /*$searchModel = new InformerespuestasSearch();
        $dataProvider = new ActiveDataProvider([
        'query' => Informerespuestas::find()->where(['idpresbiterio'=>$id])->orderBy('iglesia'),
        ]);*/
        $model=$this->findIglesiasbypresbiterio($id);//Informerespuestas::find()->where(['idpresbiterio'=>$id])->orderBy('iglesia');
        return $this->render('respuestasiglesia', [
        'model'=>$model,'id'=>$id,
        ]);
    }
     public function actionRespuestaspresbiterio($id)
    {
        /*$searchModel = new InformerespuestasSearch();
        $dataProvider = new ActiveDataProvider([
        'query' => Informerespuestas::find()->where(['idpresbiterio'=>$id])->orderBy('iglesia'),
        ]);*/
        $model=$this->findIglesiasbydisitrito($id);//Informerespuestas::find()->where(['idpresbiterio'=>$id])->orderBy('iglesia');
        return $this->render('respuestaspresbiterio', [
        'model'=>$model,'id'=>$id,
        ]);
    }
     public function actionRespuestasdistrito()
    {
        /*$searchModel = new InformerespuestasSearch();
        $dataProvider = new ActiveDataProvider([
        'query' => Informerespuestas::find()->where(['idpresbiterio'=>$id])->orderBy('iglesia'),
        ]);*/
        $model=$this->findIglesiasGeneral();//Informerespuestas::find()->where(['idpresbiterio'=>$id])->orderBy('iglesia');
        return $this->render('respuestasdistrito', [
        'model'=>$model,
        ]);
    }

    /**
     * Displays a single Informerespuestas model.
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
     * Creates a new Informerespuestas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Informerespuestas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idiglesia]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Informerespuestas model.
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

    /**
     * Deletes an existing Informerespuestas model.
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
     * Finds the Informerespuestas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Informerespuestas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Informerespuestas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     protected function findIglesiasbypresbiterio($id)
    {
        if (($model = Informerespuestas::findBySql('SELECT * from informerespuestas where idpresbiterio='.$id)->all()) !== null) {//->where(['idiglesia'=>$id])->asArray()
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findIglesiasbydisitrito($id)
    {
        if (($model = Informerespuestas::findBySql('SELECT idrespuestasiglesias,
    idevaluacion,
    idevaluacion_detalle,
    idpregunta,
    idrubro,
    idrespuesta,
    idiglesia,
    idpresbiterio,
    iddistrito,
    fecha_limite,
    evaluacion,
    pregunta,
    tipo_dato,
    presbitero,
    valor_predeterminado,
    rubro,
    respuesta,
    iglesia,
    presbiterio,
    distrito,
    estado,
    pastor,
    sum(preguntas_respondidas) as preguntas_respondidas,
    sum(total_preguntas) as total_preguntas from informerespuestas where iddistrito='.$id.' group by idpresbiterio')->all()) !== null) {//->where(['idiglesia'=>$id])->asArray()
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     protected function findIglesiasGeneral()
    {
               if (($model = Informerespuestas::findBySql('SELECT idrespuestasiglesias,
    idevaluacion,
    idevaluacion_detalle,
    idpregunta,
    idrubro,
    idrespuesta,
    idiglesia,
    idpresbiterio,
    iddistrito,
    fecha_limite,
    evaluacion,
    pregunta,
    tipo_dato,
    presbitero,
    valor_predeterminado,
    rubro,
    respuesta,
    iglesia,
    presbiterio,
    distrito,
    obispo,
    estado,
    pastor,
    sum(preguntas_respondidas) as preguntas_respondidas,
    sum(total_preguntas) as total_preguntas from informerespuestas group by iddistrito')->all()) !== null) {//->where(['idiglesia'=>$id])->asArray()
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
