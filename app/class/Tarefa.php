<?php  
namespace App;

class Tarefa extends AppModel {

	protected $table = 'tarefas';
	protected $id = 'id';
	protected $id_usuario;

	//Retorna todas as tarefas
	public function findAllTarefas($where = '')
	{   
		$w = !empty($where) ? "AND {$where}" : "AND t.status = '0'";
		$sql = "SELECT t.*, p.descricao as projeto, p.cor, p.padrao FROM $this->table t
		LEFT JOIN projetos p ON t.id_projeto = p.id
		WHERE 1=1 AND t.id_usuario = :id_usuario $w
		ORDER BY t.data DESC";
		$stmt = $this->con->prepare($sql);
		$stmt->bindParam(':id_usuario', $this->id_usuario);
		//var_dump($stmt);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		} else { return false; }
	}	

	public function findATarefa($id)
	{   
		$sql = "SELECT t.*, p.descricao as projeto, p.cor FROM $this->table t
		LEFT JOIN projetos p ON t.id_projeto = p.id
		WHERE t.id = :id AND t.id_usuario = :id_usuario
		ORDER BY t.data DESC";
		$stmt = $this->con->prepare($sql);
		$stmt->bindParam(':id_usuario', $this->id_usuario);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return $stmt->fetch(\PDO::FETCH_ASSOC);
		} else { return false; }
	}

	public function tableBody($tarefas)
	{		
		if(file_exists(APP_PATH . 'tarefas/tarefas-table-row.phtml')){
			include APP_PATH . 'tarefas/tarefas-table-row.phtml';
		}
		
	}	

	public function editForm($row)
	{		
		if(file_exists(APP_PATH . 'tarefas/tarefas-form-edit-inc.phtml')){
			include APP_PATH . 'tarefas/tarefas-form-edit-inc.phtml';
		}	
	}	

	public static function getAll()
	{		
		$obj = new self;
		return $obj->findAll();
	}	

	public static function get($id)
	{		
		$obj = new self;
		return $obj->find($id);
	}

	//Remove todas as tarefas de um projeto
    public static function deleteAllPorProjeto($id_projeto){
    	$obj = new self;
        $sql = "DELETE FROM $obj->table WHERE id_projeto = :id_projeto";
        $stmt = $obj->con->prepare($sql);
        $stmt->bindParam(':id_projeto', $id_projeto);
        return $stmt->execute();
    } 	

}

?>