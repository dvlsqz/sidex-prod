<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Unit;
use Config, Auth, Validator;

class ApiJsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['getUnitsSection']);
    }

    function getUnitsSection($section, Request $request){
        $items_x_page = Config::get('sidex.products_per_page');
        switch ($section):
            case 'home':
                $units = Unit::orderBy('name','Asc')->paginate($items_x_page);
            break;

            case 'search':
                $rules = [
                    'search_query' => 'required'
                ];
        
                $messages = [
                    'search_query.required' => 'El campo consulta es requerido.'
                ];
        
                $validator = Validator::make($request->all(),$rules,$messages);
        
                if($validator->fails()):
                    return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')
                    ->with('typealert', 'danger')->withInput();
                else:
                    $units = Unit::where('name','LIKE', '%'.$request->input('search_query').'%')->orderBy('name','Asc')->get();
                    
                endif;
            break;
            
            default:
                $units = Unit::orderBy('name','Asc')->paginate($items_x_page);
            break;

        endswitch;

        return $units;
    }


}