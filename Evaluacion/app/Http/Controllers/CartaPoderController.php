<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use App\Models\CartaPoder;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CartaPoderController extends Controller
{
    public function generar($asignacion_id)
    {
        $asignacion = Asignacion::with(['usuario', 'dispositivo'])->findOrFail($asignacion_id);

        // Generar QR
        $codigoQR = QrCode::format('png')->size(200)->generate("Asignación ID: {$asignacion->id}");

        // Guardar el QR como archivo
        $rutaQR = 'storage/qrs/qr_' . $asignacion->id . '.png';
        file_put_contents(public_path($rutaQR), $codigoQR);

        // Generar PDF
        $pdf = Pdf::loadView('pdf.carta_poder', [
            'asignacion' => $asignacion,
            'qr' => $rutaQR
        ]);

        $rutaPDF = 'storage/cartas/carta_' . $asignacion->id . '.pdf';
        $pdf->save(public_path($rutaPDF));

        // Guardar registro en BD
        CartaPoder::create([
            'asignacion_id' => $asignacion->id,
            'ruta_pdf' => $rutaPDF,
            'codigo_qr' => $rutaQR,
            'generado_por' => auth()->id()
        ]);

        return response()->download(public_path($rutaPDF));
    }
}
