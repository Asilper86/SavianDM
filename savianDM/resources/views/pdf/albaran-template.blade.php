<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Configuración de Página */
        @page { margin: 0.8cm 1.2cm; }
        
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #334155; 
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* Colores y Utilidades */
        .text-main { color: #0f172a; }
        .text-muted { color: #64748b; }
        .font-bold { font-weight: bold; }

        /* Header: Logo y Título */
        .header-table { 
            width: 100%; 
            border-bottom: 2px solid #f1f5f9; 
            padding-bottom: 15px; 
            margin-bottom: 25px; 
        }
        .logo-container {
            width: 50%;
            vertical-align: middle;
            border: none;
        }
        .logo-img {
            max-width: 180px; /* Ajustado para que no sature el espacio */
            height: auto;
            display: block;
        }
        .header-info { 
            width: 50%;
            text-align: right; 
            vertical-align: middle; 
            border: none;
        }
        .document-type {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            margin-bottom: 4px;
        }
        .document-number {
            font-size: 24px;
            font-weight: bold;
            color: #0f172a;
        }

        /* Bloques de Información (Grid de 2 columnas con tabla) */
        .info-table { 
            width: 100%; 
            margin-bottom: 30px; 
        }
        .info-box { 
            width: 50%; 
            vertical-align: top; 
            border: none;
        }
        .info-label { 
            font-size: 9px; 
            font-weight: bold; 
            color: #64748b; 
            text-transform: uppercase; 
            margin-bottom: 3px; 
            letter-spacing: 0.5px;
        }
        .info-content { 
            font-size: 13px; 
            font-weight: bold; 
            color: #1e293b; 
        }

        /* Badge de Estado */
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 5px;
        }

        /* Tabla de Artículos */
        .items-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        .items-table th { 
            background-color: #f8fafc; 
            color: #475569; 
            font-size: 10px; 
            font-weight: bold; 
            text-transform: uppercase; 
            padding: 12px 15px; 
            border-bottom: 2px solid #e2e8f0;
            text-align: left;
        }
        .items-table td { 
            padding: 12px 15px; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 11px; 
            color: #334155;
        }
        .row-odd { background-color: #fcfcfc; }

        /* Footer y Avisos */
        .footer-section { margin-top: 40px; }
        .note-box { 
            font-size: 10px; 
            color: #64748b; 
            padding: 15px; 
            background: #f8fafc; 
            border-left: 4px solid #0f172a;
            margin-bottom: 40px;
        }
        .signature-container { 
            width: 100%; 
            margin-top: 50px;
        }
        .signature-line { 
            border-top: 1px solid #cbd5e1; 
            width: 200px; 
            margin: 10px 0;
        }
        .signature-text { 
            font-size: 10px; 
            color: #94a3b8; 
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-container">
                {{-- Nota: public_path apunta a la carpeta 'public' de tu Laravel --}}
                <img src="{{ public_path('assets/img/logo_savian.fw.png') }}" class="logo-img">
            </td>
            <td class="header-info">
                <div class="document-type">Albarán de Entrega</div>
                <div class="document-number">#{{ $albaran->id }}</div>
            </td>
        </tr>
    </table>

    <table class="info-table">
        <tr>
            <td class="info-box">
                <div class="info-label">Cliente / Empresa</div>
                <div class="info-content">{{ $albaran->empresas->nombre ?? 'N/A' }}</div>
                
                <div style="margin-top: 15px;" class="info-label">Centro de Trabajo</div>
                <div class="info-content">{{ $albaran->centrosTrabajos->nombre ?? 'Sin centro asignado' }}</div>
            </td>
            <td class="info-box" style="text-align: right;">
                <div class="info-label">Fecha de Emisión</div>
                <div class="info-content">{{ $albaran->created_at->format('d / m / Y') }}</div>
                
                <div style="margin-top: 15px;" class="info-label">Estado del Envío</div>
                <div class="status-badge" style="background-color: {{ $albaran->estado == 'entregado' ? '#dcfce7' : '#fef3c7' }}; color: {{ $albaran->estado == 'entregado' ? '#166534' : '#92400e' }};">
                    {{ strtoupper($albaran->estado) }}
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 35%;">CÓDIGO / IMEI</th>
                <th style="width: 45%;">MODELO</th>
                <th style="width: 20%; text-align: right;">ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albaran->moviles as $index => $movil)
            <tr class="{{ $index % 2 != 0 ? 'row-odd' : '' }}">
                <td style="font-weight: bold; font-family: monospace; color: #0f172a;">{{ $movil->codigo }}</td>
                <td>{{ $movil->modelo->nombre ?? 'N/A' }}</td>
                <td style="text-align: right; color: #64748b;">{{ ucfirst($movil->estado) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($fundas)
        <div class="footer-section">
            <div class="note-box">
                <strong>AVISO TÉCNICO:</strong> Este documento confirma la entrega de los terminales detallados junto con sus respectivas fundas protectoras de silicona. Por favor, verifique el estado del precinto al recibirlo.
            </div>
        </div>
    @endif

    <table class="signature-container">
        <tr>
            <td style="width: 60%; border:none;"></td>
            <td style="width: 40%; text-align: center; border:none;">
                <div class="signature-text">Recibido por (Firma y Sello)</div>
                <div style="height: 70px;"></div> {{-- Espacio para la firma --}}
                <div class="signature-line"></div>
                <div style="font-size: 9px; color: #cbd5e1;">Fecha: {{ now()->format('d/m/Y H:i') }}</div>
            </td>
        </tr>
    </table>

</body>
</html>