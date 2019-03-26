<?php
  //Trata os campos
  $acao = anti_injection($_GET['acao']);
  $id   = anti_injection($_REQUEST['id']);  

  //dados  
  $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
  $cor       = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);
  $padrao    = filter_input(INPUT_POST, 'padrao', FILTER_SANITIZE_STRING);
  $status    = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

  $id_usuario = $_SESSION['usuario_id'];

  $projeto = new App\Projeto();

  switch($acao){

    case 'inserir':   

    $dados['descricao']  = $descricao;
    $dados['cor']        = $cor;    
    $dados['status']     = $status;
    $dados['id_usuario'] = $id_usuario;
  

    if($projeto->insert($dados)){             
      header("Location: " . URL . "/projetos");
    }    
    break;

    case 'editar':    
    $dados['descricao'] = $descricao;
    $dados['cor']       = $cor;    
    $dados['status']    = $status;

    if($projeto->update($dados, $id)){       
      header("Location: " . URL . "/projetos");
    }     
    break;  

    case 'padrao':
    echo $projeto->setPadrao($id);
    header("Location: " . URL . "/projetos");
    break;

    case 'excluir':    
    if($projeto->delete($id)){
      
      //remove todas as tarefas desse projeto
      App\Tarefa::deleteAllPorProjeto($id);

      header("Location: " . URL . "/projetos");
    }     
    break;    

  }

?>