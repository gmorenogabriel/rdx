<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BoletoPagoDgi extends CI_Controller {

	private $permisos;
	
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Ventas_model");
		$this->load->model("Boletopagodgi_model");
	}

	public function index(){
		$this->load->helper('numeros');

        //$this->load->view('v_numeros');

		$fechainicio = $this->input->post("fechainicio");
		$fechafin    = $this->input->post("fechafin");
		if ($this->input->post("buscar")) {
			$ventas = $this->Ventas_model->getVentasbyDate($fechainicio,$fechafin);
		}
		else{
			$ventas = $this->Ventas_model->getVentas();
		}
//		$numtoletra  = num_to_letras($ventas['total']);
		$data = array(
//			'numtoletra'  => num_to_letras($ventas['total']),
//			"numtoletras" => $numtoletra,
			"permisos"    => $this->permisos,
			"ventas"      => $ventas,
			"fechainicio" => $fechainicio,
			"fechafin"    => $fechafin
		);
		// echo '<pre>';
		// var_dump($data);
		// echo '</pre>';
		// die();
		
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/reportes/boletopagodgi",$data);
		$this->load->view("layouts/footer");
	}
}