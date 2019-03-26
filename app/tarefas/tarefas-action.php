<?php
  //Trata os campos
  $acao = anti_injection($_GET['acao']);
  $id   = anti_injection($_REQUEST['id']);

  //dados
  $id_projeto = filter_input(INPUT_POST, 'id_projeto', FILTER_SANITIZE_STRING);
  $descricao  = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
  $data       = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
  $obs        = filter_input(INPUT_POST, 'obs', FILTER_DEFAULT);

  $status     = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);

  $id_usuario = $_SESSION['usuario_id'];


  $tarefa = new App\Tarefa();

  switch($acao){

    case 'all':
    
    break;

    case 'inserir':    
    $dados['id_projeto'] = $id_projeto;
    $dados['descricao'] = $descricao;
    $dados['obs'] = $obs;
    $dados['data'] = date("Y-m-d G:i:s");    
    $dados['id_usuario'] = $id_usuario;

    if($id = $tarefa->insert($dados)){
      $tarefas = $tarefa->findAllTarefas();
      $tarefa->tableBody($tarefas);
    }    
    break;

    case 'editar':        
    $row = $tarefa->findATarefa($id);
    $tarefa->editForm($row);    
    break;     

    case 'atualizar':    
    $dados['id_projeto'] = $id_projeto;
    $dados['descricao'] = $descricao;
    $dados['obs'] = $obs;    

    if($tarefa->update($dados, $id)){ 
      $tarefas = $tarefa->findAllTarefas();
      $tarefa->tableBody($tarefas);
    }     
    break;   

    case 'checked':        
    $dados['status'] = ($status === '1') ? '0' : '1';
    if($tarefa->update($dados, $id)){ 
      echo 1;
    }     
    break;

    case 'excluir':    
    if($tarefa->delete($id)){
      echo 1;      
    }     
    break;

  }

?>