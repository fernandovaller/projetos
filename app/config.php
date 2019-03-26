<?php
//CONFIGURAÇÕES GERAIS DO SISTEMA
//Essas configurações se aplicam a todos os sistemas dentro da pasta APP
define('SITE_TITLE', 'Projetos');
define('SITE_NAME', 'PROJETOS');
define('SITE_FOOTER', SITE_TITLE . ' - Copyright &copy;');

//CONFIG DB
define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PWD',  getenv('DB_PWD'));

//PATH DO SISTEMA
define('SESSION_NAME', 'projetos');
define('URL', getenv('URL'));
define('PATH_UPLOADS', 'uploads');

//pasta padrao do sistema dentro de APP
$CONFIG['default_router'] = '';