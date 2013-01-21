<?


        /*< PAGINA ROOT*/
        define("_URLPAGE","http://localhost/~oborja/gitSHEWEB/paginaweb/paginaweb/html/");
       
        define('_URLHOST','http://localhost/~oborja/gitSHEWEB/paginaweb/paginaweb/html/');
        
        //recaptchakey
        define('_RECAPTCHAPUBLICKEY','6LdoR9USAAAAAF3Q1NJOWAg7yOL1FsyvAjTcEzNw');
        define('_RECAPTCHAPRIVATEKEY','6LdoR9USAAAAACDp0rEwM6xgnv5LYvckEmL-F6P2');
        
        /**********ESTADOS DE REGISTROS EN LA DB **************/
        define('_ACTIVO','activo');
        define('_INACTIVO','inactivo');
        
        
        /*< PATH ONIX FILE */
        define("_ONIXFILE",'http://127.0.0.1/onixtest/20120314-completa-papel.xml');
        
        /*< DATABASE CONFIGURATION */
	define('_DBHOST','127.0.0.1');
	define('_DBUSER','root');
	define('_DBPASSWD','pepelon2012');
        define('_DBCATALOG','sheweb');
	//define('_DBCATALOG','tirant');  ///BASE DE DATOS SIGLO WEB
        
        define('_DATABASE',"odbc:tirant"); /*<Parametro solo para coneion odbc a catalogo */
        
        define('_DATABASEWEB',"odbc:store");
        define('_DATABASEWEBPASSW','alleatisdh');
        
        
        define('_CONECCION',"mysql:host="._DBHOST.";dbname="._DBCATALOG);
	/*< DEFINE PARAMETROS DE BUSQUEDA POR DEFAULT*/
        define('_DEFAULTLIMIT',12);
        define('_DEFAULTOFFSET',0);
        define('_DEFAULTPAGE',0);
        
	/*< DEFINE CONSTANTS */
	define('_URLCATALOG','http://www.tirant.com/catalogo/catalogo_ebooks.txt');/*<Catalogo Tirant */
        
        define('_SIGLOEMAIL','oborja@siglodelhombre.com');
        
        define('_SIZEPASSWORD',6);
	define('_TITULOSEARCH','Titulo');
        define('_TITULO','Titulo');
	define('_AUTOR','Autor');
	define('_PRECIO_MENOR_MAYOR','Precio menor al mayor');
	define('_PRECIO_MAYOR_MENOR','Precio mayor al menor');
	define('_FECHA_PUBLICACION','Fecha');
	define('_MATERIA','Tema');
	define('_KEYWORDS','Palabras clave');
	define('_ISBN','Isbn');
	define('_FILTROS_TITULO','Fitrar por');
	define('_SORT_BY_TITULO','Organizar por');
	define('_LIMIT_TITULO','Mostrar');
        define('_EDITORIALES','Editoriales');
        define('_EDITORIAL','Editorial');
        define('_ALCARRITO','Al Carrito');
        define('_CANCELAR','Cancelar');
        define('_CANTIDAD','Cantidad');
        define('_PRECIOUNITARIO','Precio Unitario');
        define('_MAXITEMSSHOP',100);
        define('_LENG_AUTORES',80);
        define('_COMPRAR','Comprar');
        define('_USERDATA','Datos del usuario');
        define('_NOMBRE','Nombre');
        define('_EMAIL','Email');
        define('_DIRECCION','Direcci&oacute;n');
        define('_TELEFONO','Tel&eacute;fono');
        define('_CIUDAD','Ciudad');
        define('_IDENTIFICACION','Identificaci&oacute;n');
        define('_CONTACTO','Cont&aacute;cto');
        define('_TELEFONOCONTACTO','Tel&eacute;fono de Cont&aacute;cto');
        
        /************ERRORERS**********/
        define('_ERRORLOGIN','Nomgre de usuario o contrase&ntilde;a incorrectos');
        define('_LOGOUT','Sesi&oacute;n Finalizada');
        define('_ERRORNOACTION','No se ha especificado una acci&oacute;n');
        
        /*********FIN ERRORES**********/
        
        
        /*******CARRIOT DE COMPRAS *****/
        
        define('_CARROVACIO','Tu carrito esta vacio');
        define('_CANTIDADITEMS','Productos');
        define('_VALORITEMS','Valor');
        define('_ITEMINGRESADO','Item ingresado a tu carro de compras');
        define('_NOITEMSSELECCIONADOS','No selecciono un formato del item a comprar');
        define('_IMPRESOS','Impresos');
        define('_EBOOKS','EBooks');
        define('_GUARDARYCONTINUAR','Guardar y Continuar');
       
        /**********************/
        /*ESTADOS DE PAGO*/
        define('_PENDIENTEPAGO','PagoPendiente');
        define('_PENDIENTEAPROBACION','PendienteAprobacion');
        define('_PAGOAPROBADO','PagoAprobado');
        define('_PAGORECHAZADO','PagoRechazado');
        
        /*ESTADOS DE DESPACHO*/
        define('_SINDATOS','SinDatos');
        define('_SINDESPACHO','SinDespacho');
        define('_DESPACHOPROGRAMADO','DespachoProgramado');
        define('_DESPACHADO','Despachado');
        define('_ENTREGADO','Entregado');
        
        /*ESTADOS DE ORDEN*/
        define('_ACTIVA','Activa');
        define('_ANULADA','Aunlada');
        define('_PROCESADA','Procesada');
        define('_ENPROCESO','EnProceso');
         define('_RECHAZADA','Rechazada');
        /************************/
        
        define('_NPEDIDO','# Pedido');
        define('_FPEDIDO','Fecha Pedido');
        define('_VPEDIDO','Valor');
        define('_MPEDIDO','Divisa');
        define('_ESTADOPEDIDO','Estado');
        
        define('_OPCIONES','Opciones');
        define('_PROCESARPEDIDO','Procesar Pedido');
        define('_BORRAR','Borrar');
        define('_TIPO','Tipo');
        define('_GUARDARCARRITO','Guardar el contenido del carrito');
        
        define('_NOITEMSENELPEDIDO','No ha generado pedidos aun');
        
        define('_CONTINUARCONPAGO','Pagar este pedido');
        define('_CALCULAR_FLETES','Calcular Fletes');
        define('_CONTINUARALPASO','Siguiente paso: ');
        
        
        
        //Gateway plataforma de pago
        define('_GATEWAYPLATAFORMAPAGO','gatewayPagos.php');
        
        /*******Estado de pedidos en platafora de pago***********/
        define('_INICIADO','iniciado');
        define('_EXITO','exito');
        define('_ERROR','error');
        
        /********PAGOS ONLINE*-*****/
        define('_KEYPOOL','10b8ad8be4c');
        define('_USERPOOL','11767');
        define('_IDMONEDA',1); /* MONEDA QUE UTIZA EL SISTEMA PARA PROCESAR ORDENES */
        define('_URLRESPUESTAPAGOSONLINE','http://www.google.com');
        define('_URLCONFIRMACIONPAGOSONLINE','http://www.google.com');
        
        
        /** XML PARA CARRITO DE COMPRAS */
        define('_carXML',"<?xml version='1.0' standalone='yes'?>
                    <shoppingcar>
                        <productos>
                        </productos>
                    </shoppingcar>");
        
        
        /**** XML PARA INFORMACION DEL USUARIO */
        define('_userXML',"<?xml version='1.0' standalone='yes'?><UsuarioXML></UsuarioXML>");
        
        /******** XML PARA PASO DE DATOS EN AJAX *****/
        define('_mensageXML',"<?xml version='1.0' standalone='yes'?><mensageXML></mensageXML>");
        
         /**** XML PARA INFORMACION DEL LIBRO */
        define('_sheXML',"<?xml version='1.0' standalone='yes'?><tituloXML></tituloXML>");
        
	/*< PARAMETROS DE BUSQUEDA*/
	
	define('_CABECERAONIX','﻿<?xml version="1.0" encoding="utf-8"?>
<ONIXMessage release="3.0" xmlns="http://www.editeur.org/onix/3.0/reference">
  <Header>
    <Sender>
      <SenderName>PUBLIDISA</SenderName>
    </Sender>
    <Addressee>
      <AddresseeName>Publidisa.com</AddresseeName>
    </Addressee>
    <SentDateTime>20110602</SentDateTime>
  </Header>');
        define ('_PIEONIX','</ONIXMessage>');
       
?>