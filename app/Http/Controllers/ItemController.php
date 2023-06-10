<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Fun;
use Yajra\Datatables\Datatables;

class ItemController extends Controller {

    public function dataItemsEdit(Request $request) {

        //$etapasBoletas = EtapaBoleta::where('boleta','=',$request->get('boleta'))->orderBy('id', 'desc');
        $items = Item::where('idSolicitud','=',$request->get('solicitud'))->orderBy('id', 'desc');

       
        dd($items);
        
        $solicitudes = Solicitud::select()->orderBy('id', 'desc');
        
        return Datatables::of($solicitudes)

            ->orderColumn('id', '-id $1')

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
    
    public function deleteItemSesion(Request $request) {
        if ($request->isMethod('post')) {
            $itemId = $request->input('itemId');
    
            // Obtener el array de items guardado en la sesión
            $items = session()->get('items', []);
    
            // Verificar si la clave del item existe en el array
            if (array_key_exists($itemId, $items)) {
                // Eliminar el item del array utilizando la clave
                unset($items[$itemId]);
    
                // Reindexar el array
                $items = array_values($items);
    
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
            //$ruta = public_path('fotos');
            $ruta = ('fotos/');
            $foto->move($ruta, $nombreFoto);
            return response()->json(['nombreFoto' => $nombreFoto]);
        }
    }

    public function getDataItems() {

        $items = session()->get('items', []);
        $data = [];

        //dd($items);
    
        foreach ($items as $key => $item) {

            if( isset($item['foto']) ) {
               $foto = '<img src="'.url('/').'/fotos/'.$item['foto'].'" style="max-height:50px;border-radius: 5px;">';   
            } else {
                $foto = null;
            }

            /*
            ->addColumn('numero_raw', function ($plan) {
                return "<a href='' class='btn-table hvr-grow' data-toggle='modal' data-target='#editPlanBoleta' 
                data-nro=".$plan->nro." 
                data-boleta=".$plan->boleta." 
                data-vto=".Carbon::parse($plan->fecha)->format('d-m-Y')."
                data-importe=".$plan->importe." 
                data-cuotas=".$plan->cuotas." 
                 >".$plan->nro."</a>";
             })
            */
            /*
            $numero = "<a href='' class='btn-table hvr-grow' data-toggle='modal' data-target='#editPlanBoleta' 
            data-nro=".$plan->nro." 
             >".$key + 1."</a>";
            */          
            
            $data[] = [
                'numero' => $key + 1,
                'nombre' => $item['nombreItem'],
                'medida' => Fun::getUnidadesDeMedidaNombre($item['medidaItem']), 
                'cantidad' => $item['cantidadItem'],
                'foto' => $foto,
                'prioridad' => Fun::getPrioridadNombre($item['prioridadItem']),
                'acciones' => "<a href='#' data-id=".$key." class='delete-item'><i class='fa fa-trash-o' aria-hidden='true'></i></a>"
            ];
        }
            return response()->json(['data' => $data]);
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
