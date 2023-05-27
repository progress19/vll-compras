<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Fun;
use Yajra\Datatables\Datatables;

class SectorController extends Controller {

    public function getData() {
        $sectores = Sector::select()->orderBy('nombre', 'asc');
        return Datatables::of($sectores)
            ->addColumn('nombre_raw', function ($sector) {
                return "<a href='editar-sector/$sector->id'>$sector->nombre</a>"; 
            })
            ->addColumn('estado', function ($sector) {
                return Fun::getIconStatus($sector->estado); 
            })
            ->addColumn('acciones', function ($sector) {
                return "<a href='eliminar-sector/$sector->id' class='delReg'><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
            })
            ->rawColumns(['nombre_raw','estado','acciones'])
            ->make(true);
    }

    public function verSectores() {
        $sectores = Sector::orderBy('nombre','asc')->get();
        return view('admin.sectores.ver_sectores')->with(compact('sectores'));
    }

    /*********************************************************/
    /*                      A D D                            */
    /*********************************************************/
    
    public function addSector(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $sector = new Sector;
            $sector->nombre = $data['nombre'];
            $sector->estado = $data['estado'];
            $sector->save();
            return redirect('/admin/ver-sectores')->with('flash_message','Centro de costos creado correctamente...');
        }
       return view('admin.sectores.agregar_sector');
    }

    /*********************************************************/
    /*                      E D I T                          */
    /*********************************************************/

    public function editSector(Request $request, $id = null) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Sector::where(['id'=>$id])->update([
                'nombre' => $data['nombre'],
                'estado' => $data['estado'],
                ]);
            return redirect('/admin/ver-sectores')->with('flash_message','Centro actualizado correctamente...');
        }
        $sector = Sector::where(['id'=>$id])->first();
        return view('admin.sectores.editar_sector')->with(compact('sector'));
    }


    /*********************************************************/
    /*                   D E L E T E                       */
    /*********************************************************/

    public function deleteSector(Request $request, $id = null) {
        if (!empty($id)) {
            Sector::where(['id'=>$id])->delete();
            return redirect('/admin/ver-sectores')->with('flash_message','Centro de costos eliminado...');
        }
        $sectores = Sector::get();
        return view('admin.sectores.ver_sectores')->with(compact('sectores'));
    }

}
