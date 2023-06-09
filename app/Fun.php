<?php

namespace App;
use Image;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Fun extends Model {

	public static function getPrioridadNombre($id) {
		switch ($id) {
			case '1': return '<span class="badge-prioridades pri-baja">Baja</span>'; break;
			case '2': return '<span class="badge-prioridades pri-media">Media</span>'; break;
			case '3': return '<span class="badge-prioridades pri-alta">Alta</span>'; break;
		}
	}

	public static function getPrioridades() {
		return array(
			'1' => 'Baja',
			'2' => 'Media',
			'3' => 'Alta',
		);
	}

	public static function getUnidadesDeMedidaNombre($id) {
		switch ($id) {
			case '1': return 'Unidades'; break;
			case '2': return 'Kilos'; break;
			case '3': return 'Litros'; break;
			case '4': return 'Metros'; break;
			case '5': return 'Horas'; break;
			case '6': return 'Otros'; break;
		}
	}

	public static function getUnidadesDeMedida() {
		return array(
			'1' => 'Unidades',
			'2' => 'Kilos',
			'3' => 'Litros',
			'4' => 'Metros',
			'5' => 'Horas',
			'6' => 'Otros',
		);
	}
	
	public static function getFormatDateInv($date) { //recupero desde la bd
		if ($date) {
			$date = explode("-",$date);
        	$date = "$date[2]-$date[1]-$date[0]";  
			return $date;
		}
	}

	public static function getStatusSolicitudList() {
		return array(
			'1' => 'Pendiente',
			'2' => 'Aprobada',
			'3' => 'Rechazada',
			'4' => 'En proceso',
			'5' => 'En depósito',
			'6' => 'Finalizada',
		);
	}

	public static function getStatusSolicitud($status) {
		switch ( $status ) {
			case '1':
				return '<span class="status-solicitud status-pendiente">Pendiente</span>';  	
				break;
			case '2':
				return '<span class="status-solicitud status-aprobada">Aprobada</span>';  	
				break;
			case '3':
				return '<span class="status-solicitud status-rechazada">Rechazada</span>';  	
				break;
			case '4':
				return '<span class="status-solicitud status-proceso">En proceso</span>';  	
				break;
			case '5':
				return '<span class="status-solicitud status-deposito">En depósito</span>';  	
				break;
			case '6':
				return '<span class="status-solicitud status-finalizada">Finalizada</span>';  	
				break;
		}
	}

	public static function getIconStatus($status) {
		if ($status==1) {return '<i style="font-size:18px;" class="fa fa-check"></i>';} 
			else {return '<i style="font-size:18px;" class="fa fa-times"></i>';}
	}

	public static function getFormatDate($date) {
		$date = explode("-",$date);
        $date = "$date[2]-$date[1]-$date[0]";  
		return $date;
	}

	public static function getC($id) {
				 
		switch ($id) {

			case '0':
		 		$cir = 'a';
		 		break;

		 	case '1':
		 		$cir = 'a';
		 		break;
		 	
		 	case '2':
		 		$cir = 'San a';
		 		break;
		 		
		 	case '3':
		 		$cir = 'a';
		 		break;
		 		
		 	case '4':
		 		$cir = 'a';
		 		break;		

		 	default:
		 		$cir = '--';
		 		break;
		 } 

		 return $cir;

	}

}
