<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederMenus extends Seeder
{
    public function run()
    {
        $array = [
            'nombre'=>'Inicio',
            'link'=> 'dashboard'
        ];
        $this->db->table("menus")->insert($array);

        $array = [
            'nombre'=>'Categorias',
            'link'=> 'mantenimiento/categorias'
        ];
            $this->db->table("menus")->insert($array);

        $array = [
            'nombre'=>'Productos', 						'link'=> 'mantenimiento/productos'];
            $this->db->table("menus")->insert($array);
        $array = [
            'nombre'=>'Movimientos Ventas', 			'link'=> 'movimientos/ventas'];
            $this->db->table("menus")->insert($array);

        $array = [
            'nombre'=>'Ventas Reporte', 				'link'=> 'reportes/ventas'];
            $this->db->table("menus")->insert($array);

        $array = [
            'nombre'=>'Usuarios', 						'link'=> 'administrador/usuarios'];
            $this->db->table("menus")->insert($array);

            $array = [
                'nombre'=>'Permisos', 						'link'=> 'administrador/permisos'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=>'Clientes', 						'link'=> 'mantenimiento/clientes'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=>'Productos Reportes', 			'link'=> 'reportes/productos'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Proveedores', 					'link'=> 'mantenimiento/proveedores'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Compras Reportes', 				'link'=> 'reportes/compras'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Comprasdos', 					'link'=> 'movimientos/comprasdos'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Liquidacion Mensual', 			'link'=> 'administrador/LiquidacionMensual'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Boleto pago DGI 2/901', 		'link'=> 'reportes/boletopagodgi'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Movimientos Boleto pago DGI',	'link'=> 'movimientos/boletopagodgi'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Empleados', 					'link'=> 'mantenimiento/empleados'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Tarjetas de Credito', 			'link'=> 'mantenimiento/tarjetascred'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Inform.Ventas Anuales a DGI', 	'link'=> 'reportes/ventasanualdgi'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Generador de Codigo ABMC', 		'link'=> 'admin/generadorabmc'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Paises', 						'link'=> 'mantenimiento/paises'];
            $this->db->table("menus")->insert($array);

            $array = [
            'nombre'=> 'Mapas',  						'link'=> 'administrador/mapas'];
            $this->db->table("menus")->insert($array);
    }
     // Inserta una sola vez
    //$this->db->table("menus")->insertBatch($items);
}
