<?php

define('RAIZ_SMP', "/ingresso/projeto/servidor/");

define('RAIZ_ABS', $_SERVER['DOCUMENT_ROOT'].RAIZ_SMP);

define('RAIZ_MIDIA_SMP', "/ingresso/projeto/imgs/");

define('RAIZ_MIDIA_ABS', $_SERVER['DOCUMENT_ROOT'].RAIZ_MIDIA_SMP);

define('CHAVE', "7b4zA40HNdo10RgTpGm2ft1QatRRlL0uZ20AcHgGgK18swUx");

define('MYSQL_BD', 'ingressobd');
define('MYSQL_DNS', 'mysql:host=localhost;dbname='.MYSQL_BD.';');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');

?>