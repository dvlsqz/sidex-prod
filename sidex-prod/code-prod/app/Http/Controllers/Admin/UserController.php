<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User, App\Http\Models\Unit, App\Http\Models\Service, App\Http\Models\Bitacora, App\Http\Models\AssignmentsUnit, App\Http\Models\AssignmentsService;
use Validator, Auth, Hash, Config;

class UserController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getUsers($status){
        switch ($status) {
            case '0':
                $users = User::where('status', '0')->orderBy('id', 'Asc')->paginate(25);
            break;
            
            case '1':
                $users = User::where('status', '1')->orderBy('id', 'Asc')->paginate(25);
            break;
            
            case 'all':
                $users = User::orderby('id','Asc')->paginate(30);
            break;
            
            case 'trash':
                $users = User::onlyTrashed()->orderBy('id', 'Asc')->paginate(25);
            break; 
        }

        if(Auth::user()->role != 0):
            $assig_service = AssignmentsService::with(['ser'])->get()->unique('user_id');
            $assig_services = AssignmentsService::select('user_id')->distinct()->get();
            $assig_unit = AssignmentsUnit::get();
        else:
            $assig_service ="";
            $assig_services = "";
            $assig_unit = "";
        endif;

        $data = [
            'users'=>$users,
            'assig_service' => $assig_service,
            'assig_services' => $assig_services,
            'assig_unit' => $assig_unit
        ];

