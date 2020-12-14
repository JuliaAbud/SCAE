<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->title="Seguimiento de contactos y afluencia de establecimientos";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php //'<img src="'.Yii::$app()->request->baseUrl.'/images/SCAE_50x50.png"/>'
    NavBar::begin([
        //'brandLabel' => 'SCAE',
		'brandLabel' =>"<table><tr><td>".Html::img("/images/SCAE_50x50.png", ['alt'=>'SCAE','width'=>'30','height'=>'30'])."</td><td> &nbsp SCAE</td></tr></table>",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	if(Yii::$app->user->identity->username){
		if(Yii::$app->user->identity->level==1){
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => [
					['label' => 'Inicio', 'url' => ['/site/index']],
					['label' => 'Individuos', 'url' => ['/individuo/index']],
					['label' => 'Negocio', 'url' => ['/negocio/index']],
					['label' => 'Rubro', 'url' => ['/rubro/index']],
					['label' => 'Visitas', 'url' => ['/visita/index']],
					['label' => 'Contagios', 'url' => ['/contagio/index']],
					['label' => 'Usuario', 'url' => ['/users/index']],
					['label' => Yii::$app->user->identity->username,  
					'url' => ['#'],
					'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
					'items' => [
						['label' => 'Modificar contraseña', 'url' => ['/users/updatepwd']],
						'<li>'
						. Html::beginForm(['/site/logout'], 'post')
						. Html::submitButton(
							'Salir' ,
							['class' => 'btn btn-link logout']
						)
						. Html::endForm()
						. '</li>'
						],
						],
				],
			]);
		}
		if(Yii::$app->user->identity->level==0){
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => [
					['label' => 'Inicio', 'url' => ['/site/index']],
					['label' => 'Negocio', 'url' => ['/negocio/index']],
					['label' => Yii::$app->user->identity->username,  
					'url' => ['#'],
					'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
					'items' => [
						['label' => 'Modificar contraseña', 'url' => ['/users/updatepwd']],
						'<li>'
						. Html::beginForm(['/site/logout'], 'post')
						. Html::submitButton(
							'Salir' ,
							['class' => 'btn btn-link logout']
						)
						. Html::endForm()
						. '</li>'
						],
						],
				],
			]);
		}
	}
	else
	echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Ingresar', 'url' => ['/site/login']]
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<style>
#overbox3 {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    z-index: 999999;
    display: block;
}
#infobox3 {
    margin: auto;
    position: relative;
    top: 0px;
    height: 58px;
    width: 100%;
    text-align:center;
    background-color: #eeeeee;
}
#infobox3 p {
    line-height:58px;
    font-size:12px;
    text-align:center;
}
#infobox3 p a {
    margin-right:5px;
    text-decoration: underline;
}
</style>
<div id="overbox3">
    <div id="infobox3">
        <p>Utilizamos cookies propias y de terceros para facilitar su navegación. Al continuar navegando acepta su uso
        <a onclick="aceptar_cookies();" style="cursor:pointer;">X Cerrar</a></p>
    </div>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">Aviso de privacidad</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<b>A. Introducción</b>
