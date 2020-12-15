<?php

namespace app\controllers;

use Yii;
use app\models\Rubro;
use app\models\RubroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\Expression;

/**
 * RubroController implements the CRUD actions for Rubro model.
 */
class RubroController extends Controller
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
     * Lists all Rubro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RubroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rubro model.
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
     * Creates a new Rubro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rubro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrubro]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rubro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrubro]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionLista($q = null, $id = null) {
		 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		 $out = ['results' => ['id' => '', 'text' => '']];
		 $query=null;
		 if (!is_null($q)) {
			 $query = new Query;
			 $query->select('idrubro as id, nombre AS text')
				 ->from('rubro')
				 ->where('nombre like "%'.$q.'%"')
				 ->orderBy ("nombre") 
				 //->orderBy ([ new Expression ( "FIELD (concepto, '".$q."') " )]) 
				 ->limit(50);
			 $command = $query->createCommand();
			 $data = $command->queryAll();
			 $out['results'] = array_values($data);
		 }
		 return $out;
	 }
	 
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rubro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rubro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rubro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
