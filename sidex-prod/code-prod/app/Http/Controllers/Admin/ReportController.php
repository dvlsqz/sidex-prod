<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\TelephoneExtension, App\Http\Models\Service, App\Http\Models\Bitacora, App\Http\Models\Municipality, App\Http\Models\Unit;
use Validator, Str, Config, Auth, PDF;

class ReportController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getReport(){
        return view('admin.reports.home');
    }

    public function getReportBitacora(){
        $bitacora = Bitacora::with(['user'])->orderBy('id', 'Desc')->get();
        $fecha = date('d/m/Y');
        
        $data = ['bitacora'=>$bitacora, 'fecha'=>$fecha];

        $pdf = PDF::loadView('admin.reports.bitacora',$data);
        return $pdf->download('reporte-bitacora-'.$fecha.'.pdf');
    }

    public function getReportUser(){
        $telephone_extension = TelephoneExtension::with(['ser'])->where('status', '1')->orderBy('number', 'Asc')->get();
        $fecha = date('d/m/Y');
        
        $data = ['telephone_extension'=>$telephone_extension, 'fecha'=>$fecha];

        $pdf = PDF::loadView('admin.reports.extensiones',$data);
        return $pdf->download('reporte-listado-extensiones-'.$fecha.'.pdf');
    }

    public function getReporInformatica(){
        $telephone_extension = TelephoneExtension::with(['ser'])->orderBy('number', 'Asc')->get();
        $fecha = date('d/m/Y');
        
        $data = ['telephone_extension'=>$telephone_extension, 'fecha'=>$fecha];

        $pdf = PDF::loadView('admin.reports.reporte_info',$data);
        return $pdf->download('reporte-listado-extensiones-'.$fecha.'.pdf');
    }
}
