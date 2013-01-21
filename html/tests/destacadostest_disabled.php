<?php
require_once("../config.php");
require_once("../app/destacados/classDestacados.php");
$destacados = new classDestacados();
echo "<html><head>
    <LINK href=\"../css/destacados.css\" rel=\"stylesheet\" type=\"text/css\" />
    <script type=\"text/javascript\" src=\"../lib/jquery/jquery.min.js\" ></script>
    <script type=\"text/javascript\"  src=\"../lib/jquery/stepcarousel.js\" ></script> 
     <script type=\"text/javascript\" src=\"../lib/destacadosCarrusel.js\" ></script>
    </head>
    <body>
    <div id='contador' alt='1'></div>
    ".$destacados->print."
        <div id=\"destacados1\" class=\"destacados1\" alt='1'>
            <div class=\"belt\" id='destacados'>
            </div>
        </div>
    </body>
    </html>";

?>