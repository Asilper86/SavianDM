<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0cm; }
        
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            color: #334155; 
            line-height: 1.5;
            margin: 0;
            padding: 1cm 1.5cm;
        }

        .brand-color { color: #07CBBB; }
        .text-main { color: #1e293b; }
        .text-muted { color: #64748b; }

        /* Header */
        .header-table { width: 100%; margin-bottom: 35px; }
        .logo-img { max-width: 150px; height: auto; }
        .document-title-container { text-align: right; }
        .document-type { font-size: 10px; text-transform: uppercase; letter-spacing: 3px; color: #07CBBB; font-weight: bold; }
        .document-number { font-size: 26px; font-weight: 900; color: #0f172a; margin-top: 5px; }

        /* Info Grid */
        .info-grid { width: 100%; margin-bottom: 30px; border-collapse: collapse; }
        .info-card { width: 62%; padding: 20px; background-color: #f8fafc; border-radius: 15px; vertical-align: top; }
        .info-meta { width: 38%; padding-left: 25px; vertical-align: top; text-align: right; }
        .label { font-size: 8px; font-weight: bold; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px; }
        .value { font-size: 12px; font-weight: bold; color: #1e293b; margin-bottom: 10px; }

        /* Badge */
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 50px; font-size: 9px; font-weight: bold; text-transform: uppercase; }

        /* Main Table (Para equipos) */
        .main-table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 10px; }
        .main-table th { background-color: #1e293b; color: white; font-size: 9px; font-weight: bold; text-transform: uppercase; padding: 10px 15px; text-align: left; }
        .main-table th:first-child { border-radius: 10px 0 0 0; }
        .main-table th:last-child { border-radius: 0 10px 0 0; }
        .main-table td { padding: 10px 15px; border-bottom: 1px solid #f1f5f9; font-size: 11px; color: #475569; }
        .emphasis { font-weight: bold; color: #0f172a; font-family: 'Courier', monospace; }

        /* Section Titles */
        .section-title { font-size: 10px; font-weight: bold; color: #07CBBB; text-transform: uppercase; margin-top: 30px; margin-bottom: 12px; border-left: 3px solid #07CBBB; padding-left: 10px; }

        /* --- NUEVO DISEÑO TRABAJADORES (BLOQUES DE TEXTO) --- */
        .workers-container { margin-top: 5px; }
        .worker-entry { 
            display: inline-block; 
            background-color: #f1f5f9; 
            border: 1px solid #e2e8f0;
            padding: 8px 12px; 
            border-radius: 12px; 
            margin-right: 8px; 
            margin-bottom: 8px;
        }
        .worker-name { font-size: 11px; font-weight: bold; color: #1e293b; display: block; }
        .worker-time { font-size: 9px; color: #64748b; margin-top: 2px; }

        /* Text Area */
        .description-box { background-color: #fdfdfd; border: 1px dashed #e2e8f0; border-radius: 12px; padding: 15px; margin-top: 5px; font-size: 11px; color: #334155; line-height: 1.6; }

        /* Footer */
        .footer-note { font-size: 9px; color: #475569; padding: 12px; background: #eff6ff; border-radius: 10px; margin-top: 30px; border: 1px solid #dbeafe; }
        
        /* Firmas */
        .signatures-table { width: 100%; margin-top: 40px; border-collapse: collapse; }
        .signature-box { width: 45%; text-align: center; vertical-align: bottom; padding: 0 15px; }
        .signature-img { max-width: 200px; max-height: 80px; width: auto; height: auto; margin: 0 auto 8px; display: block; object-fit: contain; }
        .signature-label { font-size: 9px; font-weight: bold; color: #94a3b8; text-transform: uppercase; border-top: 2px solid #e2e8f0; padding-top: 8px; display: block; letter-spacing: 1px; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td><img src="{{ public_path('assets/img/logo_savian.fw.png') }}" class="logo-img"></td>
            <td class="document-title-container">
                <div class="document-type">Albarán de Stock</div>
                <div class="document-number">#{{ str_pad($albaran->id, 5, '0', STR_PAD_LEFT) }}</div>
            </td>
        </tr>
    </table>

    <table class="info-grid">
        <tr>
            <td class="info-card">
                <div class="label">Cliente / Empresa</div>
                <div class="value" style="font-size: 15px; color: #07CBBB;">{{ $albaran->empresas->nombre ?? 'N/A' }}</div>
                <div class="label">Centro de Trabajo</div>
                <div class="value">{{ $albaran->centrosTrabajos->nombre ?? 'General' }}</div>
                @if($albaran->lugar)
                    <div class="label">Lugar / Referencia</div>
                    <div class="value">{{ $albaran->lugar }}</div>
                @endif
                <div class="label">Responsable Recepción</div>
                <div class="value">{{ $albaran->nombre_firmante }}</div>
            </td>
            <td class="info-meta">
                <div class="label">Fecha de Emisión</div>
                <div class="value">{{ $albaran->fecha ? \Carbon\Carbon::parse($albaran->fecha)->format('d/m/Y') : $albaran->created_at->format('d/m/Y') }}</div>
                <div class="label">Estado</div>
                <div class="status-badge" style="background-color: {{ $albaran->estado == 'entregado' ? '#dcfce7' : '#fef3c7' }}; color: {{ $albaran->estado == 'entregado' ? '#166534' : '#92400e' }};">
                    {{ strtoupper($albaran->estado) }}
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Equipos Entregados</div>
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 30%;">IMEI / Código</th>
                <th style="width: 50%;">Modelo y Marca</th>
                <th style="width: 20%; text-align: right;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($albaran->moviles as $index => $movil)
            <tr class="{{ $index % 2 == 0 ? '' : 'row-even' }}">
                <td class="emphasis">{{ $movil->codigo }}</td>
                <td>{{ $movil->modelo->nombre ?? 'N/A' }}</td>
                <td style="text-align: right;">{{ ucfirst($movil->estado) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- SECCIÓN DE TRABAJADORES COMO BLOQUES DE TEXTO -->
    @if($albaran->trabajadores_datos && count($albaran->trabajadores_datos) > 0)
    <div class="section-title">Personal Técnico Asignado</div>
    <div class="workers-container">
        @foreach($albaran->trabajadores_datos as $trabajador)
            <div class="worker-entry">
                <span class="worker-name">{{ $trabajador['nombre'] }}</span>
                <span class="worker-time">Horario: {{ $trabajador['entrada'] }} - {{ $trabajador['salida'] }}</span>
            </div>
        @endforeach
    </div>
    @endif

    @if($albaran->descripcion)
    <div class="section-title">Detalle de los Trabajos ({{ strtoupper($albaran->tipo_trabajo ?? 'VISITA') }})</div>
    <div class="description-box">
        {{ $albaran->descripcion }}
    </div>
    @endif

    @if($fundas)
        <div class="footer-note">
            <strong>AVISO:</strong> Los terminales incluyen fundas de protección. Verifique el estado antes de firmar.
        </div>
    @endif

    <table class="signatures-table">
        <tr>
            <td class="signature-box">
                @if($albaran->firma_trabajador)
                    <img src="{{ $albaran->firma_trabajador }}" class="signature-img">
                @endif
                <span class="signature-label">Firma del Trabajador</span>
            </td>
            <td style="width: 10%;"></td>
            <td class="signature-box">
                @if($albaran->firma_cliente)
                    <img src="{{ $albaran->firma_cliente }}" class="signature-img">
                @endif
                <span class="signature-label">Firma del Cliente</span>
            </td>
        </tr>
    </table>

    <div style="font-size: 7px; color: #cbd5e1; margin-top: 30px; text-align: center;">
        ID Transacción: {{ strtoupper(uniqid()) }} - Fecha y Hora: {{ now()->format('d/m/Y H:i:s') }}
    </div>

</body>
</html>