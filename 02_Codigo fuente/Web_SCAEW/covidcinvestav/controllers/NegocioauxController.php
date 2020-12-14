<?php

namespace app\controllers;

use Yii;
use app\models\Negocio;
use app\models\Visitanegocio;
use app\models\Negocioaux;
use app\models\NegocioauxSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\QrCode\QrCode;
use PHPMailer\PHPMailer\PHPMailer;
use dosamigos\fileupload\FileUploadUI;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\helpers\Json;
use yii2tech\spreadsheet\Spreadsheet;
use PHPExcel\Classes\PHPExcel;
use PHPExcel\Classes\PHPExcel\IOFactory;
/**
 * NegocioauxController implements the CRUD actions for Negocioaux model.
 */
class NegocioauxController extends Controller
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
     * Lists all Negocioaux models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NegocioauxSearch();
		if(Yii::$app->user->identity->level<>1)
				$searchModel->idusers=Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model= new Negocioaux();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model'=>$model,
        ]);
    }
	public function actionTransferirdatos()
	{
		$this->findTransferirauxiliatres(Yii::$app->user->identity->id);
		$searchModel = new NegocioauxSearch();
		if(Yii::$app->user->identity->level<>1)
				$searchModel->idusers=Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model= new Negocioaux();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model'=>$model,
        ]);
	}
    /**
     * Displays a single Negocioaux model.
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
     * Creates a new Negocioaux model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Negocioaux();

		$model->idusers=Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idnegocioaux]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

   public function actionUpload()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$model = new Negocioaux();

		$imageFile = UploadedFile::getInstance($model, 'idnegocioaux');

		$directory ="csv/";
		if (!is_dir($directory)) {
			FileHelper::createDirectory($directory);
		}
		
		if ($imageFile) {
			$uid =$imageFile->name;// uniqid(time(), true);
			$fileName = $uid ;//. '.' . $imageFile->extension;
			$filePath = $directory . $fileName;
			if(strpos(strtoupper($imageFile->extension),'XLS')!==false)
			if ($imageFile->saveAs($filePath)) {
				$path = 'csv/'. $fileName;
				$result=$this->Cargardatos($path);
				if($result!="true")
					return ([
				'files' => [
				[
				'name' => $result,
				'size' => "Error",
				'url' => "Formato incorrecto",
				],
				],
				]);
				return (['files' => [
				[
				'name' => $imageFile->name,
				'size' => $imageFile->size,
				'url' => $path,
				]
				]]);

			}
			else
				([
				'files' => [
				[
				'name' => "Error al guardar",
				'size' => "Error",
				'url' => "Not uploaded",
				],
				],
				]);
		}
		else
		return ([
				'files' => [
				[
				'name' => "Error al recibir",
				'size' => "Error",
				'url' => "Not uploaded",
				],
				],
				]);
	}
	public function actionCargardatos()
	{
		return $this->Cargardatos("csv/dataset_places2.xlsx");
	}
	public function Cargardatos($fileName)
	{
		//Yii::$app->response->format = Response::FORMAT_JSON;
		require_once(Yii::getAlias('@vendor/phpoffice/phpexcel/Classes/PHPExcel.php'));
		
		$objPHPExcel = new \PHPExcel;
		$inputFileType = \PHPExcel_IOFactory::identify($fileName);
		$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($fileName);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		/*
		nombre
		codigoactividad
		aforo
		tiempopermanencia
		calle
		numero
		colonia	cp
		entidad	municipio
		latitud	longitud
		correo

		*/
		$baseRow = 1;

		
		if(empty($sheetData[$baseRow]['A'])||$sheetData[$baseRow]['A']!="nombre")
			return "La columna A no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['B'])||$sheetData[$baseRow]['B']!="codigoactividad")
			return "La columna B no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['C'])||$sheetData[$baseRow]['C']!="aforo") 
			return "La columna C no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['D'])||$sheetData[$baseRow]['D']!="tiempopermanencia")
			return "La columna D no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['E'])||$sheetData[$baseRow]['E']!="calle") 
			return "La columna E no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['F'])||$sheetData[$baseRow]['F']!="numero") 
			return "La columna F no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['G'])||$sheetData[$baseRow]['G']!="colonia") 
			return "La columna G no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['H'])||$sheetData[$baseRow]['H']!="cp") 
			return "La columna H no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['I'])||$sheetData[$baseRow]['I']!="entidad")
			return "La columna I no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['J'])||$sheetData[$baseRow]['J']!="municipio") 
			return "La columna J no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['K'])||$sheetData[$baseRow]['K']!="latitud") 
			return "La columna K no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['L'])||$sheetData[$baseRow]['L']!="longitud")
			return "La columna L no contiene el formato establecido";
		if(empty($sheetData[$baseRow]['M'])||$sheetData[$baseRow]['M']!="correo") 
			return "La columna M no contiene el formato establecido";
		$baseRow = 2;
		while($baseRow<=count($sheetData)){
			 $model = new Negocioaux();
			 
			$model->nombre=(string)$sheetData[$baseRow]['A'];
			$model->codigoactividad=(string)$sheetData[$baseRow]['B'];
			$model->aforo=(string)$sheetData[$baseRow]['C'];
			$model->tiempopermanencia=(string)$sheetData[$baseRow]['D'];
			$model->calle=(string)$sheetData[$baseRow]['E'];
			$model->numero=(string)$sheetData[$baseRow]['F'];
			$model->colonia=(string)$sheetData[$baseRow]['G'];
			$model->cp=(string)$sheetData[$baseRow]['H'];
			$model->entidad=(string)$sheetData[$baseRow]['I'];
			$model->municipio=(string)$sheetData[$baseRow]['J'];
			$model->latitud=(string)$sheetData[$baseRow]['K'];
			$model->longitud=(string)$sheetData[$baseRow]['L'];
			$model->email=(string)$sheetData[$baseRow]['M'];
			$model->idusers=Yii::$app->user->identity->id;
			if(!$model->save())
				echo $model->getErrors()."<br>";
			else{
				$model->codigo= Yii::$app->getSecurity()->generatePasswordHash($model->nombre.getdate().$model->idnegocioaux);
			$model->save();
			}
			//echo $baseRow." | ".count($sheetData[$baseRow])." | ".$sheetData[$baseRow]['B']."<br>";
				$baseRow++;
		}
		return "true";
	}
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idnegocioaux]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Negocioaux model.
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

     private function downloadFile($dir, $file, $extensions=[])
 {
  //Si el directorio existe
  if (is_dir($dir))
  {
   //Ruta absoluta del archivo
   $path = $dir.$file;
   
   //Si el archivo existe
   if (is_file($path))
   {
    //Obtener información del archivo
    $file_info = pathinfo($path);
    //Obtener la extensión del archivo
    $extension = $file_info["extension"];
    
    if (is_array($extensions))
    {
     //Si el argumento $extensions es un array
     //Comprobar las extensiones permitidas
     foreach($extensions as $e)
     {
      //Si la extension es correcta
      if ($e === $extension)
      {
       //Procedemos a descargar el archivo
       // Definir headers
       $size = filesize($path);
       header("Content-Type: application/force-download");
       header("Content-Disposition: attachment; filename=$file");
       header("Content-Transfer-Encoding: binary");
       header("Content-Length: " . $size);
       // Descargar archivo
       readfile($path);
       //Correcto
       return true;
      }
     }
    }
    
   }
  }
  //Ha ocurrido un error al descargar el archivo
  return false;
 }
 
	 public function actionDescargarformato()
	 {
	   //Si el archivo no se ha podido descargar
	   //downloadFile($dir, $file, $extensions=[])
	   if (!$this->downloadFile("csv/ejemplo/", "dataset_places_format.xlsx", ["xlsx"]))
	   {
		//Mensaje flash para mostrar el error
		Yii::$app->session->setFlash("errordownload");
	   }

	  return $this->render("download");
	 }
    protected function findModel($id)
    {
        if (($model = Negocioaux::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	function findTransferirauxiliatres($iduser)
    {$query = " insert into negocio(codigo,nombre,descripcion,aforo,tiempopermanencia,
		calle,numero,colonia,cp,latitud,longitud,idmunicipio,idrubro,idusers,email) 
		SELECT codigo,nombre,codigoactividad,aforo,tiempopermanencia,calle,numero,colonia,
		cp,latitud,longitud,idmunicipio,idrubro,idusers,email FROM negocioaux WHERE idusers=$iduser;  
		delete from negocioaux where idusers=$iduser";
		Yii::$app->db->createCommand("$query")->execute();
		/*$tablevisitas= new Negocioaux;
       
        $Visitas = $tablevisitas->findBySql($query)->one();

        return $Visitas;*/
    }
}
