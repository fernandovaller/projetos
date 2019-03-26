<div class="row">
  <div class="col-sm-6">    
    <?=pages_title('Tarefas', 'Lista de tarefas por projetos', '')?>
  </div>
  <div class="col-sm-6">
    <div class="text-right">
      <div class="btn-group">
        <a href="/tarefas" class="btn btn-default">Pendentes</a>
        <a href="/tarefas/?status=checked" class="btn btn-default">Concluidas</a>
        <a href="/tarefas/?status=all" class="btn btn-default">Todas</a>
      </div>
    </div>
  </div>   
</div>

<hr>
<form id="form-tarefas" method="post" action="/pages/tarefas-action?acao=inserir" class="mt40" enctype="multipart/form-data" >
  
  <div class="row">

    <div class="form-group col-sm-9 mb0">      
      <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Adicionar uma tarefa pendente" value="<?=$row['descricao']?>" required/>
    </div>

    <div class="form-group col-sm-2 mb0">
      <select name="id_projeto" id="id_projeto" class="form-control select2" required>
        <option value="">[Selecione um projeto]</option>
        <?=form_select_array(App\Projeto::getAll(), 'id', 'descricao', App\Projeto::getPadrao())?>
      </select>      
    </div>   

    <div class="form-group col-sm-1 mb0">
      <button type="submit" class="btn btn-info btn-block"><i class="fa fa-plus-circle fa-fw"></i></button>
    </div>

  </div>
  
</form>

<hr> 
      
<table class="table table-hover table-tarefas datatable" id="tb-tarefas" >
  <thead>
    <tr class="active" >
     <th width="10">ID</th>
     <th>Descrição</th>
     <th width="20" class="text-center">Projeto</th>     
     <th width="100">Ação</th>
   </tr>
 </thead>
 <tbody>
   <?php  
    require __DIR__ . '/tarefas-filter.php';    
    $tarefa = new App\Tarefa();
    $tarefas = $tarefa->findAllTarefas($where);
    $tarefa->tableBody($tarefas); 
   ?>
 </tbody>
</table>

<hr>

<div class="modal fade" id="modal-tarefas">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Editar tarefa</h4>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>