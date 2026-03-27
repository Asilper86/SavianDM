<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #1e293b; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #0f172a; font-size: 24px; }
        .datos { margin-bottom: 20px; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; background-color: #f8fafc; }
        .datos p { margin: 5px 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f1f5f9; padding: 12px 10px; border: 1px solid #cbd5e1; text-align: left; font-size: 12px; text-transform: uppercase; }
        td { padding: 10px; border: 1px solid #cbd5e1; font-size: 13px; }
        .footer-note { margin-top: 30px; font-size: 12px; color: #64748b; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ALBARÁN DE ENTREGA</h1>
        <p>Referencia: <strong>#{{ $albaran->id }}</strong></p>
    </div>

    <div class="datos">
        <p><strong>Empresa Origen:</strong> {{ $albaran->empresas->nombre ?? 'N/A' }}</p>
        <p><strong>Centro de Trabajo:</strong> {{ $albaran->centrosTrabajos->nombre ?? 'N/A' }}</p>
        <p><strong>Fecha Emisión:</strong> {{ $albaran->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Estado del Albarán:</strong> {{ strtoupper($albaran->estado) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código / IMEI</th>
                <th>Modelo</th>
                <th>Estado Móvil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albaran->moviles as $movil)
            <tr>
                <td>{{ $movil->codigo }}</td>
                <td>{{ $movil->modelo->nombre ?? 'Sin modelo' }}</td>
                <td>{{ ucfirst($movil->estado) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($fundas)
        <p class="footer-note">* Aviso: Este envío incluye las fundas protectoras correspondientes a los terminales seleccionados.</p>
    @endif

    <div style="margin-top: 50px; text-align: right; font-size: 12px;">
        <p>Firma y Sello:</p>
        <div style="height: 80px;"></div>
        <p>___________________________</p>
    </div>
</body>
</html>