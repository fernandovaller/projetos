<?php  
namespace App;

class Projeto extends AppModel {

	protected $table = 'projetos';
	protected $id = 'id';
	protected $id_usuario;

	//Marca um projeto como padrao
	public function setPadrao($id)
	{
		$this->disablePadraoAll();
		$dados['padrao'] = true;
		$this->update($dados, $id);
	}

	public static function getPadrao()
	{
		$obj = new self;		
		$sql = "SELECT * FROM $obj->table WHERE padrao = true AND id_usuario = :id_usuario LIMIT 1";
        $stmt = $obj->con->prepare($sql);        
        $stmt->bindParam(':id_usuario', $obj->id_usuario);
        $stmt->execute();
        if($stmt->rowCount() > 0){
          $row = $stmt->fetch(\PDO::FETCH_ASSOC);
          return $row['id'];
      } else { return 0; }
	}

	//Desmarca todos os projetos que são padrao
	public function disablePadraoAll()
	{
        $sql = "UPDATE $this->table SET padrao = false WHERE padrao = true AND id_usuario = :id_usuario";
        $stmt = $this->con->prepare($sql);               
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        return $stmt->execute();		
	}

	public static function getAll()
	{
		$obj = new self;
		return $obj->findWhere("status = '1'");
	}	

	public static function get($id)
	{
		$obj = new self;
		return $obj->find($id);
	}

}

?>