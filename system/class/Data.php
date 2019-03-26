<?php
namespace System;

//Class para auxiliar na manipulação de datas
class Data {

    //gerar as data de vencimento a partir 
    //da data inicial pelo numero de meses informado
    //retora um array com as novas datas
    public static function gerarVencimentos($data_mysql, $meses = 1){
      if(empty($data_mysql))
        return false;
      
      for ($i = 0; $i < $meses; $i++) {    
        $date = new \DateTime($data_mysql);
        $date->add(new \DateInterval("P{$i}M"));
        $vencimentos[$i+1] = $date->format('Y-m-d');
      }
      return $vencimentos;  
    }    

    //adiciona dias, meses ou anos a uma data
    //Ex: ->add('2018-01-01', '1D') //adiciona um dia
    //Ex: ->add('2018-01-01', '1M') //adiciona um mes
    //Ex: ->add('2018-01-01', '1Y') //adiciona um ano
    public static function add($data_mysql, $valor = '1M'){
      if(empty($data_mysql)) return false;
      $date = new \DateTime($data_mysql);
      $date->add(new \DateInterval("P{$valor}"));        
      return $date->format('Y-m-d');
    }     

    public static function sub($data_mysql, $valor = '1M'){
      if(empty($data_mysql)) return false;
      $date = new \DateTime($data_mysql);
      $date->sub(new \DateInterval("P{$valor}"));      
      return $date->format('Y-m-d');
    }      
  
    //Retorna o mes de uma data
    public static function getMes($data_mysql){
      if(empty($data_mysql)) return false;
      $date = new \DateTime($data_mysql);      
      return $date->format('n'); // ou m[01..] ou M[Jan..] ou n[1...]
    }      

    //Retorna o mes de uma data por extenso
    public static function getMesExtenso($data_mysql){
      if(empty($data_mysql)) return false;
      $date = new \DateTime($data_mysql);
      $mes = $date->format('n');
      $meses_ptbr = array(1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro');      
      return $meses_ptbr[$mes];
    }   

     //retorna o mes de uma data
    public static function getAno($data_mysql){
      if(empty($data_mysql)) return false;
      $date = new \DateTime($data_mysql);      
      return $date->format('Y');
    }

    //Muda o formato da data para o formato MySQL
    public static function dataMysql($data_dma){
      if(!$data_dma)
        return false;
      $data_array = split("/",$data_dma);
      $data = $data_array[2] ."-".$data_array[1]."-".$data_array[0];
      return $data;
    }

    public static function dataBr($data_mysql){  
      if($data_mysql == '0000-00-00')
        return '-';
      
      if($data_mysql){
        $data = date("d/m/Y", strtotime($data_mysql));    
        return $data;
      }
    }

    public static function dataHoraBr($valor){
      if($valor == '0000-00-00 00:00:00')
        return '-';

      if($valor){
        $data = date("d/m/Y G:i:s", strtotime($valor));    
        return $data;
      }
    }   

    public static function diff($data_mysql_ini, $data_mysql_fim){
      $datetime1 = new \DateTime($data_mysql_ini);
      $datetime2 = new \DateTime($data_mysql_fim);
      if($datetime2 >= $datetime1){
        $difference = $datetime2->diff($datetime1);
        return $difference->format('%a');  
      }
      return '0';      
      //return $difference->d;
      //return $difference->y;
      //return $difference->m;
     }     

     //verifica se data é maior
     //data 1 > data 2
     public static function compararData($data1, $data2){
      $datetime1 = new \DateTime($data1);
      $datetime2 = new \DateTime($data2);
      if($datetime1 >= $datetime2){
        return true;        
      }
      return false;
     } 

     public static function isNegative(\DateInterval $interval)
     {
      $now = new \DateTimeImmutable();
      $newTime = $now->add($interval);
      return $newTime < $now;
    }      
    
}