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

        // ✅ Generar QR en formato SVG (no requiere imagick)
        $codigoQR = base64_encode(QrCode::format('svg')->size(200)->generate("Asignación ID: {$asignacion->id}"));

        // Generar PDF directamente con el QR en base64
        $pdf = Pdf::loadView('pdf.carta_poder', [
            'asignacion' => $asignacion,
            'qr' => $codigoQR
        ]);

        $rutaPDF = 'storage/cartas/carta_' . $asignacion->id . '.pdf';
        $pdf->save(public_path($rutaPDF));

        CartaPoder::create([
            'asignacion_id' => $asignacion->id,
            'ruta_pdf' => $rutaPDF,
            'codigo_qr' => null,
            'generado_por' => auth()->id()
        ]);

        return response()->download(public_path($rutaPDF));
    }
}
