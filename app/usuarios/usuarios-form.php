<?php 
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$title = 'Cadastrar';
$subtitle = '';
$form_action = 'inserir';   

//se for edição
if($id){   
  $row = (new App\Usuario)->find($id);
  $title = 'Editar';  
  $subtitle = ' (#'.$id.')';
  $form_action = 'editar';
}
?>

<div class="row">
  <div class="col-sm-6">    
    <?=pages_title("Usuário - {$title}", $subtitle, '')?>
  </div>
  <div class="col-sm-6">
    <div class="text-right">
      <div class="btn-group">
        <a href="/usuarios" class="btn btn-default">Voltar</a>
      </div>
    </div>
  </div>   
</div>

<hr>

<?= System\Util::getMessage(); ?>

<div id="msg"></div>

<form role="form" method="post" action="pages/usuarios-action/?acao=<?=$form_action?>" id="pag-edit" enctype="multipart/form-data" >

  <input type="hidden" name="id" value="<?=$id?>" />
  <div class="row">
    <div class="form-group col-sm-3">
      <label>Nome</label>
      <input type="text" name="nome" class="form-control" value="<?=$row['nome']?>" required/>
    </div>

    <div class="form-group col-sm-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?=$row['email']?>" />
    </div>    

    <div class="form-group col-sm-2">
      <label>Login</label>
      <input type="text" name="login" class="form-control" value="<?=$row['login']?>" required/>
    </div>       

    <div class="form-group col-sm-2">
      <label>Senha</label>
      <small title="Deixar em branco para não mudar">(Informar para mudar)</small>
      <div class="input-group">        
        <input type="password" name="senha" id="senha" class="form-control"/>
        <span class="input-group-btn">
          <button class="btn btn-default senha-display" type="button"><i class="fa fa-eye-slash fa-fw"></i></button>
        </span>
      </div>
      <input type="hidden" name="senha_old" value="<?=$row['senha']?>" />
    </div>    
    
    <div class="form-group col-sm-2">
      <label>Status</label>          
      <select name="status" class="form-control">
        <option value="0" <?=$row['status']=='0'?'selected':''?>>Inativo</option>
        <option value="1" <?=$row['status']=='1'?'selected':''?>>Ativo</option>
      </select>
    </div>

  </div>

  <hr>  
  <button type="submit" class="btn btn-success mr10"><i class="fa fa-check fa-fw"></i> Salvar</button>
  <button type="button" class="btn btn-default" onclick="window.history.back();"><i class="fa fa-close fa-fw"></i> Cancelar</button>
</form>


<div class="modal fade" id="modal-senha">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Mudar senha</h4>
      </div>
      <div class="modal-body">

        <form action="pages/usuarios-perfil-action" method="post" accept-charset="utf-8" id="frm-senha">
          <input type="hidden" name="id" value="<?=$id?>">
          <div class="row">
            <div class="form-group col-sm-6">
              <label>Nova Senha</label>
              <input type="text" name="senha" id="senha" class="form-control" value=""/>
            </div>
            <div class="form-group col-sm-6">
              <label>Repetir Nova Senha</label>
              <input type="text" name="senha_confirme" id="senha_confirme" class="form-control" value=""/>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>            
            <button type="submit" class="btn btn-success mr10"><i class="fa fa-check fa-fw"></i> Salvar</button>            
          </div>
        </form>        
        
      </div>

    </div>
  </div>
</div>