        return view('admin.users.home',$data);
    }

    public function getUserAdd(){
        return view('admin.users.add');
        
    }

    public function postUserAdd(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'ibm' => 'required|unique:users,ibm',
            'email' => 'email|unique:users,email'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido.',
            'lastname.required' => 'El apellido es requerido.',
            'ibm.required' => 'El numero de IBM es requerido.',
            'ibm.unique' => 'Ya existe un usuario registrado con este numero de IBM',
            'email.email' => 'El formato del correo electronico es invalido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger');
        else:
            $password = Config::get('sidex.default_password');

            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->ibm = e($request->input('ibm'));
            $user->phone = $request->input('phone');
            $user->email = e($request->input('email'));
            $user->password = Hash::make($password);
            $permissions = [
                'home' => true,
                'dashboard' => true,                    
                'services'=>true,
                'telephone_extensions'=>true,
                'telephone_extension_edit'=>true,
                'telephone_extension_search'=>true,
                'report_user'=>true
            ];
    
            $permissions = json_encode($permissions);
            $user->permissions = $permissions;
            $user->role = '2';
            $user->status = '1';
            
            if($user->save()):
                $b = new Bitacora;
                $b->action = "Creación de usuario con IBM: ".$user->ibm;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡El usuario se creo con éxito, ahora puede iniciar sesión!')
                ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getUserEdit($id){

        $u = User::findOrFail($id);
        $data = ['u' => $u];

        return view('admin.users.user_edit',$data);
    }

    public function postUserEdit($id, Request $request){
        $u = User::findOrFail($id);
        $ibm = $u->ibm;

        if($request->input('name') ):
            $u->name = e($request->input('name'));
        endif;

        if($request->input('lastname') ):
            $u->lastname = e($request->input('lastname'));
        endif;

        if($request->input('ibm') ):
            $u->ibm = e($request->input('ibm'));
        endif;

        if($request->input('phone') ):
            $u->phone = $request->input('phone');
        endif;

        if($request->input('email') ):
            $u->email = e($request->input('email'));
        endif;

        $rol_actual = $u->role;
        
        if($request->input('user_type') != $rol_actual ):
            $u->role = $request->input('user_type');

            if($request->input('user_type') == "0" ):
                if(!is_null($u->permissions) || !is_null($u->permissions) ):
                    $permissions = [
                        'home'=> true,
                        'dashboard'=> true,
                        'dashboard_small_stats'=> true,
                        'municipalities' => true,
                        'units' => true,
                        'unit_add' => true,
                        'unit_edit' => true,
                        'unit_delete' => true,
                        'unit_search' => true,
                        'services' => true,
                        'service_add' => true,
                        'service_edit' => true,
                        'service_delete' => true,
                        'service_search' => true,
                        'telephone_extensions' => true,
                        'telephone_extension_add' => true,
                        'telephone_extension_edit' => true,
                        'telephone_extension_location_edit' => true,
                        'telephone_extension_status_edit' => true,
                        'telephone_extension_delete' => true,
                        'telephone_extension_search' => true,
                        'reports' => true,
                        'report_informatica' => true,
                        'report_user' => true,
                        'report_bitacora' => true,
                        'bitacoras' => true,
                        'user_list' => true,
                        'user_add' => true,
                        'user_edit' => true,
                        'user_search' => true,
                        'user_banned' =>true,
                        'user_delete' => true,
                        'user_reset_password' => true,
                        'user_permissions' => true,
                        'user_assignments' => true,
                        'user_assignments_units' => true,
                        'user_assignments_services' => true,
                        'user_assignments_delete' => true,
                        'settings' => true
                    ];

                    $permissions = json_encode($permissions);
                    $u->permissions = $permissions;

                endif;
            elseif($request->input('user_type') == "1" ):
                if(!is_null($u->permissions) || !is_null($u->permissions) ):
                    $permissions = [
                        'home' => true,
                        'dashboard' => true,
                        'units'=>true,
                        'unit_edit'=>true,
                        'services'=>true,
                        'service_add'=>true,
                        'service_edit'=>true,
                        'service_delete'=>true,
                        'service_search'=>true,
                        'telephone_extensions'=>true,
                        'telephone_extension_add'=>true,
                        'telephone_extension_edit'=>true,                        
                        "telephone_extension_location_edit"=>true,
                        "telephone_extension_status_edit"=>true,
                        'telephone_extension_delete'=>true,
                        'telephone_extension_search'=>true,
                        'report_user'=>true,
                        "report_informatica"=>true,
                        'report_bitacora'=>true,
                        'user_list'=>true,
                        'user_add'=>true,
                        'user_edit'=>true,
                        'user_banned'=>true,
                        'user_delete'=>true,
                        'user_reset_password'=>true,
                        'user_permissions'=>true,
                        'user_assignments'=>true,
                        'user_assignments_units'=>true,
                        'user_assignments_services'=>true,
                        'user_assignments_delete'=>true
                    ];                    
            
                    $permissions = json_encode($permissions);
                    $u->permissions = $permissions;

                endif;
            elseif($request->input('user_type') == "2"):
                if(is_null($u->permissions) || !is_null($u->permissions) ):
                    $permissions = [
                        'home' => true,
                        'dashboard' => true,                    
                        'services'=>true,
                        'telephone_extensions'=>true,
                        'telephone_extension_edit'=>true,
                        'telephone_extension_search'=>true,
                        'report_user'=>true
                    ];
            
                    $permissions = json_encode($permissions);
                    $u->permissions = $permissions;

                endif;
            endif;
        endif;

        if($u->save()):
            $b = new Bitacora;
            $b->action = "Actualización de datos de usuario con IBM: ".$ibm;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', 'La información del usuario, se actualizo con éxito!.')
                ->with('typealert', 'success');
            
        endif;
    }

    public function postUserSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'El campo consulta es requerido.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
            switch($request->input('filter')):
                case '0':
                    $users = User::where('ibm','LIKE', '%'.$request->input('search').'%')->orderBy('name','Asc')->paginate(15);
                break;

                case '1':
                    $users = User::where('name','LIKE', '%'.$request->input('search').'%')->orderBy('name','Asc')->paginate(15);
                break;
            endswitch;

        $data = ['users' => $users];

        return view('admin.users.search', $data);
        
        endif;
    }

    public function getUserBanned($id){
        $u = User::findOrFail($id);

        if($u->status == "0"):
            $u->status = "1";
            $msg = "¡Usuario activado nuevamente!.";

            $b = new Bitacora;
            $b->action = "Activación de usuario con IBM: ".$u->ibm;
            $b->user_id = Auth::id();
            $b->save();
        else:
            $u->status = "0";
            $msg = "¡Usuario suspendido con exito!.";

            $b = new Bitacora;
            $b->action = "Suspensión de usuario con IBM: ".$u->ibm;
            $b->user_id = Auth::id();
            $b->save();
        endif;

        if($u->save()):
            return back()->with('messages', $msg)
                ->with('typealert', 'success');
        endif;
    }

    public function getUserPermissions($id){
        $u = User::findOrFail($id);
        $data = ['u' => $u];

        return view('admin.users.user_permissions', $data);
    }

    public function postUserPermissions(Request $request, $id){
        $u = User::findOrFail($id);
        $u->permissions = $request->except(['_token']);

        if($u->save()):
            $b = new Bitacora;
            $b->action = "Actualización de permisos de usuario con IBM: ".$u->ibm;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Los permisos del usuario fueron actualizados con éxito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getUserAssignmentsUnits($id){
        if(Auth::user()->role == "0"):
            $u = User::findOrFail($id);

            $assig_unit = AssignmentsUnit::where('user_id', $id)->paginate(5);
            $assig_service = AssignmentsService::where('user_id', $id)->paginate(5);

            $units = Unit::get();
            $serv = Service::get();
            $assig_units = "";
            $assig_services = "";
        else:
            $u = User::findOrFail($id);

            $user_id = Auth::user()->id;
            $assig_units = AssignmentsUnit::where('user_id',$user_id )->get();
            $assig_services = AssignmentsService::get();
                        
            $units = Unit::get();
            $serv = Service::get();

            $assig_unit = AssignmentsUnit::where('user_id', $id)->paginate(5);
            $assig_service = AssignmentsService::where('user_id', $id)->paginate(5);
        endif;

        $data = [
                'u' => $u,
                'units' => $units,
                'serv' => $serv,
                'assig_unit' => $assig_unit,
                'assig_service' => $assig_service,
                'assig_units'=>$assig_units,
                'assig_services' => $assig_services
            ];

        return view('admin.users.user_assignments_units', $data);
    }

    

    public function postUserAssignmentsUnits($id, Request $request){
        $rules = [
            'unit_id' => 'required'           
        ];

        $messages = [
            'unit_id.required' => 'Se requerido una unidad para asignar.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
            $ass_u = new AssignmentsUnit;

            $ass_u->user_id = $id;
            $ass_u->unit_id = $request->input('unit_id');

            if($ass_u->save()):
                $b = new Bitacora;
                $b->action = "Asginacion de unidad: ".$ass_u->unidad_id." a usuario: ".$ass_u->user_id;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Se asigno la unidad con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;

    }

    public function getUserAssignmentsUnitDelete($id){
        $au = AssignmentsUnit::find($id);
        if($au->delete()):
            $b = new Bitacora;
            $b->action = "Eliminación de asginacion de unidad: ".$au->id;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Asignacion de unidad borrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getUserAssignmentsServices($id){
        if(Auth::user()->role == "0"):
            $u = User::findOrFail($id);

            $assig_unit = AssignmentsUnit::where('user_id', $id)->paginate(5);
            $assig_service = AssignmentsService::where('user_id', $id)->paginate(5);

            $units = Unit::get();
            $serv = Service::get();
            $assig_units = "";
            $assig_services = "";
        else:
            $u = User::findOrFail($id);

            $user_id = Auth::user()->id;
            $assig_units = AssignmentsUnit::where('user_id',$user_id )->get();
            $assig_services = AssignmentsService::get();
                        
            $units = Unit::get();
            $serv = Service::get();

            $assig_unit = AssignmentsUnit::where('user_id', $id)->paginate(5);
            $assig_service = AssignmentsService::where('user_id', $id)->paginate(5);
        endif;

        $data = [
                'u' => $u,
                'units' => $units,
                'serv' => $serv,
                'assig_unit' => $assig_unit,
                'assig_service' => $assig_service,
                'assig_units'=>$assig_units,
                'assig_services' => $assig_services
            ];

        return view('admin.users.user_assignments_services', $data);
    }

    public function postUserAssignmentsServices($id, Request $request){
        $rules = [
            'service_id' => 'required'           
        ];

        $messages = [
            'service_id.required' => 'Se requiere un servicio para asignar.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
            $ass_s = new AssignmentsService;

            $ass_s->user_id = $id;
            $ass_s->service_id = $request->input('service_id');

            if($ass_s->save()):
                $b = new Bitacora;
                $b->action = "Asginacion de servicio: ".$ass_s->service_id." a usuario: ".$ass_s->user_id;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', '¡Se asigno el servicio con exito!.')
                    ->with('typealert', 'success');
            endif;
        endif;

    }

    public function getUserAssignmentsServiceDelete($id){
        $ae = AssignmentsService::find($id);
        if($ae->delete()):
            $b = new Bitacora;
            $b->action = "Eliminación de asginacion de servicio: ".$ae->id;
            $b->user_id = Auth::id();
            $b->save();

            return back()->with('messages', '¡Asignacion de servicio borrada con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function postResetPassword($id, Request $request){
        $rules = [
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
            
        ];

        $messages = [
            'password.required' => 'Escriba su nueva contraseña .',
            'password.min' => 'Su nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.required' => 'Confirme su nueva contraseña .',
            'cpassword.min' => 'SLa confirmación de la nueva contraseña debe de tener al menos 8 caracteres',
            'cpassword.same' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
            ->with('typealert', 'danger')->withInput();
        else:
            $u = User::findOrFail($id);
            $u->password = Hash::make($request->input('password'));

            if($u->save()):
                $b = new Bitacora;
                $b->action = "Restablecimiento de contraseña de usuario con IBM: ".$u->ibm;
                $b->user_id = Auth::id();
                $b->save();
                return back()->with('messages', '¡La contraseña se restablecio con exito!.')
                    ->with('typealert', 'success');
            endif;
          
        endif;
    }

}
