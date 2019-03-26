<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=SITE_TITLE?></title>
  <link href="<?=URL?>/css/font-awesome.min.css" rel="stylesheet" media="all">
  <link href="<?=URL?>/css/bootstrap.min.css" rel="stylesheet" media="all">
  <link href="<?=URL?>/css/style.css?v=<?=filemtime('css/style.css');?>" rel="stylesheet" media="all">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="login-body">
  <div class="container">
    <div class="col-sm-6 col-sm-offset-3">
      <div class="login">
        <h1 class="text-center text-primary"><i class="fa fa-home"></i> <?=SITE_NAME?></h1>
        <hr>
        <?= System\Util::getMessage('login') ?>
        <form action="<?=URL?>/login/" method="post" >
          <div class="form-group">
            <div class="input-group input-group-lg">
              <span class="input-group-addon">
                <i class="fa fa-user fa-fw"></i>
              </span>
              <input type="text" name="user" class="form-control input-lg" placeholder="Usuário" required autofocus>
            </div>            
          </div>
          <div class="form-group">
            <div class="input-group input-group-lg">
              <span class="input-group-addon">
                <i class="fa fa-unlock-alt fa-fw"></i>
              </span>
              <input type="password" name="password" class="form-control input-lg" placeholder="Senha" required>
            </div>
          </div>
          <hr class="nb">
          <button type="submit" class="btn btn-primary btn-block btn-lg ">Fazer login</button>
          <hr>
          <p class="small text-muted text-center">&copy; <?=SITE_TITLE?></p>
        </form>
      </div> <!-- login -->
    </div> <!-- col-sm-6 -->
  </div> <!-- container -->

  <script src="<?=URL?>/libs/jquery/jquery-1.12.1.min.js"></script>
  <script src="<?=URL?>/js/bootstrap.min.js"></script>
</body>
</html>