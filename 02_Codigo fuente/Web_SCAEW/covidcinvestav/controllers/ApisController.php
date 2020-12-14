<?php

namespace app\controllers;

use Yii;
use app\models\Individuo;
use app\models\Negocio;
use app\models\Visita;
use app\models\Biometrico;
use app\models\Contagio;
use app\models\Visitas;
use app\models\IndividuoSearch;
use app\models\LoginForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;
/**
 * IndividuoController implements the CRUD actions for Individuo model.
 */
class ApisController extends Controller
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

	public function actionCreatenegociojson()
    {
		Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Negocio();
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->codigo= Yii::$app->getSecurity()->generatePasswordHash($model->fechacreacion.$model->idnegocio);
			$model->save();
			return true;
		}
		return $model->getErrors();
    }
	public function actionCheckin()
    {
		Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Visita();
		$modelLogin = new LoginForm();
		$modelbiometrico= new Biometrico();
		$modelLogin->load(Yii::$app->request->post());
		$modelbiometrico->load(Yii::$app->request->post());
		if($modelLogin->login()){
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				$modelbiometrico->idvisita=$model->idvisita;
				$modelbiometrico->save();
				return $this->findConcurrencia($model->idnegocio);
			}
			else
				return $model->getErrors();
		}
		return $modelLogin->getErrors();
    }
	public function actionAvisocontagio()
    {
		Yii::$app->response->format = Response::FORMAT_JSON;
		$modelLogin = new LoginForm();
		$modelcontagio= new Contagio();
		$modelLogin->load(Yii::$app->request->post());
		$modelcontagio->load(Yii::$app->request->post());
		if($modelLogin->login()){
			if ($modelcontagio->save()) {
				return true;
			}
			else
				return $modelcontagio->getErrors();
		}
		return $modelLogin->getErrors();
    }
	public function actionSeguimientocontacto()
    {
		Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Individuo();
		$modelLogin = new LoginForm();
		$modelLogin->load(Yii::$app->request->post());
		$model->load(Yii::$app->request->post());
		if($modelLogin->login()){
			return $this->findPosiblecontacto($model->codigo);
		}
		return $modelLogin->getErrors();
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
	public function actionHistorial()
    {
		Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Individuo();
		$modelLogin = new LoginForm();
		$modelLogin->load(Yii::$app->request->post());
		$model->load(Yii::$app->request->post());
		if($modelLogin->login()){
			return $this->findHistorial($model->codigo);
		}
		return $modelLogin->getErrors();
    }
	public function actionCodigo()
    {
		$request = Yii::$app->request;	
       if ($request->isPost) {
			$username = $request->post('username');
			$pwd = $request->post('pwd');
		    $model = new LoginForm();
			$model->username=$username;
			$model->password=$pwd;
			$model->rememberMe=false;
			if ($model->login()) {
				$model2 = new Individuo();
				$model2->save();
				$model2->codigo= Yii::$app->getSecurity()->generatePasswordHash($model2->fechacreacion.$model2->idindividuo);
				$model2->save();
				$jaso["clave"]=$model2->codigo;
			return  json_encode($jaso);
			}
			else {
			 Yii::$app->response->format = Response::FORMAT_JSON;
			    
			   return $model->getErrors();
		   }		
        }
		return "Usuario y contraseña requeridos";
    }
	
	public function actionLoginnegocio()
    {
		$request = Yii::$app->request;
		Yii::$app->response->format = Response::FORMAT_JSON;		
       if ($request->isPost) {
			$username = $request->post('username');
			$pwd = $request->post('pwd');
		    $model = new LoginForm();
			$model->username=$username;
			$model->password=$pwd;
			$model->rememberMe=false;
			if ($model->login()) {
				return $model->getUsuario()->negocios;
			}
			else {
			   return $model->getErrors();
		   }			
        }
		return "Usuario y contraseña requeridos";
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

    protected function findModel($id)
    {
        if (($model = Individuo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	protected function findModelnegocio($codigo)
    {
        if (($model = Negocio::find()->where(['codigo' => $codigo])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	function findHistorial($codigo)
    {
		$tablevisitas= new visitas;
       $query = " SELECT visita.idvisita,codigoindividuo,
	   negocio.idnegocio,nombre,fechavisita,biometrico.valor as temperatura
				 FROM visita 
				 INNER JOIN negocio ON visita.idnegocio=negocio.idnegocio
				 inner join biometrico on visita.idvisita=biometrico.idvisita
				 where 
				visita.codigoindividuo='$codigo'";
        $Visitas = $tablevisitas->findBySql($query)->all();

        return $Visitas;
    }
	function findPosiblecontacto($codigo)
    {
		$tablevisitas= new visitas;
		$query = "SELECT visitaconsultada.idvisita,visitaconsultada.codigoindividuo, nombre,
		visitaconsultada.idnegocio,visitaconsultada.fechavisita FROM contagio 
		INNER JOIN visita visitacontagiada ON visitacontagiada.codigoindividuo=contagio.codigoindividuo 
		INNER JOIN visita visitaconsultada ON 
		DATE(visitaconsultada.fechavisita)=DATE(visitacontagiada.fechavisita) 
		AND time(visitaconsultada.fechavisita)>=time(visitacontagiada.fechavisita) 
		INNER JOIN negocio ON visitacontagiada.idnegocio=negocio.idnegocio 
		AND visitaconsultada.idnegocio=visitacontagiada.idnegocio 
		AND visitaconsultada.codigoindividuo<>visitacontagiada.codigoindividuo 
		WHERE date(visitacontagiada.fechavisita)>=date(contagio.fechacontagio) 
		AND visitaconsultada.codigoindividuo='$codigo' ";
		/*GROUP BY visitaconsultada.idvisita,visitaconsultada.codigoindividuo,
		visitaconsultada.idnegocio,visitaconsultada.fechavisita";*/
        $Visitas = $tablevisitas->findBySql($query)->all();

        return $Visitas;
    }
	function findConcurrencia($idnegocio)
    {
		$tablevisitas= new visita;
		$query = "SELECT count(*) as idvisita FROM visita v inner join negocio n on v.idnegocio=n.idnegocio
		where v.idnegocio=$idnegocio and now() between v.fechavisita 
		and  DATE_ADD(v.fechavisita, INTERVAL n.tiempopermanencia MINUTE)";
		$concurrencia = $tablevisitas->findBySql($query)->one();

		return $concurrencia->idvisita;
    }
}
