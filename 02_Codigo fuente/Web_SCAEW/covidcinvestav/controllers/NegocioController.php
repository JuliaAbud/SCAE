<?php

namespace app\controllers;

use Yii;
use app\models\Negocio;
use app\models\Visitanegocio;
use app\models\NegocioSearch;
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

/**
 * NegocioController implements the CRUD actions for Negocio model.
 */
class NegocioController extends Controller
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
     * Lists all Negocio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NegocioSearch();
		if(Yii::$app->user->identity->level<>1)
		$searchModel->idusers=Yii::$app->user->identity->id;
		//Yii::$app->user->identity->level
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model= new Negocio();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model'=>$model
        ]);
    }

    /**
     * Displays a single Negocio model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
		$qrCode = (new QrCode($model->codigo))
		->setSize(250)
		->setMargin(5)
		->useForegroundColor(00, 00, 00);
		$qrCode->writeFile('qr/negocio/'.$id.'.png');
		$visitas=$this->findVisitas($id);
		$i=0;
		$clickByDeptoCharts= null;
		/*$clickByDeptoCharts[] = [ 'name' => 'Sistemas', 'y' => 1];
		$clickByDeptoCharts[] = [ 'name' => 'Soporte', 'y' => 4];

		$clickByDeptoCharts[] = [ 'name' => 'Administracion', 'y' => 6];*/
		
		foreach($visitas as $visita)
		{
			//if(!in_array($visita->fecha,$categories))
			/*$clickByDeptoChart[$i]["name"]="mama";
			$clickByDeptoChart[$i]["y"] ="5";*/
			$clickByDeptoCharts[$i]["y"]=intval($visita->concurrencia);
			$clickByDeptoCharts[$i]['name']=$visita->fecha." : ".$visita->hora." hrs";
			$i++;
		}
        $searchModel = new NegocioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->Models=$visitas;
		
        return $this->render('view', [
            'model' => $model,'visitas'=>$dataProvider,'clickByDeptoCharts'=>$clickByDeptoCharts
        ]);
    }

    /**
     * Creates a new Negocio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Negocio();
		$model->idusers=Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->codigo= Yii::$app->getSecurity()->generatePasswordHash($model->fechacreacion.$model->idnegocio);
			$model->save();
			return $this->redirect(['view', 'id' => $model->idnegocio]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	
	public function actionUpload()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$model = new Negocio();

		$imageFile = UploadedFile::getInstance($model, 'idnegocio');

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
				$path = '/csv/'. $fileName;
				/*if(!$this->Cargardatos($filePath))
				$response=Json::encode([
				'files' => [
				[
				'name' => "Error",
				'size' => "Error",
				'url' => "Not uploaded",
				],
				],
				]);
				else*/
				return (['files' => [
				[
				'name' => $imageFile->name,
				'size' => $imageFile->size,
				'url' => $path,
				]
				]]);

			}
		}
		else
		return ([
				'files' => [
				[
				'name' => "Error",
				'size' => "Error",
				'url' => "Not uploaded",
				],
				],
				]);
	}
	public function actionCargardatos()
	{
		return $this->Cargardatos("csv/ejemplo.xlsx");
	}
	public function Cargardatos($fileName)
	{
		
		$inputFileType = \PHPExcel_IOFactory::identify($fileName);
		$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($fileName);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		
		$baseRow = 9;
		while($baseRow<=count($sheetData)){//!empty($sheetData[$baseRow]['B'])){
			if(!empty($sheetData[$baseRow]['D'])&&strpos(strtolower((string)($sheetData[$baseRow]['D'])),'urn:epc:raw:96.x')!==false)
			{
				$model = new RfidVsSso();
				$modelb=$this->findModelbyproject_reference((string)$sheetData[$baseRow]['B'],(string)$sheetData[$baseRow]['D']);
				if($modelb==null){
					$model->project_reference = (string)$sheetData[$baseRow]['B'];
					//$model->top_equipment_serial_number = (string)$sheetData[$baseRow]['D'];
					//$model->int_hu_no = (string)$sheetData[$baseRow]['E'];
					$model->tag_rfid =(string)$sheetData[$baseRow]['D'];
					//$model->handling_unit_group_1 = (string)$sheetData[$baseRow]['G'];
					//$model->created_by = (string)$sheetData[$baseRow]['H'];
					//$model->created_on = (string)$sheetData[$baseRow]['I'];
					//$model->time_rfid = (string)$sheetData[$baseRow]['J'];
					//$model->changed_by = (string)$sheetData[$baseRow]['K'];
					$model->chngd_on = (string)$sheetData[$baseRow]['H'];//Sentence
					$model->timeofchng = (string)$sheetData[$baseRow]['I'];//Qty
					$model->function_code = (string)$sheetData[$baseRow]['E'];
					$model->order_number = (string)$sheetData[$baseRow]['J'];
					$model->material = (string)$sheetData[$baseRow]['F'];
					$model->material_number = (string)$sheetData[$baseRow]['G'];
					//$model->subcontracting_so = (string)$sheetData[$baseRow]['R'];
					$model->save();
				}
				//echo $baseRow." | ".count($sheetData[$baseRow])." | ".$sheetData[$baseRow]['B']."<br>";
				$baseRow++;
			}else return false;
		}

		return true;
		// import data with multiple file.


	}
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idnegocio]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionCorreo($id)
    {
        $model=$this->findModel($id);
		$qrCode = (new QrCode($model->codigo))
		->setSize(250)
		->setMargin(5)
		->useForegroundColor(00, 00, 00);
		$qrCode->writeFile('qr/negocio/'.$id.'.png');
		/*$visitas=$this->findVisitas($id);
        $searchModel = new NegocioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->Models=$visitas;*/
		$body="Se adjunta codigo Qr de acceso a la aplicacion SCAE<br>".$model->nombre."<img scr='$id.png'>";
		$resp=$this->EnviarCorreo($model->email,'Qr de acceso',$body,'qr/negocio/'.$id.'.png');
		if(!$resp)
        {
			echo $resp;exit;
		}
		return $this->actionView($id);/*
		return $this->render('view', [
            'model' => $model,'visitas'=>$dataProvider
        ]);*/
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
    protected function findModel($id)
    {
        if (($model = Negocio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
	protected function findVisitas($id)
    {
       
		$tablevisitas= new Visitanegocio;
		$query = "SELECT idnegocio, DATE(visita.fechavisita) as fecha, 
		hour(visita.fechavisita) as hora,COUNT(*) as concurrencia FROM visita 
		where idnegocio=$id 
		GROUP BY idnegocio, DATE(visita.fechavisita),hour(visita.fechavisita)";
		$concurrencia = $tablevisitas->findBySql($query)->all();

		return $concurrencia;
    }
}
