<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Configuración de Página y Tipografía */
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
        .bg-slate { background-color: #f8fafc; }

        /* Header: Logo y Título Alineados */
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
            max-width: 180px; 
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
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #94a3b8;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .document-number {
            font-size: 24px;
            font-weight: bold;
            color: #0f172a;
        }

        /* Bloques de Información */
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
            margin-bottom: 4px; 
        }
        .info-content { 
            font-size: 13px; 
            font-weight: bold; 
            color: #1e293b; 
        }

        /* Badge de Estado */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
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

        /* Notas y Pie de Página */
        .footer-note { 
            font-size: 10px; 
            color: #64748b; 
            padding: 15px; 
            background: #f8fafc; 
            border-left: 4px solid #0f172a;
            margin-top: 30px;
        }
        .signature-section { 
            width: 100%; 
            margin-top: 60px;
        }
        .signature-box {
            width: 220px;
            text-align: center;
        }
        .signature-line { 
            border-top: 1px solid #cbd5e1; 
            margin: 10px auto;
            width: 100%;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-container">
                {{-- public_path() es esencial para que DomPDF encuentre la imagen en Azure --}}
                <img src="{{ public_path('assets/img/logo_savian.fw.png') }}" class="logo-img">
            </td>
            <td class="header-info">
                <div class="document-type">Albarán de Stock</div>
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
                <div class="info-content">{{ $albaran->centrosTrabajos->nombre ?? 'Sin centro especificado' }}</div>
            </td>
            <td class="info-box" style="text-align: right;">
                <div class="info-label">Fecha de Emisión (Local)</div>
                {{-- Corregimos el desfase de -1 hora forzando Madrid --}}
                <div class="info-content">{{ $albaran->created_at->timezone('Europe/Madrid')->format('d / m / Y H:i') }}</div>
                
                <div style="margin-top: 15px;" class="info-label">Estado de Gestión</div>
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
                <th style="width: 45%;">MODELO / MARCA</th>
                <th style="width: 20%; text-align: right;">ESTADO MÓVIL</th>
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
        <div class="footer-note">
            <strong>AVISO DE ENVÍO:</strong> Este albarán certifica la entrega de los terminales junto con su equipamiento de protección (fundas de silicona). Por favor, revise el contenido y notifique cualquier discrepancia en un plazo de 24h.
        </div>
    @endif

    <table class="signature-section">
        <tr>
            <td style="width: 65%;"></td>
            <td class="signature-box" style="border:none;">
                <div style="font-size: 10px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 50px;">
                    Firma de Recepción
                </div>
                <div class="signature-line"></div>
                <div style="font-size: 9px; color: #cbd5e1;">Fecha: {{ now()->timezone('Europe/Madrid')->format('d/m/Y H:i') }}</div>
            </td>
        </tr>
    </table>

</body>
</html>