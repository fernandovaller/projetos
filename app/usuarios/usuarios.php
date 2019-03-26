<div class="row">
  <div class="col-sm-6">    
    <?=pages_title("Usuários", 'Lista de usuários', '')?>
  </div>
  <div class="col-sm-6">
    <div class="text-right">
      <div class="btn-group">
        <a href="/usuarios-form" class="btn btn-primary"><i class="fa fa-file fa-fw"></i> Novo</a>                                
      </div>
    </div>
  </div>   
</div>

<hr> 

<table class="table table-striped datatable-page" >
  <thead>
    <tr class="active" >
     <th width="10">ID</th>
     <th>Nome</th>
     <th>Email</th>
     <th>Login</th>
     <th>Senha</th>
     <th>Acesso</th>
     <th class="text-center">Status</th>

     <th>Ação</th>
   </tr>
 </thead>
 <tbody>

  <?php
  $usuario = new App\Usuario();      
  $usuarios = $usuario->findAll();    
  if($usuarios)
    foreach ($usuarios as $row) :   
  ?>
      <tr>
        <td><?=$row['id']?></td>        
        <td><?=$row['nome']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['login']?></td>
        <td><?=$row['senha']?></td>
        <td><?=data_hora($row['data_acesso'])?></td>
        <td class="text-center"><?=($row['status'])?></td>

        <td class="text-right">        
          <a href="/usuarios-form?id=<?=$row['id']?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
          <a href="/pages/usuarios-action?acao=excluir&id=<?=$row['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?');" ><span class="glyphicon glyphicon-trash"></span></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>