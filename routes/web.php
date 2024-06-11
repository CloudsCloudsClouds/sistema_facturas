<?php

use App\Http\Controllers\PdfController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/pruebas/{user}', function () {
//     $pdf = Pdf::loadView('pdf.factura');
//     return $pdf->download('example.pdf');
// })->name('pdf.factura');

Route::get('/pdf/generate/timesheet/{user}', [PdfController::class,'TimesheetRecords'])->name('pdf.factura');


Route::get('/pdf/reporte-estudiantes', [PdfController::class, 'reporteEstudiantes'])->name('pdf.reporteEstudiantes');
Route::get('/pdf/reporte-personas', [PdfController::class, 'reportePersona'])->name('pdf.reportePersona');
Route::get('/pdf/reporte-sucursales', [PdfController::class, 'reporteSucursales'])->name('pdf.reporteSucursales');
Route::get('/pdf/reporte-carreras', [PdfController::class, 'reporteCarreras'])->name('pdf.reporteCarreras');



Route::get('/pdf/reporte-factura/{id}',[PdfController::class, 'factura'])->name('pdf.factura');
