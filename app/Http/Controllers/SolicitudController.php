<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Fun;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class SolicitudController extends Controller {

    public function getData() {
        $solicitudes = Solicitud::select();
        return Datatables::of($solicitudes)

            ->addColumn('numero_raw', function ($solicitud) {
                return "<a href='editar-solicitud/$solicitud->id'>$solicitud->id</a>"; 
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

            ->addColumn('estado', function ($solicitud) {
                return Fun::getIconStatus($solicitud->estado); 
            })
            ->addColumn('acciones', function ($solicitud) {
                return "<a href='eliminar-solicitud/$solicitud->id' class='delReg'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
            })
            ->rawColumns(['numero_raw','fecha_raw','titulo_raw','fechaNec_raw','estado','acciones'])
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
            $solicitud = new Solicitud;
            $solicitud->nombre = $data['nombre'];
            $solicitud->estado = $data['estado'];
            $solicitud->save();
            return redirect('/admin/ver-solicitudes')->with('flash_message','Solicitud creada correctamente...');
        }
       return view('admin.solicitudes.agregar_solicitud');
    }

    /*********************************************************/
    /*                      E D I T                          */
    /*********************************************************/

    public function editSolicitud(Request $request, $id = null) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Solicitud::where(['id'=>$id])->update([
                'nombre' => $data['nombre'],
                'estado' => $data['estado'],
                ]);
            return redirect('/admin/ver-solicitudes')->with('flash_message','Solicitud actualizada correctamente...');
        }
        $solicitud = Solicitud::where(['id'=>$id])->first();
        return view('admin.solicitudes.editar_solicitud')->with(compact('solicitud'));
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
