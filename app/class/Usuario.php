<?php  
namespace App;

class Usuario extends \System\Model {

	protected $table = 'usuarios';
	protected $id = 'id';

	public static function tipo($tipo){

		switch ($tipo) {
			case '0': $r = '<span class="label label-info">Admin</span>'; break;
			case '1': $r = '<span class="label label-warning">Consulta</span>'; break;      
		}

		return $r;
	}

	//Verifica se usuario existe
	public function login($login, $senha)
	{
        $sql = "SELECT * FROM $this->table WHERE login = :login AND senha = :senha LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        if($stmt->rowCount() > 0){
          return $stmt->fetch(\PDO::FETCH_ASSOC);
      } else { return false; }		
	}	

	//Registra a data de acesso
	public function dataAcesso($id)
	{
		$dados['data_acesso'] = date("Y-m-d G:i:s");
		$this->update($dados, $id);
	}

}

?>