<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Campus;
use App\Models\Career;
use App\Models\PaymentPlan;
use App\Models\Person;
use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
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
        return $pdf->stream('reportePersona.pdf');
    }



    // public function reporteEstudiantes()
    // {
    //     $estudiantes = Student::all();

    //     $pdf = Pdf::loadView('pdf.reporteEstudiantes', ['estudiantes' => $estudiantes]);
    //     return $pdf->download('reporteEstudiantes.pdf');
    // }

    public function reporteEstudiantes()
    {
        $estudiantes = DB::table('students')
            ->join('people', 'students.person_id', '=', 'people.id')
            ->join('payment_plans', 'students.payment_plan_id', '=', 'payment_plans.id')  // Cambiado a 'payment_plans'
            ->select(
                'students.id',
                'people.first_name',
                'people.second_name',
                'people.middle_name',
                'people.last_name',
                'students.email',
                'students.code',
                'payment_plans.identifier as payment_plan_identifier',  // Renombrado a 'payment_plan_identifier' para claridad
                'students.created_at',
                'students.updated_at'
            )
            ->get();

        $pdf = PDF::loadView('pdf.reporteEstudiantes', ['estudiantes' => $estudiantes]);
        return $pdf->stream('reporteEstudiantes.pdf');
    }

    public function reporteSucursales()
    {
        $campuses = Campus::all();

        $pdf = Pdf::loadView('pdf.reporteSucursales', ['campuses' => $campuses]);
        return $pdf->stream('reporteSucursales.pdf');
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
        return $pdf->stream('reporteCarreras.pdf');
    }



    //////////////////////////FACTURA//////////////////

    public function factura($id)
    {
        $bill = Bill::find($id);

        if (!$bill) {
            return redirect()->back()->with('error', 'Factura no encontrada');
        }

        $payments = $bill->billData->map(function ($billData) {
            return $billData->payment;
        });

        if ($payments->isEmpty()) {
            return redirect()->back()->with('error', 'No hay pagos asociados a esta factura');
        }

        $student = $payments->first()->student;

        if (!$student) {
            return redirect()->back()->with('error', 'Estudiante no encontrado');
        }

        $person = Person::where('id', $student->person_id)->first();
        $paymentPlan = PaymentPlan::find($student->payment_plan_id);

        if (!$paymentPlan) {
            return redirect()->back()->with('error', 'Plan de pago no encontrado');
        }

        $career = Career::find($paymentPlan->career_id);

        if (!$career) {
            return redirect()->back()->with('error', 'Carrera no encontrada');
        }

        $pdf = Pdf::loadView('pdf.factura', compact('bill', 'student', 'career', 'payments', 'person'));

        return $pdf->stream('factura.pdf');
    }
}
