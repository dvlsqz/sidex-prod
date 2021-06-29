<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\TelephoneExtension, App\Http\Models\Service, App\Http\Models\Bitacora, App\Http\Models\AssignmentsService, App\Http\Models\AssignmentsUnit;
use Validator, Str, Config, Auth;


class TelephoneExtensionController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getTelephoneExtensions($status){

        if(Auth::user()->role == "0"):
            switch ($status) {
                case '0':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('status', '0')->orderBy('number', 'Asc')->paginate(15);
                break;
                
                case '1':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('status', '1')->orderBy('number', 'Asc')->paginate(15);
                break;
                
                case 'all':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->orderBy('number', 'Asc')->paginate(15);
                break;
                
                case 'trash':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->onlyTrashed()->orderBy('number', 'Asc')->paginate(15);
                break; 
            }
            $assig_service = "";
            $assig_unit = "";
        elseif(Auth::user()->role == "1"):
            switch ($status) {
                case '0':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('status', '0')->orderBy('number', 'Asc')->get();
                break;
                
                case '1':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('status', '1')->orderBy('number', 'Asc')->get();
                break;
                
                case 'all':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->orderBy('number', 'Asc')->get();
                break;
                
                case 'trash':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->onlyTrashed()->orderBy('number', 'Asc')->get();
                break; 
            }
            $assig_unit = AssignmentsUnit::where('user_id', Auth::user()->id)->get();
            $assig_service = "";
        else:
            switch ($status) {
                case '0':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('status', '0')->orderBy('number', 'Asc')->get();
                break;
                
                case '1':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('status', '1')->orderBy('number', 'Asc')->get();
                break;
                
                case 'all':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->orderBy('number', 'Asc')->get();
                break;
                
                case 'trash':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->onlyTrashed()->orderBy('number', 'Asc')->get();
                break; 
            }

            $assig_service = AssignmentsService::where('user_id', Auth::user()->id)->get();
            $assig_unit = "";
        endif;

        
        $data = [
            'telephone_extensions' => $telephone_extensions,
            'assig_service' => $assig_service,
            'assig_unit' => $assig_unit
        ];

    	return view('admin.telephone_extensions.home', $data);
    }

    public function getTelephoneExtensionAdd(){
        $serv = Service::pluck('name', 'id');
        $data = ['serv' => $serv];
    	return view('admin.telephone_extensions.add', $data);
    }

    public function postTelephoneExtensionAdd(Request $request){
        $rules = [
            'number' => 'required',
            'ip' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'number.required' => 'Se requiere un numero para la extension telefonica.',
            'ip.required' => 'Se require la ip de la extension telefonica.',
            'description.image' => 'Se require una descripcion de la extension.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:

            $te = new TelephoneExtension;
            $te->number =  e($request->input('number'));
            $te->direct_number = e($request->input('direct_number'));
            $te->ip = e($request->input('ip'));
            $te->accountable = e($request->input('accountable'));
            $te->description = e($request->input('description'));
            $te->status =  '1';
            $te->service_id = $request->input('service_id');

            if($te->save()):
                $b = new Bitacora;
                $b->action = "Creación de extensión numero ".$te->number;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/telephone_extensions/1')->with('messages', '¡Extension  telefonica creada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getTelephoneExtensionEdit($id){
        $te = TelephoneExtension::findOrFail($id);
        $serv = Service::pluck('name','id');
        $data = ['te' => $te, 'serv' => $serv];

        return view('admin.telephone_extensions.edit', $data);
    }

    public function postTelephoneExtensionEdit(Request $request, $id){
        $rules = [
            'number' => 'required',
            'ip' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'number.required' => 'Se requiere un numero para la extension telefonica.',
            'ip.required' => 'Se require la ip de la extension telefonica.',
            'description.image' => 'Se require una descripcion de la extension.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
            $te = TelephoneExtension::findOrFail($id);
            $te->number =  e($request->input('number'));
            $te->direct_number = e($request->input('direct_number'));
            $te->ip = e($request->input('ip'));
            $te->accountable = e($request->input('accountable'));
            $te->description = e($request->input('description'));
            $te->status =  $request->input('status');
            $te->service_id = $request->input('service_id');

            if($te->save()):
                $b = new Bitacora;
                $b->action = "Actualización de datos de extensión numero ".$te->number;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Extensión telefonica actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function postTelephoneExtensionSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return redirect('/admin/telephone_extensions/1')->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
            switch($request->input('filter')):
                case '0':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('number','LIKE', '%'.$request->input('search').'%')->where('status',$request->input('status'))->orderBy('number','Asc')->get();
                break;

                case '1':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('description','LIKE', '%'.$request->input('search').'%')->orderBy('number','Asc')->get();
                break;
            endswitch;

        $data = ['telephone_extensions' => $telephone_extensions];

        return view('admin.telephone_extensions.search', $data);
        
        endif;
    }

    public function getTelephoneExtensionDelete($id){
        $te = TelephoneExtension::findOrFail($id);

        if($te->delete()):
            $b = new Bitacora;
            $b->action = "Eliminación de extensión numero ".$te->number;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Extensión telefonica enviada a la papelera de reciclaje!.')
                    ->with('typealert', 'success');
        endif;
    }

    public function getTelephoneExtensionRestore($id){
        $te = TelephoneExtension::onlyTrashed()->where('id',$id)->first();
        if($te->restore()):
            $b = new Bitacora;
            $b->action = "Restauración de extensión numero ".$te->number;
            $b->user_id = Auth::id();
            $b->save();

            return redirect('admin/telephone_extension/'.$te->id.'/edit')->with('messages', '¡Esta extensión telefonica se restauro con éxito!.')
                    ->with('typealert', 'success');
        endif;
    }

}
