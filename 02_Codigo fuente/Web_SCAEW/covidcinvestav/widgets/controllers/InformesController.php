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
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii2tech\spreadsheet\Spreadsheet;

class InformesController extends Controller
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
    public function actionDescargarevaluacion($id)
    {
        if(isset(Yii::$app->session['usuario']->username))
        if(Yii::$app->session['usuario']->nivel!=0)
        $id= Yii::$app->session['usuario']->idiglesia;

        $searchModel = new RespuestasiglesiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $modeliglesia=Iglesia::findOne($id);
$modelRubros=$this->findRubros();
        $exporter = (new Spreadsheet([
            'title' => 'Datos Iglesia',
            'dataProvider' => new ActiveDataProvider([
                'query' => Iglesia::find()->andWhere(['idiglesia' => $id]),
            ]),
            'columns' => [
               ['attribute'=>'nombre'],
				['attribute'=>'pastor'],
				['attribute'=>'fecha_nacimiento'],
				['attribute'=>'estado_civil'],
				['attribute'=>'col_pastor'],
				['attribute'=>'calle_pastor'],
				['attribute'=>'numero_pastor'],
				['attribute'=>'correo_pastor'],
				['attribute'=>'tel_pastor'],
				['attribute'=>'col_templo'],
				['attribute'=>'calle_templo'],
				['attribute'=>'numero_templo'],
				['attribute'=>'cp_templo'],
				['attribute'=>'municipio_templo'],
				['attribute'=>'estado_templo'],
				['attribute'=>'col_pastoral'],
				['attribute'=>'calle_pastoral'],
				['attribute'=>'numero_pastoral'],
				['attribute'=>'cp_pastoral'],
				['attribute'=>'municipio_pastoral'],
				['attribute'=>'estado_pastoral'],
				['attribute'=>'domicilio_correspondencia'],
				['attribute'=>'pagina_web'],

            ],
        ]))->render(); // call `render()` to create a single worksheet

        foreach ($modelRubros as $rubro) {
            # code...
        
        $exporter->configure([ // update spreadsheet configuration
            'title' =>substr($rubro->nombre,0,30),
            'dataProvider' => new ActiveDataProvider([
                'query' => Respuestasiglesia::find()->andWhere(['idiglesia' => $id])->andWhere(['idrubro' => $rubro->idrubro])->orderBy(["ordenpregunta"=>SORT_DESC]),

               
            ]), 'columns' => [
                [
                    'attribute' => 'pregunta',
                ],
                [
                    'attribute' => 'respuesta',
                ],
            ],
        ])->render(); // call `render()` to create a single worksheet
        }
        $exporter->save('recursos/Evaluacion'.$id.'.xls');
       //Si el archivo no se ha podido descargar
       //downloadFile($dir, $file, $extensions=[])
       if (!$this->downloadFile("recursos/", Html::encode('Evaluacion'.$id.'.xls'), ["pdf", "txt", "xls"]))
       {
        //Mensaje flash para mostrar el error
        Yii::$app->session->setFlash("errordownload");
       }
       
        
        return $this->render("respuestas", ['modelRubros'=> $modelRubros, 'searchModel' => $searchModel,'idrubro'=>$idrubro, 'dataProvider' => $dataProvider,"model" => $model,"id" => $id]);

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