<br>
La privacidad de los usuarios de nuestras aplicaciones es muy importante y estamos comprometidos a protegerla. Esta política explica qué haremos con su información personal.
<br>
<b>B. Crédito</b>
<br>
Este documento fue creado usando una plantilla de SEQ Legal (seqlegal.com), modificada por Website Planet (www.websiteplanet.com) y SCAE.
<br>
<b>C. Recopilar información personal</b>
<br>
Los siguientes tipos de información personal pueden ser recopilados, almacenados y usados:
<br>
· información sobre su dispositivo, incluyendo su dirección IP, ubicación geográfica, tipo y versión de navegador, y sistema operativo.
<br>
· información que introduzca al crear una cuenta en nuestra aplicación, como la dirección de correo electrónico.
<br>
· información que introduzca al crear un perfil en Nuestras aplicaciones, por ejemplo, su nombre, foto de perfil, género, cumpleaños, estado civil, intereses y pasatiempos, información sobre formación y empleo.
<br>
· información que introduzca para suscribirse a nuestros correos y boletines, como su nombre y dirección de correo electrónico.
<br>
· información que introduzca mientras usa los servicios en Nuestras aplicaciones.
<br>
· información que se genera mientras usa Nuestras aplicaciones, incluido cuándo, qué tan a menudo y bajo qué circunstancias lo use.
<br>
· información que publique en Nuestras aplicaciones con la intención de que sea publicada en Internet, lo que incluye su nombre de usuario, fotos de perfil y contenido de sus publicaciones.
<br>
· información contenida en cualquiera de las comunicaciones que nos envía a través de correo electrónico o de Nuestras aplicaciones, incluido el contenido de la comunicación y metadatos.
<br>
· cualquier otra información personal que nos envíe.
<br>
Antes de divulgarnos la información personal de otra persona, primero debe obtener el consentimiento de esa persona, tanto para la divulgación como para el procesamiento de esa información personal de acuerdo con esta política;
<br>
<b>D. Usar su información personal</b>
<br>
La información personal que nos envíe a través de Nuestras aplicaciones será usada con los fines especificados en esta política o en las páginas relevantes del sitio web. Podemos usar su información personal para los siguientes fines:
<br>
· administrar Nuestras aplicaciones y negocio.
<br>
· personalizar Nuestras aplicaciones para usted.
<br>
· activar el uso de servicios disponibles en Nuestras aplicaciones.
<br>
· enviarle artículos comprados a través de Nuestras aplicaciones.
<br>
· suministrar servicios comprados a través de Nuestras aplicaciones.
<br>
· enviar comunicaciones comerciales (no de marketing).
<br>
· enviar notificaciones de correo electrónico que ha solicitado específicamente.
<br>
· enviar un boletín de correo electrónico, si usted lo ha solicitado (puede informarnos en cualquier momento si no desea seguir suscrito al boletín).
<br>
· enviar comunicaciones de marketing relacionadas con nuestro negocio, o los negocios de terceros cuidadosamente seleccionados, que consideramos que serán de su interés, por correo postal o donde haya aceptado específicamente a esto, por correo electrónico o tecnologías similares (nos puede informar en cualquier momento si no desea seguir recibiendo las comunicaciones de marketing).
<br>
· dar información estadística a terceros sobre nuestros usuarios (pero esos terceros no podrán identificar a ningún usuario individual con esa información).
<br>
· dar respuesta a las preguntas y quejas suyas o sobre usted, relacionadas con Nuestras aplicaciones.
<br>
· mantener protegido la aplicación y evitar el fraude.
<br>
· verificar el cumplimiento de los términos y condiciones que rigen sobre el uso de Nuestras aplicaciones (incluido la monitorización de mensajes privados a través del servicio de mensajería privada de Nuestras aplicaciones); y otros usos.
<br>
Si usted envía información personal para su publicación en Nuestras aplicaciones, publicaremos y usaremos esa información de conformidad con la licencia que usted nos confiere. Sus ajustes de privacidad pueden usarse para limitar la publicación de nuestra información en Nuestras aplicaciones y puede ajustarse usando controles de privacidad en el sitio web. Sin su consentimiento explícito no proporcionaremos su información personal a ningún tercero para su marketing directo o el de otro tercero.
<br>
<b>E. Divulgar información personal</b>
<br>
Podremos divulgar su información personal a cualquiera de nuestros empleados, oficiales, aseguradores, consejeros profesionales, agentes, proveedores o contratistas, como sea razonablemente necesario para los fines descritos en esta política. Podremos divulgar su información personal a cualquier miembro de nuestro grupo de empresas (esto incluye subsidiarios, nuestro grupo y todas sus subsidiarias), como sea razonablemente necesario para los fines descritos en esta política. Podemos divulgar su información personal:
<br>
· hasta lo que sea requerido por la ley.
<br>
· en relación con cualquier procedimiento legal actual o prospectivo.
<br>
· para establecer, ejercer o defender nuestros derechos legales (incluido proporcionar información personal a otros con el fin de evitar fraudes y reducir el riesgo crediticio).
<br>
· al comprador (o comprador prospectivo) de cualquier negocio o activo que estemos vendiendo o estemos contemplando vender. y
<br>
· a cualquier persona que creamos razonablemente que podrá aplicar a una corte o a otra autoridad competente para solicitar la divulgación de esa información personal, y que, bajo nuestra opinión razonable, dicha corte o autoridad tendrá una probabilidad razonable de ordenar la divulgación de dicha información personal.
<br>
Con excepción de lo establecido por la ley, no proporcionaremos su información personal a terceros.
<br>
<b>F. Transferencia internacional de datos</b>
<br>
La información que recopilamos puede ser almacenada, procesada y transferida entre cualquiera de los países en que operamos, con el fin de permitirnos usar la información de conformidad con esta política. La información que recopilamos puede ser transferida a los siguientes países donde no tenemos leyes de protección de datos equivalentes a las vigentes en el Espacio Económico Europeo: Estados Unidos de América, Rusia, Japón, China e India. La información personal que publique en Nuestras aplicaciones o envíe para su publicación en Nuestras aplicaciones, puede estar disponible a través de Internet, en todo el mundo. No podemos evitar el uso o mal uso de dicha información por parte de otros. Usted acepta explícitamente a las transferencias de información personal descritas en esta sección F.
<br>
<b>G. Conservar información personal</b>
<br>
· Si no se cuenta con una cuenta se mantendrá la información por cuestiones de seguridad y evitar fraudes mientras el departamento de seguridad lo considere necesario.
<br>
· En el caso de tener una cuenta mantendremos su información personal y contribuciones de forma indefinida.
<br>
· En caso de borrar tu cuenta tu información técnica será retenida hasta el tiempo que la ley lo permita.
<br>
· Al borrar tu cuenta tus contribuciones serán borradas con las siguientes excepciones que permanecerán públicas:
<br>
o Descripciones de juego.
<br>
o Mensajes privados enviados a otros usuarios dentro del sistema.
<br>
o Wikis
<br>
o Mensajes en Foros
<br>
o Así como otros contenidos editables.
<br>
<b>H. Seguridad de su información personal</b>
<br>
Tomaremos precauciones razonables técnicas y organizacionales para evitar la pérdida, mal uso o alteración de su información personal. Almacenaremos toda la información personal que nos dé en nuestros servidores seguros (protegidos por contraseña y cortafuegos). Todas las transacciones financieras electrónicas realizadas a través de Nuestras aplicaciones estarán protegidas por tecnología de cifrado. Usted acepta que la transmisión de información en Internet es inherentemente insegura y que no podemos garantizar la seguridad de los datos enviados a través de Internet. Usted es responsable de mantener de forma confidencial la contraseña que use para acceder a Nuestras aplicaciones, y nosotros no le pediremos su contraseña (exceptuando para iniciar sesión en Nuestras aplicaciones).
<br>
<b>I. Enmiendas</b>
<br>
Es posible que actualicemos esta política de vez en cuando al publicar una nueva versión en Nuestras aplicaciones. Usted debe comprobar ocasionalmente esta página para asegurarse de que entiende cualquier cambio a esta política. Es posible que le notifiquemos de cambios a esta política a través de correo electrónico o a través del sistema de mensajería privada de Nuestras aplicaciones.
      </div>
      <div class="modal-footer">
	 <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Cinvestav GDL <?= date('Y') ?></p>
		<p class="pull-right">
		 <a href="#" data-toggle="modal" data-target="#exampleModalLong">
		 Aviso de privacidad</a>
		 </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
function GetCookie(name) {
    var arg=name+"=";
    var alen=arg.length;
    var clen=document.cookie.length;
    var i=0;
 
    while (i<clen) {
        var j=i+alen;
 
        if (document.cookie.substring(i,j)==arg)
            return "1";
        i=document.cookie.indexOf(" ",i)+1;
        if (i==0)
            break;
    }
 
    return null;
}
 
function aceptar_cookies(){
    var expire=new Date();
    expire=new Date(expire.getTime()+7776000000);
    document.cookie="cookies_surestao=aceptada; expires="+expire;
 
    var visit=GetCookie("cookies_surestao");
 
    if (visit==1){
        popbox3();
    }
}
 
$(function() {
    var visit=GetCookie("cookies_surestao");
    if (visit==1){ popbox3(); }
});
 
function popbox3() {
    $('#overbox3').toggle();
}
</script>