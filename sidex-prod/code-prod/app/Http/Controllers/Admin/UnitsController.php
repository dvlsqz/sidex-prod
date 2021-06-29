<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Unit, App\Http\Models\Municipality, App\Http\Models\Bitacora, App\Http\Models\AssignmentsUnit;
use Validator, Str, Config, Auth;

class UnitsController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome($type){
        if(Auth::user()->role == "0"):
            $units = Unit::where('type_unit', $type)->orderBy('name', 'Asc')->paginate(9);
        else:
            $units = Unit::where('type_unit', $type)->orderBy('name', 'Asc')->get();
        endif;
        $municipalities = Municipality::pluck('name', 'id');
        $assig_unit = AssignmentsUnit::get();

        $data = [
                'units' => $units, 
                'municipalities' => $municipalities,
                'assig_unit' => $assig_unit
            ];

    	return view('admin.units.home', $data);
    }

    public function postUnitAdd(Request $request){
    	$rules = [
    		'name' => 'required',
            'phone' => 'required',
            'type_unit' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la unidad.',
            'phone.required' => 'Se require un numero de PBX para la unidad.',
            'type_unit.required' => 'Se require un tipo de unidad.'
    	];

    	$validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else: 
            /*$path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('image')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, ' ',$request->file('image')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;*/

            $u = new Unit;
            $u->code = e($request->input('code'));
            $u->name = e($request->input('name'));
            $u->phone = e($request->input('phone'));
            $u->address = e($request->input('address'));
            //$u->file_path = date('Y-m-d');
            //$u->image= $filename;
            $u->type_unit = $request->input('type_unit');
            $u->municipality_id = $request->input('municipality_id');
            
            if($u->save()):
                /*if($request->hasFile('image')):
                    $fl = $request->image->storeAs($path, $filename, 'uploads');
                endif;*/

                $b = new Bitacora;
                $b->action = "Creación de unidad ".$u->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Unidad creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
    	endif;
    }

    public function getUnitEdit($id){
        $unit = Unit::find($id);
        $municipalities = Municipality::pluck('name', 'id');
        $data = ['unit' => $unit,
                 'municipalities' => $municipalities
                ];
        return view('admin.units.edit', $data);
    }

    public function postUnitEdit(Request $request, $id){
        $rules = [
    		'name' => 'required',
            'phone' => 'required',
            'type_unit' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para la unidad.',
            'phone.required' => 'Se require un numero de PBX para la unidad.',
            'type_unit.required' => 'Se require un tipo de unidad.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                ->with('typealert', 'danger');
        else:
            

            $u = Unit::find($id);
            $u->code = e($request->input('code'));
            $u->name = e($request->input('name'));
            $u->phone = e($request->input('phone'));
            $u->address = e($request->input('address'));            
            $u->type_unit = $request->input('type_unit');
            $u->municipality_id = $request->input('municipality_id');

            /*if($request->hasFile('image')):
                $actual_image = $u->image;
                $actual_file_path = $u->file_path;

                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, ' ',$request->file('image')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $fl = $request->image->storeAs($path, $filename, 'uploads');

                $u->file_path = date('Y-m-d');
                $u->image= $filename;

                if(!is_null($actual_image)):
                    unlink($upload_path.'/'.$actual_file_path.'/'.$actual_image);
                endif;
            endif;*/

            if($u->save()):
                $b = new Bitacora;
                $b->action = "Actualización de datos de unidad ".$u->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Unidad actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getUnitDelete($id){
        $u = Unit::find($id);
        if($u->delete()):
            
            $b = new Bitacora;
            $b->action = "Eliminación de unidad ".$u->name;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Unidad borrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
