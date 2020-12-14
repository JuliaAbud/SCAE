<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\FormRegister;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\Query;
use yii\db\Expression;
use PHPMailer\PHPMailer\PHPMailer;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
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
		/*if(!isset(Yii::$app->session['usuario']->nivel)||Yii::$app->session['usuario']==null){
		   header("Location: index.php?r=site/login");
        exit;
		}
		if(Yii::$app->session['usuario']->nivel!=1)
			{
		   header("Location: index.php");
        exit;
		}*/
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionLista($q = null, $id = null) {
		 Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		 $out = ['results' => ['id' => '', 'text' => '']];
		 $query=null;
		 if (!is_null($q)) {
			 $query = new Query;
			 $query->select('id as id, username AS text')
				 ->from('users')
				 ->where('username like "%'.$q.'%"')
				 ->orderBy ("username") 
				 //->orderBy ([ new Expression ( "FIELD (concepto, '".$q."') " )]) 
				 ->limit(50);
			 $command = $query->createCommand();
			 $data = $command->queryAll();
			 $out['results'] = array_values($data);
		 }
		 return $out;
	 }
    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		if(!isset(Yii::$app->session['usuario'])){
		 		   header("Location: index.php?r=site/login");
        exit;
		}
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
		if(!isset(Yii::$app->session['usuario']->nivel)||Yii::$app->session['usuario']==null){
		   header("Location: index.php?r=site/login");
        exit;
		}
		if(Yii::$app->session['usuario']->nivel!=1)
			{
		   header("Location: index.php");
        exit;
		}
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
		if(!isset(Yii::$app->session['usuario']->nivel)||Yii::$app->session['usuario']==null){
		   header("Location: index.php?r=site/login");
        exit;
		}
		if(Yii::$app->session['usuario']->nivel!=1)
			{
		   header("Location: index.php");
        exit;
		}
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
			if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
		else{
			echo print_r($model->getErrors());
			exit;
		}
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
	 public function actionUpdatepwd()
    {
		if(!Yii::$app->user->identity->username)
		{
		header("Location: index.php?r=site/login");
        exit;
		}
		$modelRegister =new FormRegister();
		$model= new Users();
		$model = $this->findModel(Yii::$app->user->identity->id);
        if ($modelRegister->load(Yii::$app->request->post())) {
			$model->password= crypt($modelRegister->password, Yii::$app->params["salt"]);
			$model->authKey = $this->randKey("abcdef0123456789", 200);
			$model->accessToken = $this->randKey("abcdef0123456789", 200);
			
			if($model->save())
							return $this->render('/site/index');
			else{
				return $this->render('updatepwd', [
				'model' => $modelRegister,
			]);
			}
		}
		else
		{
			$modelRegister->username=$model->username;
			return $this->render('updatepwd', [
            'model' => $modelRegister,
        ]);
		}
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
		if(!isset(Yii::$app->session['usuario'])){
		 		   header("Location: index.php?r=site/login");
        exit;
		}
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

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
 
 private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 public function actionConfirm()
 {
	
		
    $table = new Users;
    if (Yii::$app->request->get())
    {
   
        //Obtenemos el valor de los parámetros get
        $id = Html::encode($_GET["im"]);
        $authKey = $_GET["passgen"];
        if ((int) $id)
        {
            //Realizamos la consulta para obtener el registro
            $model =$this->findModel($id);
			$authKey=urldecode($authKey);
            if ($model->authKey==$authKey&&$model->activate=="0")
            {
                $model->activate = 1;
                if ($model->save())
                {
                    echo "Su usuario ha sido activado correctamente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='10; ".Url::toRoute("site/login")."'>";
                exit;
				}
                else
                {
                    echo "No se activo el usuario, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='10; ".Url::toRoute("site/login")."'>";
                exit;
				}
             }
            else //Si no existe redireccionamos a login
            {
               echo "Datos invalidos, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='10; ".Url::toRoute("site/login")."'>";
				   exit;
            }
        }
        else //Si id no es un número entero redireccionamos a login
        {
          echo "Link invalido, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
exit;
        }
    }
 }
 
public function actionRegister()
 {
  //Creamos la instancia con el model de validación
  $model = new FormRegister;
   
  //Mostrará un mensaje en la vista cuando el usuario se haya registrado
  $msg = null;
   
  //Validación mediante ajax
  if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
			echo  "no ajax";
			exit;
            return ActiveForm::validate($model);
        }
   
  //Validación cuando el formulario es enviado vía post
  //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
  //También previene por si el usuario tiene desactivado javascript y la
  //validación mediante ajax no puede ser llevada a cabo
  if ($model->load(Yii::$app->request->post()))
  {
    //Preparamos la consulta para guardar el usuario
    $table = new Users;
    $table->username = $model->username;
    $table->email = $model->email;
	 $table->name = $model->name;
    //Encriptamos el password
    $table->password = crypt($model->password, Yii::$app->params["salt"]);
    //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
    //clave será utilizada para activar el usuario
    $table->authKey = $this->randKey("abcdef0123456789", 200);
    //Creamos un token de acceso único para el usuario
    $table->accessToken = $this->randKey("abcdef0123456789", 200);
     
    //Si el registro es guardado correctamente
	if(!$model->username_existe($model->username,Yii::$app->request->queryParams))
	{
    if ($table->save())
    {
     //Nueva consulta para obtener el id del usuario
     //Para confirmar al usuario se requiere su id y su authKey
     //$user = $table->find()->where(["email" => $model->email])->one();
     $id =urlencode($table->id); //urlencode($user->id);
     $authKey =$table->authKey;
     //Enviamos el correo
     
     $subject = "Confirmar registro";
     $body = "<h1>Haga click en el siguiente enlace para finalizar su registro en SCAE<br></h1>";
     $body .= "<a href='https://www.covidcinvestav.com/index.php?r=users/confirm&im=$id&passgen=$authKey'>Confirmar</a>";
     $to=$model->email;
     $model->username = null;
	 $model->name = null;
     $model->email = null;
     $model->password = null;
     $model->password_repeat = null;
	 $msg = "Usuario registrado exitosamente<br>Se envio un correo para su activacion<br>(Revisar bandeja de spam)";
	 
	 $this->EnviarCorreo($to, $subject,$body,null);

	 
    }
    else
    {
     $msg = "Ha ocurrido un error al llevar a cabo tu registro";
    }
	}
	else
    {
     $msg = "El usuario ya existe";
    }
   }
  return $this->render("register", ["model" => $model, "msg" => $msg]);
 }	
 protected function EnviarCorreo($to, $subject,$body,$file)
	{
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host =  Yii::$app->params['Host'];
		$mail->SMTPAuth =  Yii::$app->params['SMTPAuth'];
		$mail->Username =  Yii::$app->params['Username'];
		$mail->Password =  Yii::$app->params['Password'];
		//$mail->SMTPSecure = 'tls';
		$mail->Port = Yii::$app->params['Port'];
		$mail->setFrom(Yii::$app->params['adminEmail'], 'Administracion SCAE');
		$mail->addAddress($to);
		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mail->Body = $body;
		if($file)
		$mail->addAttachment($file);
		//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
		if($mail->send())return true;
		return $mail->ErrorInfo;
	}
 
}
