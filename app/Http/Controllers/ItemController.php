<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Fun;
use Yajra\Datatables\Datatables;

class ItemController extends Controller {

    
    public function deleteItemSesion(Request $request) {
        if ($request->isMethod('post')) {
            $itemId = $request->input('itemId');

            // Obtener el array de items guardado en la sesión
            $items = session()->get('items', []);

            // Verificar si la clave del item existe en el array
            if (array_key_exists($itemId, $items)) {
                // Eliminar el item del array utilizando la clave
                unset($items[$itemId]);

                // Actualizar el array en la sesión
                session()->put('items', $items);

                return response()->json(['success' => true]);
            }
        }

    return response()->json(['success' => false]);
    }
    
        
    public function uploadImage(Request $request) {
    
        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');
            $nombreFoto = time() . '_' . $foto->getClientOriginalName();
            $ruta = public_path('fotos');
            $foto->move($ruta, $nombreFoto);

            return response()->json(['nombreFoto' => $nombreFoto]);

        }
    }

    public function getDataItems() {

        $items = session()->get('items', []);
        $data = [];

        //dd($items);
    
        foreach ($items as $key => $item) {
            $data[] = [
                'numero' => $key + 1,
                'nombre' => $item['nombreItem'],
                'acciones' => "<a href='#' data-id=".$key." class='delete-item'><i class='fa fa-trash-o' aria-hidden='true'></i></a>"
                //'acciones' => "<button class='btn btn-danger btn-sm delete-item'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"
                //return '<button class="btn btn-danger btn-sm delete-item" data-id="' + full.id + '">Eliminar</button>';
                // Agrega más campos según sea necesario
            ];
        }
    
        return response()->json(['data' => $data]);
    
        }


    public function getDataXXX() {

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
    
    public function addItemSesion(Request $request) {
        
        if ($request->isMethod('post')) {
           
            $item = $request->input('item');

            // Obtener el array de items guardado en la sesión
            $items = session()->get('items');
          
            // Agregar el nuevo item al array
            $items[] = $item;
         
            // Guardar el array actualizado en la sesión
            
            session()->put('items', $items); 

            return response()->json(['success' => true]);
        }

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
