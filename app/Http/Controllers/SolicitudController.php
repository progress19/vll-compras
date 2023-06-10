<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Sector;
use App\Item;
use App\Fun;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class SolicitudController extends Controller {

    public function getData() {
        
        $solicitudes = Solicitud::select()->orderBy('id', 'desc');
        
        return Datatables::of($solicitudes)

            ->orderColumn('id', '-id $1')

            ->addColumn('numero_raw', function ($solicitud) {
                return "<a class='btn-table hvr-grow' href='editar-solicitud/$solicitud->id'>$solicitud->id</a>"; 
            })

            ->addColumn('titulo_raw', function ($solicitud) {
                return "<a href='editar-solicitud/$solicitud->id'>$solicitud->titulo</a>"; 
            })

            ->addColumn('fecha_raw', function ($solicitud) {
                return Carbon::parse($solicitud->fecha)->format('d-m-Y'); 
            })  

            ->addColumn('fechaNec_raw', function ($solicitud) {
                return Carbon::parse($solicitud->fechaNec)->format('d-m-Y'); 
            })
            
            ->addColumn('usuario_raw', function ($solicitud) {
                return $solicitud->usuario->name;
            }) 

            ->addColumn('sector_raw', function ($solicitud) {
                return $solicitud->sector->nombre;
            }) 

            ->addColumn('estado', function ($solicitud) {
                return Fun::getStatusSolicitud($solicitud->estado); 
            })

            ->addColumn('acciones', function ($solicitud) {
                return "<a href='eliminar-solicitud/$solicitud->id' class='delReg'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
            })
            ->rawColumns(['numero_raw','fecha_raw','titulo_raw','fechaNec_raw','usuario_raw','estado','acciones','sector'])
            ->make(true);
    }

    public function verSolicitudes() {
        return view('admin.solicitudes.ver_solicitudes');
    }

    /*********************************************************/
    /*                      A D D                            */
    /*********************************************************/
    
    public function addSolicitud(Request $request) {
        
        if ($request->isMethod('post')) {
                       
            $data = $request->all();

            /* Save Solicitud */
            
            $fechaNec = explode("-",$data['fechaNec']);
            $fechaNec = "$fechaNec[2]-$fechaNec[1]-$fechaNec[0]"; 

            $solicitud = new Solicitud;
            $solicitud->titulo = $data['titulo'];
            $solicitud->idSector = $data['idSector'];
            $solicitud->fechaNec = $fechaNec;
            $solicitud->idUsuario = $request->user()->id;
            $solicitud->estado = 1;
            $solicitud->save();

            /* Save Items solicitud */

            $i = 1;
           
            foreach ( session()->get('items') as $item_arr ) {

                $item = new Item;

                $item->idItem = $i;
                $item->idSolicitud = $solicitud->id;
                $item->nombre = $item_arr['nombreItem'];
                $item->idUnidad = $item_arr['medidaItem'];
                $item->cantidad = $item_arr['cantidadItem'];
                $item->idPrioridad = $item_arr['prioridadItem'];
                $item->descripcion = $item_arr['descripcionItem'];
                
                if (isset($item_arr['foto'])) {
                    $item->foto = $item_arr['foto'];    
                } else {$item->foto = null;    }
                
                $item->save();
                
                $i++;
            
            } 

            //dd(session()->get('items'));

 /*
  0 => array:8 [▼
    "_token" => "rCLDVx63DWCkHycjKvcNJKJ6PERvW8WWvZw7LcLj"
    "baseUrl" => "http://localhost/vll-compras/public"
    "nombreItem" => "1"
    "medidaItem" => "1"
    "cantidadItem" => "1"
    "prioridadItem" => "1"
    "descripcionItem" => "1 des"
    "foto" => "1686168499_2.jpg"
  ]
*/

            return redirect('/admin/ver-solicitudes')->with('flash_message','Solicitud creada correctamente...');
        }

        session()->forget('items');
       
        $sectores = Sector::where(['estado'=>1])->orderBy('nombre','asc')->pluck('nombre', 'id');
        return view('admin.solicitudes.nueva_solicitud')->with(compact('sectores'));
    }

    /*********************************************************/
    /*                      E D I T                          */
    /*********************************************************/

    public function editSolicitud(Request $request, $id = null) {

        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Solicitud::where(['id'=>$id])->update([
                //'titulo' => $data['titulo'],
                'estado' => $data['estado'],
                ]);
            return redirect('/admin/ver-solicitudes')->with('flash_message','Solicitud actualizada correctamente...');
        }
    
        $solicitud = Solicitud::where(['id'=>$id])->first();
        $sectores = Sector::where(['estado'=>1])->orderBy('nombre','asc')->pluck('nombre', 'id');
        return view('admin.solicitudes.editar_solicitud')->with(compact('solicitud','sectores'));
    
    }

    /*********************************************************/
    /*                   D E L E T E                       */
    /*********************************************************/

    public function deleteSolicitud(Request $request, $id = null) {
        if (!empty($id)) {
            Solicitud::where(['id'=>$id])->delete();
            return redirect('/admin/ver-solicitudes')->with('flash_message','Solicitud eliminada...');
        }
        $solicitudes = Solicitud::get();
        return view('admin.solicitudes.ver_solicitudes')->with(compact('solicitudes'));
    }

}
