<div class="row">
  <div class="col-sm-6">
    <?=pages_title("Projetos", 'Lista de projetos', '')?>
  </div>
  <div class="col-sm-6">
    <div class="text-right">
      <div class="btn-group">
        <a href="/projetos-form" class="btn btn-primary"><i class="fa fa-file fa-fw"></i> Novo</a>                                
      </div>
    </div>
  </div>   
</div>

<hr> 

<table class="table table-striped datatable-page" >
  <thead>
    <tr class="active" >
     <th width="10">ID</th>     
     <th>Descrição</th>
     <th width="100">Cor</th>
     <th width="10">Status</th>

     <th>Ação</th>
   </tr>
 </thead>
 <tbody>

  <?php
  $projeto = new App\Projeto();
  $projetos = $projeto->findAll();    
  if($projetos)
    foreach ($projetos as $row) :   
      $padrao = $row['padrao'] ? '<span class="label label-info">Padrão</span>' : '';
  ?>
      <tr>
        <td><?=$row['id']?></td>        
        <td><?=$row['descricao']?> <?=$padrao?></td>        
        <td class="text-center" style="background-color: <?=$row['cor']?>;"><?=$row['cor']?></td>        
        <td><?=status($row['status'])?></td>

        <td width="150" class="text-right">        
          <a href="/pages/projetos-action?acao=padrao&id=<?=$row['id']?>" title="Tornar padrao" class="btn btn-info btn-sm"><i class="fa fa-star-o fa-fw"></i></a>
          <a href="/projetos-form?id=<?=$row['id']?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
          <a href="/pages/projetos-action?acao=excluir&id=<?=$row['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?\nTodas as tarefas desse projeto serão removidas!');" ><span class="glyphicon glyphicon-trash"></span></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>