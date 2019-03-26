<?php
  //Trata os campos
  $acao = anti_injection($_GET['acao']);
  $id   = anti_injection($_REQUEST['id']);
  $origem   = anti_injection($_REQUEST['origem']);

  //dados
  $nome        = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
  $login       = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
  $email       = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $senha       = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);  
  $senha_old   = filter_input(INPUT_POST, 'senha_old', FILTER_SANITIZE_STRING);  
  $data_acesso = filter_input(INPUT_POST, 'data_acesso', FILTER_SANITIZE_STRING);
  $status      = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);  

  $usuarios = new App\Usuario();

  switch($acao){

    case 'inserir':   

    $dados['nome']        = $nome;
    $dados['email']       = $email;        
    $dados['login']       = $login;    
    $dados['senha']       = empty($senha) ? md5(rand(1,100)) : md5($senha);
    $dados['data_acesso'] = $data_acesso;
    $dados['status']      = $status;    

    if($usuarios->insert($dados)){             
      header("Location: " . URL . "/usuarios");
    }    
    break;

    case 'editar':    
    $dados['nome']        = $nome;
    $dados['login']       = $login;
    $dados['email']       = $email;
    $dados['senha']       = !empty($senha) ? md5($senha) : $senha_old;
    $dados['status']      = $status;    

    if($usuarios->update($dados, $id)){       
      header("Location: " . URL . "/usuarios");
    }     
    break;  

    case 'excluir':    
    if($usuarios->delete($id)){     
      header("Location: " . URL . "/usuarios");
    }     
    break;

  }
