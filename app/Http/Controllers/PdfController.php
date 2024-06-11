<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Career;
use App\Models\Person;
use App\Models\Bill;
use App\Models\Campus;
use App\Models\Career;
use App\Models\Person;
use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function TimesheetRecords (User $user){
        // dd($user);
        $timesheets = User::where('id', $user->id)->get();
        $pdf = Pdf::loadView('pdf.factura',['timesheets'=>$timesheets]);
    public function TimesheetRecords(User $user)
    {
        // dd($user);
        $timesheets = User::where('id', $user->id)->get();
        $pdf = Pdf::loadView('pdf.factura', ['timesheets' => $timesheets]);
        return $pdf->download();
    }


    public function reportePersona()
    {
        $personas = Person::all();

        $pdf = Pdf::loadView('pdf.reportePersona', ['personas' => $personas]);
        return $pdf->download('reportePersona.pdf');
    }


    // public function Timesheetsucursal (Campus $campus){
    //     // dd($user);
    //     $timesheets = Campus::where('id', $campus->id)->get();
    //     $pdf = Pdf::loadView('pdf.reporteSucursales',['timesheets'=>$timesheets]);
    //     return $pdf->download();
    // }

    public function reporteEstudiantes()
    {
        $estudiantes = Student::all();

        $pdf = Pdf::loadView('pdf.reporteEstudiantes', ['estudiantes' => $estudiantes]);
        return $pdf->download('reporteEstudiantes.pdf');
    }



    public function reporteSucursales()
    {
        $campuses = Campus::all();

        $pdf = Pdf::loadView('pdf.reporteSucursales', ['campuses' => $campuses]);
        return $pdf->download('reporteSucursales.pdf');
    }

    // public function reporteCarreras()
    // {
    //     $carreras = Career::all();

    //     $pdf = Pdf::loadView('pdf.reporteCarreras', ['carreras' => $carreras]);
    //     return $pdf->download('reporteCarreras.pdf');
    // }

    public function reporteCarreras()
    {
        $carreras = DB::table('careers')
                        ->join('campuses', 'careers.campus_id', '=', 'campuses.id')
                        ->select('careers.*', 'campuses.name as campus_name')
                        ->get();
    
        $pdf = PDF::loadView('pdf.reporteCarreras', ['carreras' => $carreras]);
        return $pdf->download('reporteCarreras.pdf');
    }
            ->join('campuses', 'careers.campus_id', '=', 'campuses.id')
            ->select('careers.*', 'campuses.name as campus_name')
            ->get();

        $pdf = PDF::loadView('pdf.reporteCarreras', ['carreras' => $carreras]);
        return $pdf->download('reporteCarreras.pdf');
    }



    //////////////////////////FACTURA//////////////////

    public function factura($id)
    {
        $bills = Bill::find($id);

        // return $bills;

        $pdf = Pdf::loadView('pdf.factura', ['bills' => $bills]);
        return $pdf->download('factura.pdf');
    }
}
