<?php

namespace app\controllers;

use Yii;
use app\models\Respuestasiglesia;
use app\models\Respuestaspresbiterio;
use app\models\Respuesta;
use app\models\Pregunta;
use app\models\RespuestasiglesiaSearch;
use app\models\Iglesia;
use app\models\Distrito;
use app\models\Presbiterio;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Rubro;
use app\models\RubroSearch;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Style;

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
    public function actionReportepresbiterio()
    {
        if (Yii::$app->request->get("id"))
          {
            $searchModel = new RespuestasiglesiaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $id=$_GET["id"];
            $table = new respuestasiglesia;
            $tablepreguntas = new pregunta;
            $modelRubros=$this->findRubros();
            $modeliglesia = $this->findModelByPresbiterio($id);
            
            $k=1;
             $spreadsheet = new Spreadsheet();

            // Set document properties
            $spreadsheet->getProperties()->setCreator('IAFCJ')
                ->setLastModifiedBy('IAFCJ')
                ->setTitle('Office 2007 XLSX Test Document')
                ->setSubject('Office 2007 XLSX Test Document')
                ->setDescription('Document for Office 2007 XLSX.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Test result file');

        foreach ($modelRubros as $rubro) {
            $totales=array();
            $totales["total"]="Total";
            $query = "SELECT * FROM pregunta WHERE idrubro=$rubro->idrubro order by orden";
            $modelpreguntas = $tablepreguntas->findBySql($query)->all();
            $query = "SELECT * FROM respuestasiglesia WHERE idpresbiterio =$id  and idrubro=$rubro->idrubro order by idpregunta";
            $model = $table->findBySql($query)->all();
            $celdas=[];
            $i=0;
            $j=0;
            $celdas[$i]=  array();
            $celdas[$i][$j]='Iglesia';$j++;
               foreach ($modelpreguntas as $rub) {
                $celdas[$i][$j]=$rub->texto;
                $j++;
             }
       $i++;
        foreach ($modeliglesia as $rubi) {
             $j=0;
            $celdas[$i] = array();
            $celdas[$i][$j]=$rubi->nombre;$j++;
                    foreach ($modelpreguntas as $rub) {
                    foreach ($model as $rubp) {
                        if($rubp->idiglesia==$rubi->idiglesia&&$rub->idpregunta==$rubp->idpregunta){
                             
                                    if ($rubp->respuesta!==null)
                                       {
                                          if ($rub->reportable==='SI')  {
                                                if(!isset($totales['_'.$rubp->idpregunta])){
                                                         $totales['_'.$rubp->idpregunta]=0;
                                                         }
                                                if($rub->valor=='decimal'||$rub->valor=='numero'||$rub->valor=='calculable'){
                                                    
                                                    //if(is_numeric($rubp->respuesta)){
                                                        if(isset($totales['_'.$rubp->idpregunta])){
                                                            $totales['_'.$rubp->idpregunta]=$totales['_'.$rubp->idpregunta]+$rubp->respuesta;
                                                        }
                                                        else{
                                                            $totales['_'.$rubp->idpregunta]=$rubp->respuesta;
                                                        }
                                                         $rubp->respuesta=str_replace(".00","",number_format ($rubp->respuesta,2));
                                                   // }*/
                                                }
                                                elseif($rub->valor=='porcentaje')
                                                     {
                                                         
                                                        $totales['_'.$rub->idpregunta]="calcular:".$rub->idpregunta;
                                                       
                                                     }
                                                     elseif($rub->valor=='multiple')
                                                     {
                                                        if ($rubp->respuesta!='NO'&&$rubp->respuesta!='NO APLICA') {
                                                                $totales['_'.$rub->idpregunta]=$totales['_'.$rub->idpregunta]+1;
                                                            }
                                                    } else
                                                            {
                                                                $totales['_'.$rub->idpregunta]="NA";
                                                            }
                                                        }
                                                 else
                                                    {
                                                        $totales['_'.$rubp->idpregunta]="NA";
                                                    }
                                    }
                                $celdas[$i][$j]=$rubp->respuesta;
                              $j++;
                        }   
                     }
                   }
                  $i++; 
               }
               $j=1;

                foreach($totales as $rowt):
                              if (is_numeric((strpos(trim($rowt),'calcular:')))){
                                switch (str_replace("calcular:","", $rowt)) {
                                    case '242':
                                        $valor1= $totales["_3"]+$totales["_4"]+$totales["_5"]+$totales["_6"]+$totales["_7"]+$totales["_8"]+$totales["_9"]+$totales["_10"]+$totales["_11"];
                                        $valor2= $totales["_11"]+$totales["_12"]+$totales["_13"]+$totales["_14"]+$totales["_15"]+$totales["_16"];
                                        $valor3= $totales["_1"];
                                        if($valor3>0)
                                        $valor1=(($valor1-$valor2)*100/$valor3);
                                    else $valor1=0;
                                        $valor1=number_format ($valor1,2);
                                        $celdas[$i][$j]=$valor1." %";
                                        break;
                                    
                                    case '245':
                                        $valor1= $totales["_201"];
                                        $valor2= $totales["_202"];
                                        $valor3=$valor2*100/$valor1;
                                        $valor3=number_format ($valor3,2);
                                        $celdas[$i][$j]=$valor3." %";
                                        break;
                                }
                            }
                            else
                                {
                                if (is_numeric($rowt)){
                                  $rowt= str_replace(".00","",number_format ($rowt,2));
                              }
                                 $celdas[$i][$j]=$rowt;
                             }
                                 $j++;
                           
                            endforeach;
              
            // Add some data

            $spreadsheet->getActiveSheet()
                ->fromArray(
                    $celdas,  // The data to set
                    NULL,        // Array values with this value will not be set
                    'A1'         // Top left coordinate of the worksheet range where
                                 //    we want to set these values (default is A1)
                );
            // Rename worksheet

//$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
/*$spreadsheet->getActiveSheet()->getStyle('B1:AB'.$spreadsheet->getActiveSheet()->getHighestRow())
    ->getAlignment()->setWrapText(true); */

            $spreadsheet->getActiveSheet()->setTitle(substr($rubro->nombre,0,30));
            $spreadsheet->getActiveSheet()
    ->getPageSetup()
    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
$spreadsheet->getActiveSheet()
    ->getPageSetup()
    ->setPaperSize(PageSetup::PAPERSIZE_A4);


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
             $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($k);
           

            // Redirect output to a client’s web browser (Xls)
            $k++;
        }
         $spreadsheet->setActiveSheetIndex(0);
        // $spreadsheet->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Presbiterio.xls"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');
            exit;

        /*    $spreadsheet->save('recursos/'.$_GET["file"]);


               //Si el archivo no se ha podido descargar
               //downloadFile($dir, $file, $extensions=[])
               if (!$this->downloadFile("recursos/", Html::encode($_GET["file"]), ["pdf", "txt", "xls"]))
               {
                //Mensaje flash para mostrar el error
                Yii::$app->session->setFlash("errordownload");
               }*/
              }   
    }
    public function actionReportedistrito()
    {
        if (Yii::$app->request->get("id"))
          {
            $searchModel = new RespuestasiglesiaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $id=$_GET["id"];
            $table = new respuestasiglesia;
            $tablepreguntas = new pregunta;
            $modelRubros=$this->findRubros();
            $modeliglesia = $this->findModelByDistrito($id);
            
            $k=1;
             $spreadsheet = new Spreadsheet();

            // Set document properties
            $spreadsheet->getProperties()->setCreator('IAFCJ')
                ->setLastModifiedBy('IAFCJ')
                ->setTitle('Office 2007 XLSX Test Document')
                ->setSubject('Office 2007 XLSX Test Document')
                ->setDescription('Document for Office 2007 XLSX.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Test result file');

        foreach ($modelRubros as $rubro) {
            $totales=array();
            $totales["total"]="Total";
             $query2 = "SELECT idrespuestasiglesias,
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
    valor_predeterminado,
    rubro,
    if(tipo_dato='decimal' or tipo_dato='numero',sum(respuesta),if(tipo_dato='multiple',GROUP_CONCAT(respuesta),respuesta)) as respuesta,
    iglesia,
    presbiterio,
    distrito FROM respuestaspresbiterio WHERE iddistrito = $id  and idrubro=$rubro->idrubro and reportable='SI' group by idpresbiterio,idpregunta ";
        $model = $table->findBySql($query2)->all();

        $query = "SELECT * FROM pregunta WHERE idrubro=$rubro->idrubro and reportable='SI'order by orden";
        $modelpreguntas = $tablepreguntas->findBySql($query)->all();
            $celdas=[];
            $i=0;
            $j=0;
            $celdas[$i]=  array();
            $celdas[$i][$j]='Iglesia';$j++;
               foreach ($modelpreguntas as $rub) {
                $celdas[$i][$j]=$rub->texto;
                $j++;
             }
       $i++;
        foreach ($modeliglesia as $rubi) {
             $j=0;
            $celdas[$i] = array();
            $celdas[$i][$j]=$rubi->nombre;$j++;
                    foreach ($modelpreguntas as $rub) {
                    foreach ($model as $rubp) {
                        if($rubp->idpresbiterio==$rubi->idpresbiterio&&$rub->idpregunta==$rubp->idpregunta){
                             
                                    if ($rubp->respuesta!==null)
                                       {
                                          if ($rub->reportable==='SI')  {
                                                if(!isset($totales['_'.$rubp->idpregunta])){
                                                         $totales['_'.$rubp->idpregunta]=0;
                                                         }
                                                if($rub->valor=='decimal'||$rub->valor=='numero'||$rub->valor=='calculable'){
                                                    
                                                    //if(is_numeric($rubp->respuesta)){
                                                        if(isset($totales['_'.$rubp->idpregunta])){
                                                            $totales['_'.$rubp->idpregunta]=$totales['_'.$rubp->idpregunta]+$rubp->respuesta;
                                                        }
                                                        else{
                                                            $totales['_'.$rubp->idpregunta]=$rubp->respuesta;
                                                        }
                                                         $rubp->respuesta=str_replace(".00","",number_format ($rubp->respuesta,2));
                                                   // }*/
                                                }
                                                elseif($rub->valor=='porcentaje')
                                                     {
                                                         
                                                        $totales['_'.$rub->idpregunta]="calcular:".$rub->idpregunta;
                                                       
                                                     }
                                                     elseif($rub->valor=='multiple')
                                                     {

                                                        $rubp->respuesta=$this->calcular($rubp->respuesta);
                                    $totales['_'.$rubp->idpregunta]=$totales['_'.$rubp->idpregunta]+$rubp->respuesta;
                                                    } else
                                                            {
                                                                $totales['_'.$rub->idpregunta]="NA";
                                                            }
                                                        }
                                                 else
                                                    {
                                                        $totales['_'.$rubp->idpregunta]="NA";
                                                    }
                                    }
                                $celdas[$i][$j]=$rubp->respuesta;
                              $j++;
                        }   
                     }
                   }
                  $i++; 
               }
               $j=1;

                foreach($totales as $rowt):
                              if (is_numeric((strpos(trim($rowt),'calcular:')))){
                                switch (str_replace("calcular:","", $rowt)) {
                                    case '242':
                                        $valor1= $totales["_3"]+$totales["_4"]+$totales["_5"]+$totales["_6"]+$totales["_7"]+$totales["_8"]+$totales["_9"]+$totales["_10"]+$totales["_11"];
                                        $valor2= $totales["_11"]+$totales["_12"]+$totales["_13"]+$totales["_14"]+$totales["_15"]+$totales["_16"];
                                        $valor3= $totales["_1"];
                                        if($valor3>0)
                                        $valor1=(($valor1-$valor2)*100/$valor3);
                                    else $valor1=0;
                                        $valor1=number_format ($valor1,2);
                                        $celdas[$i][$j]=$valor1." %";
                                        break;
                                    
                                    case '245':
                                        $valor1= $totales["_201"];
                                        $valor2= $totales["_202"];
                                        $valor3=$valor2*100/$valor1;
                                        $valor3=number_format ($valor3,2);
                                        $celdas[$i][$j]=$valor3." %";
                                        break;
                                }
                            }
                            else
                                {
                                if (is_numeric($rowt)){
                                  $rowt= str_replace(".00","",number_format ($rowt,2));
                              }
                                 $celdas[$i][$j]=$rowt;
                             }
                                 $j++;
                           
                            endforeach;
              
            // Add some data

            $spreadsheet->getActiveSheet()
                ->fromArray(
                    $celdas,  // The data to set
                    NULL,        // Array values with this value will not be set
                    'A1'         // Top left coordinate of the worksheet range where
                                 //    we want to set these values (default is A1)
                );
            // Rename worksheet

//$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
/*$spreadsheet->getActiveSheet()->getStyle('B1:AB'.$spreadsheet->getActiveSheet()->getHighestRow())
    ->getAlignment()->setWrapText(true); */

            $spreadsheet->getActiveSheet()->setTitle(substr($rubro->nombre,0,30));
            $spreadsheet->getActiveSheet()
    ->getPageSetup()
    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
$spreadsheet->getActiveSheet()
    ->getPageSetup()
    ->setPaperSize(PageSetup::PAPERSIZE_A4);


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
             $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($k);
           

            // Redirect output to a client’s web browser (Xls)
            $k++;
        }
         $spreadsheet->setActiveSheetIndex(0);
        // $spreadsheet->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Distrito.xls"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');
            exit;

        /*    $spreadsheet->save('recursos/'.$_GET["file"]);


               //Si el archivo no se ha podido descargar
               //downloadFile($dir, $file, $extensions=[])
               if (!$this->downloadFile("recursos/", Html::encode($_GET["file"]), ["pdf", "txt", "xls"]))
               {
                //Mensaje flash para mostrar el error
                Yii::$app->session->setFlash("errordownload");
               }*/
              }   
    }
    function  calcular($valores)
{
    $count=0;
    $array = explode(',', $valores);
    foreach ($array as $values)
    {
        if($values!=='NO'&&$values!=='NO APLICA')$count++;
    }
    return $count;
}
    public function actionRespuestas($id,$idrubro)
    {
        if(isset(Yii::$app->session['usuario']->username))
        if(Yii::$app->session['usuario']->nivel!=0)
        $id= Yii::$app->session['usuario']->idiglesia;

        $searchModel = new RespuestasiglesiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $table = new respuestasiglesia;
        $modelRubros=$this->findRubros();
        //$model = $table->find()->all();


        if($idrubro==0){
         $idrubro=1;
        }
            
       foreach($_POST as $idrespuesta => $valorrespuesta) {
        if(is_numeric ($idrespuesta)){
           $respuesta=  $this->findRespuesta($idrespuesta);
           $respuesta->valor= $valorrespuesta;
         $respuesta->save();
        
        }

        }
        if (!empty($_POST)){
            $id=$_POST["idiglesia"];
            $idrubro=$_POST["idrubro"];
        }
        $query = "SELECT * FROM respuestasiglesia WHERE idiglesia = $id  and idrubro=$idrubro and tipo_dato<>'calculable' and tipo_dato<>'porcentaje' order by idpregunta";
        $model = $table->findBySql($query)->all();

        return $this->render("respuestas", ['modelRubros'=> $modelRubros, 'searchModel' => $searchModel,'idrubro'=>$idrubro, 'dataProvider' => $dataProvider,"model" => $model,"id" => $id]);

    }
    public function actionInforme($id,$idrubro)
    {
        if(isset(Yii::$app->session['usuario']->username))
        if(Yii::$app->session['usuario']->nivel==2)
        $id= Yii::$app->session['usuario']->idpresbiterio;

        $table = new respuestasiglesia;
        $tablepreguntas = new pregunta;
        $modelRubros=$this->findRubros();
        $modeliglesia = $this->findModelByPresbiterio($id);


        if($idrubro==0){
         $idrubro=1;
        }

        if (!empty($_POST)){
            $id=$_POST["idpresbiterio"];
            $idrubro=$_POST["idrubro"];
        }
        $query = "SELECT * FROM respuestasiglesia WHERE idpresbiterio = $id  and idrubro=$idrubro order by idpregunta";
        $model = $table->findBySql($query)->all();

        $query = "SELECT * FROM pregunta WHERE idrubro=$idrubro order by orden";
        $modelpreguntas = $tablepreguntas->findBySql($query)->all();

        return $this->render("informe", ['modelRubros'=> $modelRubros, 'modeliglesia'=>$modeliglesia,'idrubro'=>$idrubro,"model" => $model,"id" => $id,"query"=>$query,'modelpreguntas'=>$modelpreguntas]);

    }
    public function actionInformedistrito($id,$idrubro)
    {
        if(isset(Yii::$app->session['usuario']->username))
            if(Yii::$app->session['usuario']->nivel==1)
        $id= Yii::$app->session['usuario']->idiglesia;
        elseif(Yii::$app->session['usuario']->nivel==2)
        $id= Yii::$app->session['usuario']->idpresbiterio;
        elseif(Yii::$app->session['usuario']->nivel==3)
        $id= Yii::$app->session['usuario']->iddistrito;

        $table = new respuestasiglesia;
        $table = new respuestaspresbiterio;
        $tablepreguntas = new pregunta;
        $modelRubros=$this->findRubros();
        $modelpresbiterio = $this->findModelByDistrito($id);


        if($idrubro==0){
         $idrubro=1;
        }

        if (!empty($_POST)){
            $id=$_POST["iddistrito"];
            $idrubro=$_POST["idrubro"];
        }
        $query2 = "SELECT idrespuestasiglesias,
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
    valor_predeterminado,
    rubro,
    if(tipo_dato='decimal' or tipo_dato='numero',sum(respuesta),if(tipo_dato='multiple',GROUP_CONCAT(respuesta),respuesta)) as respuesta,
    iglesia,
    presbiterio,
    distrito FROM respuestaspresbiterio WHERE iddistrito = $id  and idrubro=$idrubro and reportable='SI' group by idpresbiterio,idpregunta";
        $model = $table->findBySql($query2)->all();

        $query = "SELECT * FROM pregunta WHERE idrubro=$idrubro and reportable='SI'order by orden";
        $modelpreguntas = $tablepreguntas->findBySql($query)->all();

        return $this->render("informeDisitrito", ['modelRubros'=> $modelRubros, 'modelpresbiterio'=>$modelpresbiterio,'idrubro'=>$idrubro,"model" => $model,"id" => $id,'modelpreguntas'=>$modelpreguntas]);

    }
    public function actionInformegeneral($idrubro)
       {
        if(isset(Yii::$app->session['usuario']->username))
        if(Yii::$app->session['usuario']->nivel==2)
        $id= Yii::$app->session['usuario']->idpresbiterio;
        if(Yii::$app->session['usuario']->nivel==3)
        $id= Yii::$app->session['usuario']->iddistrito;

        $table = new respuestasiglesia;
        $table = new respuestaspresbiterio;
        $tablepreguntas = new pregunta;
        $modelRubros=$this->findRubros();
        $modeldistrito = $this->findModelByGeneral();


        if($idrubro==0){
         $idrubro=1;
        }

        if (!empty($_POST)){
            $id=$_POST["idpresbiterio"];
            $idrubro=$_POST["idrubro"];
        }
        $query2 = "SELECT idrespuestasiglesias,
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
        valor_predeterminado,
        rubro, respuesta,
        iglesia,
        presbiterio,
        distrito FROM respuestasdisitrito WHERE idrubro=$idrubro and reportable='SI' group by iddistrito,idpregunta order by idpregunta";
        $model = $table->findBySql($query2)->all();

        $query = "SELECT * FROM pregunta WHERE idrubro=$idrubro and reportable='SI'order by idpregunta";
        $modelpreguntas = $tablepreguntas->findBySql($query)->all();

        return $this->render("informeGeneral", ['modelRubros'=> $modelRubros, 'modeldistrito'=>$modeldistrito,'idrubro'=>$idrubro,"model" => $model,'modelpreguntas'=>$modelpreguntas]);

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
        if (($modelRubros =Rubro::find()->orderBy([
  'idcategoria' => SORT_ASC,
  'orden_aparicion'=>SORT_ASC
])->all()) !== null) {
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
     protected function findModelByPresbiterio($id)
    {
        if (($model = Iglesia::findBySql('SELECT * from iglesia where idpresbiterio='.$id)->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     protected function findModelByDistrito($id)
    {
        if (($model = Iglesia::findBySql('SELECT * from presbiterio where iddistrito='.$id)->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelByGeneral()
    {
        if (($model = Distrito::findBySql('SELECT * from distrito')->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

 protected function findRespuesta($id)
    {
        if (($resp = Respuesta::findOne($id)) !== null) {
            // throw new NotFoundHttpException('se encontro la respuesta .'.$id);
            return $resp;
        }

        throw new NotFoundHttpException('No se encontro la respuesta .'.$id);
    }
}
