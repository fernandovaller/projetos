<?php
//FUNCTIONS PARA CORE DO SISTEMA
//NAO CRIAR FUNÇÕES DO APP AQUI, CRIAR EM HELPER


/* 
* ******************************************************************************
* CONEXAO MySQL 
*/
function getCon(){
  return mysql_connect(DB_HOST, DB_USER, DB_PWD);  mysql_select_db(DB_NAME, $conexao);  mysql_set_charset('UTF8', $conexao);  
}


/* 
* ******************************************************************************
* CONEXAO MySQL MySQLi
*/
function getConni(){  
  $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
  mysqli_set_charset($conexao, 'utf8');
  return $conexao;
}

/* 
* ******************************************************************************
* CONEXAO MySQL PDO 
*/
function getConn(){ 
  
  try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);    
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
  } catch (Exception $e) {
    //echo $e->getMessage();
    var_dump($e->getMessage());
    if($e->getCode() == 1044) echo '[Error: 1] Infelizmente estamos tendo problemas de conexao no momento, tente novamente.'; //Usuario
    if($e->getCode() == 1045) echo '[Error: 2] Infelizmente estamos tendo problemas de conexao no momento, tente novamente.'; //Senha     
    if($e->getCode() == 1049) echo '[Error: 3] Infelizmente estamos tendo problemas de conexao no momento, tente novamente'; //Banco
    if($e->getCode() == 2002) echo '[Error: 4] Infelizmente estamos tendo problemas de conexao no momento, tente novamente.'; //Host
  }

    return $db;
}

//remove palavras que podem permitir o sql injection
function anti_injection($sql){
  $sql = preg_replace(sql_regcase("/(http|www|wget|from|select|insert|delete|where|.dat|.txt|.gif|drop table|show tables| or |#|\*|--|\\\\)/"),"",$sql);
  $sql = trim($sql);
  $sql = strip_tags($sql);
  $sql = addslashes($sql);
  return $sql;
}

//monta o caminho do arquivo passado
function assets($files_path, $version = false){
  $v = $version ? "?v=" . filemtime($files_path) :'';
  return URL . "/{$files_path}{$v}";
}

function redirect($url) {
    if (!headers_sent()) {
        header('Location: '.$url);        
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
    }
    exit();
}

function moeda_mysql($valor) {  
  if(empty($valor)) 
    return '0';
  $valor = str_replace(".", "", trim($valor)); //remove "."
  $valor = str_replace(",", ".", $valor); //remove ","  
  return $valor;
}

function moeda($valor, $prefix = '', $sufix = '') {
  if(empty($valor)) return '';
  $valor = str_replace(",", "", $valor);
  $valor = number_format($valor, 2, ',', '.');
  return $prefix . $valor . $sufix;  
}

function data_mysql($data_dma){
  if(!$data_dma)
    return '0000-00-00';
  $data_array = split("/",$data_dma);
  $data = $data_array[2] ."-".$data_array[1]."-".$data_array[0];
  return $data;
}

function data($valor){  
  if($valor == '0000-00-00')
    return '-';
  
  if($valor){
    $data = date("d/m/Y", strtotime($valor));    
    return $data;
  }
}

function data_hora($valor){
  if($valor == '0000-00-00 00:00:00')
    return '-';

  if($valor){
    $data = date("d/m/Y G:i:s", strtotime($valor));    
    return $data;
  }
}

function pages_title($titulo, $subtitulo = '', $page = ''){
  $r = '<blockquote>';
  $r .= !empty($page) ? '<small class="text-muted2 f12">'.$page.'</small>' : '';
  $r .= '<h2 class="text-primary mb5">'.$titulo.'</h2>';
  $r .= !empty($subtitulo) ? '<p class="text-muted f14">'.$subtitulo.'</p>' : '';
  $r .= '</blockquote>';
  return $r;              
}

// Select de array
function form_select_array($dados, $value, $option, $selected = '', $id = ''){

 if(!is_array($dados))
    return false;

  foreach ($dados as $row) {  
    if(is_array($selected)){  
      $display_id = empty($id) ? "(#".$row[$value].")" : "(#".$row[$id].")";
      $sd = in_array($row[$value], $selected) ? 'selected="selected"' : '';
      $op .= "<option value=\"$row[$value]\" $sd>$row[$option] {$display_id}</option>";
    } else {
      $display_id = empty($id) ? "(#".$row[$value].")" : "(#".$row[$id].")";
      $sd = ($selected == $row[$value]) ? 'selected="selected"' : '';
      $op .= "<option value=\"$row[$value]\" $sd>$row[$option] {$display_id}</option>";  
    }
    
  }

  return $op;
}


//Status de proposito geral
function status($status){

  switch($status){
    case '0' : $r = 'Desativado'; $l = 'info'; break;
    case '1' : $r = 'Ativo'; $l = 'success'; break;
    default : $r = $status; break;
  }

  return "<div class=\"label label-{$l}\">{$r}</div>";
  //return $r;
}

//Limitar string
function strlimit($string, $limit)
{
  if(!empty($string)){
    $str_count = str_word_count($string);
    $words = explode(" ",$string);
    $text = implode(" ", array_splice($words, 0, $limit));

    $str_count_aux = str_word_count($text);

    $aux = ($str_count > $str_count_aux) ? ' ...' : '';

    return strip_tags($text) . $aux;
  }
}