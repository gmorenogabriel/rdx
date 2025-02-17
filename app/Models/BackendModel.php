<?php namespace App\Models;
	
use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class BackendModel extends Model{

	// obtiene los Permisos del usuario

	public function getID($link){
		$db = \Config\Database::connect();
		$builder = $db->table('menus');
		$resultado = $builder->like('link',$link)->get()->getRow();
	//	d($resultado);
	//	d($db->getLastQuery());
	//	d($resultado->id);
	//	d($resultado['id']);
		return $resultado;
	}
	public function getPermisos($menu,$rol){
		//SELECT * FROM `permisos` WHERE `menu_id` = '2' AND `rol_id` = '1'
		$db = \Config\Database::connect();
		$sql = "SELECT * FROM `permisos` WHERE `menu_id` = $menu AND `rol_id` =  $rol";
		$resultado = $db->query($sql)->getRowObject();
		//d($db->getLastQuery());
		return $resultado;
	}
	public function rowCount($tabla){
		/*
		if ($tabla != "ventas") {
			$this->db->where("estado","1");
		}
		*/
		$db = \Config\Database::connect();
		$resultados = $db->table($tabla)->countAllResults();
//		$resultados = $builder->get();
//		$model->table('users')->countAllResults();
//		d($db->getLastQuery());
		return $resultados;
	}
}
