<?php
$login = anti_injection($_POST['user']);
$senha = anti_injection($_POST['password']);
$senha = md5($senha);

$usuario = new App\Usuario();
$dados = $usuario->login($login, $senha);

if($dados){

  $_SESSION['usuario_id']       = $dados['id'];
  $_SESSION['usuario_nome']     = $dados['nome'];
  $_SESSION['usuario_login']    = $dados['login'];
  $_SESSION['usuario_senha']    = $dados['senha'];  	
  $_SESSION['usuario_tipo']     = $dados['tipo'];
  $_SESSION['usuario_data_ac']	= $dados['data_acesso'];

  //Registra data e hora de acesso ao sistema
  $usuario->dataAcesso($dados['id']);

}else{
  System\Util::setMessage(System\Util::bootAlert('Usuário ou Senha estão incorretos', 'danger'), 'login');  
}

header("Location: ".URL);
exit();   