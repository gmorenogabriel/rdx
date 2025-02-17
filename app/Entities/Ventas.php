<?php namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\VentasModel;
use Hashids\Hashids;

class Ventas extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
	
    protected $casts   = [];
	
	public function getVentas(){
		$this->db->select("v.*, c.nombres, tc.nombre as tipocomprobante");
		$this->db->from("ventas v");
		$this->db->join("clientes c", "v.cliente_id = c.id");
		$this->db->join("tipo_comprobante tc", "v.tipo_comprobante_id = tc.id");
		$this->db->order_by("v.num_documento","desc");
		$resultados = $this->db->get();

		//var_dump($resultados);
		//die();
		if ($resultados->num_rows() > 0){
			return $resultados->result();
		}else{
			return false;
		}
		return $resultados->result();
	}

	public function getVentasbyDate($fechainicio,$fechafin){
		$this->db->select("v.*,c.nombres,tc.nombre as tipocomprobante");
		$this->db->from("ventas v");
		$this->db->join("clientes c","v.cliente_id = c.id");
		$this->db->join("tipo_comprobante tc","v.tipo_comprobante_id = tc.id");
		$this->db->where("v.fecha >=",$fechainicio);
		$this->db->where("v.fecha <=",$fechafin);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}else
		{
			return false;
		}
	}
    // Para el reporte de Movimientos de Ventas
	public function getVenta($id){
		$this->db->select("v.*,c.nombres,c.direccion,c.telefono, v.num_documento as documento, tc.nombre as tipocomprobante");
		$this->db->from("ventas v");
		$this->db->join("clientes c", "v.cliente_id = c.id");
		$this->db->join("tipo_comprobante tc", "v.tipo_comprobante_id = tc.id");
		$this->db->where("v.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}
	public function getDetalle($id){
		$this->db->select("dt.*,p.codigo, p.nombre as nombres");
		$this->db->from("detalle_venta dt");
		$this->db->join("productos p", "dt.producto_id = p.id");
		$this->db->where("dt.venta_id",$id);		
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getComprobantes(){
		$resultados = $this->db->get("tipo_comprobante");
		return $resultados->result();
	}
	public function getComprobante($idcomprobante){
		$this->db->where("id",$idcomprobante);
		$resultado = $this->db->get("tipo_comprobante");
		return $resultado->row();
	}
	public function getProductos($valor){
		$this->db->select("id,codigo,nombre as label,precio,stock");
		$this->db->from("productos");
		$this->db->like("nombre",$valor);
		$resultados = $this->db->get();
		return $resultados->result_array();
	}
	//public function save($i, $data){
	public function save($id){
		// return $this->db->insert("ventas",$data);
		$producto = new Ventas_Model();
		$data['producto']	= $producto->find($id);
		$producto->save($data);	
	}	
	public function lastId(){
		return $this->db->insert_id();
	}
	public function updateComprobante($idcomprobante,$data){
		$this->db->where("id",$idcomprobante);
		$this->db->update("tipo_comprobante",$data);
	}

	public function save_detalle($data){
		//print_r($data);
		//die();
		$this->db->insert("detalle_venta",$data);
	}
	public function years(){
		$this->db->select("YEAR(fecha) as year");
		$this->db->from("ventas");
		$this->db->group_by("year");
		$this->db->order_by("year","desc");
		$resultados = $this->db->get();
		return $resultados->result();
	}
		// select MONTH(fecha) as mes, sum(total) as monto from ventas where fecha BETWEEN '2014-01-01' AND '2014-12-31' GROUP BY MES;
	public function montos($year){
		$this->db->select("MONTH(fecha) as mes, SUM(total) as monto");
		$this->db->from("ventas");
		$this->db->where("fecha >=",$year."-01-01");
		$this->db->where("fecha <=",$year."-12-31");
		$this->db->group_by("mes");
		$this->db->order_by("mes","desc");		
		$resultados = $this->db->get();
		// si lo habilita devuelve mal el JSON
		// print_r($this->db->last_query());
		return $resultados->result();
	
		
		//$resultados=array("mes":"1","monto":"15244","mes":"02","monto":"21244","mes":"03","monto":"35244");
		//return  $resultados;
	}
	public function getVentasNoPresentadas(){
		$this->db->select("v.*");
		$this->db->from("ventas v");
		$this->db->where('v.liq_presentada','IS NULL');
   		$this->db->or_where('v.liq_presentada','N');
//		$this->db->where("liq_presentada = 'N'");
		$resultados = $this->db->get();

		die($resultados);
		if ($resultados->num_rows() > 0){
			return $resultados->result();
		}else{
			return false;
		}
		return $resultados->result();
	}
	public function fechaYYYYMM($fecha){
      // Retorna la fecha 
      $this->db->select("cast(date_format(fecha, '%Y%m') as Char) as fecha");
      $this->db->from("ventas");
      $this->db->where("fecha",$fecha);
      $query = $this->db->get();
      $resultado = $query->row();   
      return $resultado->fecha;
    }

	public function saveLiqMensualVentas($id,$data){
		$this->db->where("id",$id);
		$this->db->update("ventas",$data);
	}

	public function saveLiqMensualCompras($ids,$fecha,$data){
			$this->db->where_in("id",$ids);			
			$this->db->where("fecha <=",$fecha);			
			$this->db->where("liq_presentada","N");			
			$this->db->update("compras",$data);	
	}

}




