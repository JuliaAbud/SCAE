<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionLogin()
    {
          $table = new users;
          if ((Yii::$app->request->post())) {
            $request = Yii::$app->request;
         $username = $request->post('username');
         $password = $request->post('password');
        $query = "SELECT * FROM users WHERE username= '$username'  and password='$password'";
        $model = $table->findBySql($query)->all();
        if(empty($model))
            return $this->redirect(['login']);
        Yii::$app->session['usuario']= $model[0];
        if( $model[0]->nivel==0){
           return $this->redirect( ['informerespuestas/respuestasdistrito']);
        }
        elseif( $model[0]->nivel==1){
           return $this->redirect( ['iglesia/actualizar', 'id' => $model[0]->idiglesia]);
        }
        elseif( $model[0]->nivel==2){
           return $this->redirect( ['informerespuestas/respuestasiglesia', 'id' => $model[0]->idpresbiterio]);
          }
          elseif( $model[0]->nivel==3){
           return $this->redirect( ['informerespuestas/respuestaspresbiterio', 'id' => $model[0]->iddistrito]);
          }
      }
         $model = new Users();
        return $this->render('login', [
            'model' => $model,
       ]);
    
    }
    public function actionLogout()
    {
        Yii::$app->session->close();
        Yii::$app->session->destroy();
        unset(Yii::$app->session['usuario']);
        return $this->redirect('index.php?r=users/login');
    }
    public function actionValidar()
    {
        
         $request = Yii::$app->request;
         $username = $request->post('username');
         $password = $request->post('password');
        $query = "SELECT * FROM users WHERE username= $username  and password=$password";
        $model = $table->findBySql($query)->all();
        if(empty($model))
            return $this->redirect(['login']);
        session_start();
        Yii::app()->getSession()->add('usuario',  $model[0]);
           return $this->redirect( ['iglesia/actualizar', 'id' => $model[0]->idiglesia]);
       }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
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
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
