<?php 
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$title = 'Cadastrar';
$subtitle = '';
$form_action = 'inserir';   

//se for edição
if($id){   
  $row = (new App\Projeto)->find($id);
  $title = 'Editar';  
  $subtitle = ' (#'.$id.')';
  $form_action = 'editar';  
}

$row['cor'] = empty($row['cor']) ? '#000000' : $row['cor'];
?>
<script>console.log(newColor());</script>
<div class="row">
  <div class="col-sm-6">    
    <?=pages_title("Projeto - {$title}", $subtitle, '')?>
  </div>
  <div class="col-sm-6">
    <div class="text-right">
      <div class="btn-group">
        <a href="/projetos" class="btn btn-default">Voltar</a>
      </div>
    </div>
  </div>   
</div>

<hr>

<?= System\Util::getMessage(); ?>

<div id="msg"></div>

<form role="form" method="post" action="pages/projetos-action/?acao=<?=$form_action?>" id="pag-edit" enctype="multipart/form-data" >

  <input type="hidden" name="id" value="<?=$id?>" />
  <div class="row">
    <div class="form-group col-sm-8">
      <label>Descrição</label>
      <input type="text" name="descricao" class="form-control" value="<?=$row['descricao']?>" />
    </div>

    <div class="form-group col-sm-2">
      <label>Cor</label>   
      <small>(Use cores claras)</small>   
      <div id="mycp" class="input-group colorpicker-component" title="Using color option">
        <input type="text" name="cor" value="<?=$row['cor']?>" class="form-control"/>
        <span class="input-group-addon"><i></i></span>
      </div>      
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
