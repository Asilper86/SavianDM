<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Tipografía y Base */
        @page { margin: 1cm; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #334155; 
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* Colores Corporativos */
        .text-main { color: #0f172a; }
        .bg-main { background-color: #0f172a; }
        .text-muted { color: #64748b; }

        /* Header Estilo Factura */
        .header-table { width: 100%; border-bottom: 2px solid #f1f5f9; padding-bottom: 20px; margin-bottom: 30px; }
        .header-logo { font-size: 28px; font-weight: 900; letter-spacing: -1px; color: #0f172a; }
        .header-info { text-align: right; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }

        /* Bloques de Información */
        .info-section { width: 100%; margin-bottom: 40px; }
        .info-box { width: 48%; vertical-align: top; }
        .info-label { font-size: 10px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px; }
        .info-content { font-size: 13px; font-weight: bold; color: #1e293b; }

        /* Tabla de Productos */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { 
            background-color: #f8fafc; 
            color: #475569; 
            font-size: 11px; 
            font-weight: bold; 
            text-transform: uppercase; 
            padding: 12px 15px; 
            border-bottom: 2px solid #e2e8f0;
            text-align: left;
        }
        td { 
            padding: 12px 15px; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 12px; 
            color: #334155;
        }
        .row-even { background-color: #ffffff; }
        .row-odd { background-color: #fcfcfc; }

        /* Badge de Estado */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #e2e8f0;
        }

        /* Footer y Firma */
        .footer { margin-top: 60px; }
        .signature-box { width: 200px; float: right; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 50px; }
        .footer-note { font-size: 11px; color: #94a3b8; margin-top: 40px; padding: 15px; border-left: 4px solid #e2e8f0; background: #f8fafc; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td style="border:none; padding:0;" class="header-logo">
                SAVIAN <span style="font-weight: 300; color: #64748b;">STOCK</span>
            </td>
            <td style="border:none; padding:0;" class="header-info">
                <span class="text-muted">Albarán de Entrega</span><br>
                <span style="font-size: 18px; font-weight: bold; color: #0f172a;">#{{ $albaran->id }}</span>
            </td>
        </tr>
    </table>

    <table class="info-section">
        <tr>
            <td class="info-box" style="border:none;">
                <div class="info-label">Cliente / Empresa Origen</div>
                <div class="info-content">{{ $albaran->empresas->nombre ?? 'N/A' }}</div>
                <div style="margin-top: 10px;" class="info-label">Centro de Trabajo</div>
                <div class="info-content">{{ $albaran->centrosTrabajos->nombre ?? 'Sin centro' }}</div>
            </td>
            <td class="info-box" style="border:none; text-align: right;">
                <div class="info-label">Fecha de Emisión</div>
                <div class="info-content">{{ $albaran->created_at->format('d / m / Y') }}</div>
                <div style="margin-top: 10px;" class="info-label">Estado</div>
                <div class="status-badge" style="background-color: {{ $albaran->estado == 'entregado' ? '#dcfce7' : '#fef3c7' }}; color: {{ $albaran->estado == 'entregado' ? '#166534' : '#92400e' }};">
                    {{ $albaran->estado }}
                </div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 40%;">CÓDIGO / IMEI</th>
                <th style="width: 40%;">MODELO</th>
                <th style="width: 20%; text-align: right;">ESTADO MÓVIL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albaran->moviles as $index => $movil)
            <tr class="{{ $index % 2 == 0 ? 'row-even' : 'row-odd' }}">
                <td style="font-weight: bold; font-family: monospace;">{{ $movil->codigo }}</td>
                <td>{{ $movil->modelo->nombre ?? 'N/A' }}</td>
                <td style="text-align: right; color: #64748b;">{{ ucfirst($movil->estado) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($fundas)
        <div class="footer-note">
            <strong>AVISO TÉCNICO:</strong> Este envío incluye las fundas protectoras correspondientes a los terminales detallados anteriormente. Por favor, verifique el contenido al recibirlo.
        </div>
    @endif

    <div class="footer">
        <div class="signature-box">
            <div class="info-label" style="margin-bottom: 40px;">Recibido por (Firma y Sello)</div>
            <div style="font-size: 10px; color: #cbd5e1;">{{ now()->format('d/m/Y H:i') }}</div>
        </div>
    </div>

</body>
</html>