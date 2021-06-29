<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Service, App\Http\Models\Unit, App\Http\Models\TelephoneExtension;
use Config, Auth, Validator, PDF;

class UsetController extends Controller
{
    function getServices($id,$filtrado){
        switch ($filtrado) {

            case 'todos':
                $services = Service::with(['unit'])->where('unit_id', $id)->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'a':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;

            case 'b':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'c':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'd':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'e':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'f':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'g':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'h':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'i':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'j':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'k':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'l':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'm':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'n':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'ñ':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'o':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'p':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'q':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'r':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 's':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 't':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'u':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'v':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'w':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'x':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'y':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
    
            case 'z':
                $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE',$filtrado.'%')->orderBy('name', 'Asc')->paginate(15);
                $units = Unit::pluck('name', 'id');
                $idService = $id;
            break;
        }

        

        $data = [
                'services' => $services, 
                'units' => $units,
                'idService' => $idService
            ];


        return view('viewsse.services.services', $data);
    }

    public function postServiceSearch($id,Request $request){
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
                    $services = Service::with(['unit'])->where('unit_id', $id)->where('name','LIKE', '%'.$request->input('search').'%')->orderBy('name','Asc')->paginate(50);
                    $units = Unit::pluck('name', 'id');
                    $idService = $id;
                break;

                case '1':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('number','LIKE', '%'.$request->input('search').'%')->first();
                    
                    

                    if(is_null($telephone_extensions)):
                        return back()->withErrors($validator)->with('messages', '¡Numero de Extension no encontrado!.')
                            ->with('typealert', 'danger')->withInput();
                    else:
                        $services = Service::with(['unit'])->where('id', $telephone_extensions->ser->id)->orderBy('name','Asc')->paginate(50);
                    $units = Unit::pluck('name', 'id');
                    $idService = $id;
                    endif;
                break;

                case '2':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('description','LIKE', '%'.$request->input('search').'%')->first();
                    
                    

                    if(is_null($telephone_extensions)):
                        return back()->withErrors($validator)->with('messages', '¡Numero de Extension no encontrado!.')
                            ->with('typealert', 'danger')->withInput();
                    else:
                        $services = Service::with(['unit'])->where('id', $telephone_extensions->ser->id)->orderBy('name','Asc')->paginate(50);
                    $units = Unit::pluck('name', 'id');
                    $idService = $id;
                    endif;
                break;
            endswitch;

            $data = [
                'services' => $services, 
                'units' => $units,
                'idService' => $idService
            ];

        return view('viewsse.services.search', $data);
        
        endif;
    }

    function getTelephoneExtensions($id){
        $telephone_extensions = TelephoneExtension::where('service_id', $id)->orderBy('number', 'Asc')->paginate(15);
        $service = Service::where('id', $id)->get();
        $idService = $id;

        $data = [
                'telephone_extensions' => $telephone_extensions, 
                'service' => $service,
                'idService' => $idService
            ];
        return view('viewsse.telephone_extensions.telephone_extensions', $data);
    }

    public function postTelephoneExtensionSearch($id,Request $request){
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
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('number','LIKE', '%'.$request->input('search').'%')->orderBy('number','Asc')->get();
                    $service = Service::where('id', $id)->get();
                    $idService = $id;
                break;

                case '1':
                    $telephone_extensions = TelephoneExtension::with(['ser'])->where('description','LIKE', '%'.$request->input('search').'%')->orderBy('number','Asc')->get();
                    $service = Service::where('id', $id)->get();
                    $idService = $id;
                break;
            endswitch;

            $data = [
                'telephone_extensions' => $telephone_extensions, 
                'service' => $service,
                'idService' => $idService
            ];

        return view('viewsse.telephone_extensions.search', $data);
        
        endif;
    }

    public function getReportExtension($id){
        $telephone_extension = TelephoneExtension::with(['ser'])->where('status', '1')->orderBy('number', 'Asc')->get();
        $fecha = date('d/m/Y');
        $idUnidad = $id;
        
        $data = [
            'telephone_extension'=>$telephone_extension, 
            'fecha'=>$fecha,
            'idUnidad' => $idUnidad
        ];

        $pdf = PDF::loadView('report-extension',$data);
        return $pdf->download('listado-extensiones-'.$fecha.'.pdf');
    }
}
