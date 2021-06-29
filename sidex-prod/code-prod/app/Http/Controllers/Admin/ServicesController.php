<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Service, App\Http\Models\Unit, App\Http\Models\Bitacora, App\Http\Models\AssignmentsService, App\Http\Models\AssignmentsUnit;
use Validator, Str, Config, Auth;

class ServicesController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){
        if(Auth::user()->role == "0"):
            $services = Service::with(['unit'])->orderBy('name', 'Asc')->paginate(9);
            $units = Unit::get();
            $assig_units = "";
            $assig_service = "";
            $assig_unit = "";
        else:
            $services = Service::with(['unit'])->orderBy('name', 'Asc')->get();
            $user_id = Auth::user()->id;

            $assig_units = AssignmentsUnit::where('user_id',$user_id )->get();
            
            $units = Unit::get();

            $assig_service = AssignmentsService::where('user_id',$user_id )->get();
            $assig_unit = AssignmentsUnit::get();

            //return $assig_service;
        endif;

        
        

        $data = [
                'services' => $services, 
                'units' => $units,                
                'assig_service' => $assig_service,
                'assig_unit' => $assig_unit,
                'assig_units'=>$assig_units
            ];

    	return view('admin.services.home', $data);
    }

    public function postServiceAdd(Request $request){
    	$rules = [
    		'name' => 'required',
            'unit_id' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el servicio.',
            'unit_id.required' => 'Se require asignar una unidad al servicio.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else:
            $s = new Service;
            $s->name = e($request->input('name'));
            $s->unit_id = $request->input('unit_id');
            
            if($s->save()):

                $b = new Bitacora;
                $b->action = "Creación de servicio ".$s->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Servicio creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getServiceEdit($id){
        
        $service = Service::find($id);
        $units = Unit::pluck('name', 'id');
        $data = ['service' => $service,
                 'units' => $units
                ];
        return view('admin.services.edit', $data);
    }

    public function postServiceEdit(Request $request, $id){
        $rules = [
    		'name' => 'required',
            'unit_id' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el servicio.',
            'unit_id.required' => 'Se require asignar una unidad al servicio.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                ->with('typealert', 'danger');
        else:
            

            $s = Service::find($id);
            $s->name = e($request->input('name'));
            $s->unit_id = $request->input('unit_id');

            if($s->save()):
                $b = new Bitacora;
                $b->action = "Actualización de datos de servicio ".$s->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Servicio actualizado y guardado con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getServiceDelete($id){
        $s = Service::find($id);
        if($s->delete()):
            $b = new Bitacora;
            $b->action = "Eliminación de servicio ".$s->name;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Servicio borrado con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
