<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PARTE 1: ESTRUCTURAS GLOBALES Y TABLAS DINÁMICAS
|--------------------------------------------------------------------------
*/

// Ejercicio 1: Catálogo de Clientes VIP
Route::get('/clientes/vip', function () {
    $clientes = [
        (object)['id' => 1, 'nombre' => 'Carlos Mendoza', 'telefono' => '7744-1234', 'puntos_altruistas' => 150],
        (object)['id' => 2, 'nombre' => 'Ana Beatriz Ramos', 'telefono' => '2255-6789', 'puntos_altruistas' => 320],
        (object)['id' => 3, 'nombre' => 'Roberto Flores', 'telefono' => '6100-4321', 'puntos_altruistas' => 95]
    ];

    $html = "<h2>Catálogo de Clientes VIP</h2>";
    $html .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; font-family: sans-serif;'>";
    $html .= "<thead><tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Puntos Altruistas</th></tr></thead><tbody>";

    foreach ($clientes as $cliente) {
        $html .= "<tr>
                    <td>{$cliente->id}</td>
                    <td>{$cliente->nombre}</td>
                    <td>{$cliente->telefono}</td>
                    <td>{$cliente->puntos_altruistas}</td>
                  </tr>";
    }
    $html .= "</tbody></table>";
    echo $html;
});

// Ejercicio 2: Panel de Proveedores Internacionales
Route::get('/proveedores/internacionales', function () {
    $proveedores = [
        (object)['empresa' => 'Pfizer Global', 'pais_origen' => 'Estados Unidos', 'medicamento_principal' => 'Lipitor', 'tiempo_entrega_dias' => 10],
        (object)['empresa' => 'Bayer AG', 'pais_origen' => 'Alemania', 'medicamento_principal' => 'Aspirina', 'tiempo_entrega_dias' => 20],
        (object)['empresa' => 'Novartis', 'pais_origen' => 'Suiza', 'medicamento_principal' => 'Voltaren', 'tiempo_entrega_dias' => 12]
    ];

    $tablaProveedores = "<h2>Panel de Proveedores Internacionales</h2>";
    $tablaProveedores .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; font-family: sans-serif;'>";
    $tablaProveedores .= "<thead><tr><th>Empresa</th><th>País de Origen</th><th>Medicamento Principal</th><th>Tiempo de Entrega (Días)</th></tr></thead><tbody>";

    foreach ($proveedores as $prov) {
        $advertencia = "";
        if ($prov->tiempo_entrega_dias > 15) {
            $advertencia = " <b style='color: red;'>(Demora Crítica)</b>";
        }

        $tablaProveedores .= "<tr>
                                <td>{$prov->empresa}</td>
                                <td>{$prov->pais_origen}</td>
                                <td>{$prov->medicamento_principal}</td>
                                <td>{$prov->tiempo_entrega_dias}{$advertencia}</td>
                              </tr>";
    }
    $tablaProveedores .= "</tbody></table>";
    echo $tablaProveedores;
});

// Ejercicio 3: Inventario Automatizado de Lotes de Medicamentos (Corregido)
Route::get('/lotes/inventario', function () {
    $lotes = [
        (object)['codigo_lote' => 'LOT-2026A', 'nombre_medicamento' => 'Insulina Humana', 'cantidad_cajas' => 50, 'temperatura_requerida_celsius' => 4],
        (object)['codigo_lote' => 'LOT-2026B', 'nombre_medicamento' => 'Paracetamol 500mg', 'cantidad_cajas' => 200, 'temperatura_requerida_celsius' => 22],
        (object)['codigo_lote' => 'LOT-2026C', 'nombre_medicamento' => 'Vacuna BCG', 'cantidad_cajas' => 35, 'temperatura_requerida_celsius' => 2]
    ];

    $inventarioHtml = "<h2>Inventario Automatizado de Lotes de Medicamentos</h2>";
    $inventarioHtml .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; font-family: sans-serif;'>";
    $inventarioHtml .= "<thead><tr><th>Código Lote</th><th>Medicamento</th><th>Cantidad (Cajas)</th><th>Temperatura Requerida</th></tr></thead><tbody>";

    foreach ($lotes as $lote) {
        $nombreFinal = $lote->nombre_medicamento;
        if ($lote->temperatura_requerida_celsius <= 5) {
            $nombreFinal .= " <span style='color: blue; font-weight: bold;'>[Requiere Cadena de Frío]</span>";
        }

        $inventarioHtml .= "<tr>
                                <td>{$lote->codigo_lote}</td>
                                <td>{$nombreFinal}</td>
                                <td>{$lote->cantidad_cajas}</td>
                                <td>{$lote->temperatura_requerida_celsius}°C</td>
                              </tr>";
    }
    $inventarioHtml .= "</tbody></table>";
    echo $inventarioHtml;
});

/*
|--------------------------------------------------------------------------
| PARTE 2: GESTIÓN DE FACTURACIÓN (ESTRUCTURAS COMPLEJAS Y PARÁMETROS)
|--------------------------------------------------------------------------
*/

// Ejercicio 4: Historial General de Facturas de Clientes
Route::get('/facturas/clientes/historial', function () {
    $facturas = [
        (object)['num_factura' => 'F-001', 'cliente' => 'Juan Pérez', 'fecha_emision' => '2026-07-10', 'total_pagar' => 150.00, 'estado' => 'Pagada'],
        (object)['num_factura' => 'F-002', 'cliente' => 'María López', 'fecha_emision' => '2026-07-12', 'total_pagar' => 85.50, 'estado' => 'Pendiente'],
        (object)['num_factura' => 'F-003', 'cliente' => 'Carlos Mendoza', 'fecha_emision' => '2026-07-13', 'total_pagar' => 320.00, 'estado' => 'Pagada'],
        (object)['num_factura' => 'F-004', 'cliente' => 'Ana Gómez', 'fecha_emision' => '2026-07-13', 'total_pagar' => 45.00, 'estado' => 'Pendiente']
    ];

    $html = "<h2>Historial General de Facturas de Clientes</h2>";
    $html .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%; text-align: left; font-family: sans-serif;'>
                <thead>
                    <tr style='background-color: #f5f5f5;'>
                        <th>N° Factura</th><th>Cliente</th><th>Fecha Emisión</th><th>Total a Pagar</th><th>Estado</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($facturas as $f) {
        $estado_visual = $f->estado;
        if ($f->estado === 'Pendiente') {
            $estado_visual = "<span style='color: red; font-weight: bold;'>⚠️ PENDIENTE DE COBRO</span>";
        }

        $html .= "<tr>
                    <td>{$f->num_factura}</td>
                    <td>{$f->cliente}</td>
                    <td>{$f->fecha_emision}</td>
                    <td>\${$f->total_pagar}</td>
                    <td>{$estado_visual}</td>
                  </tr>";
    }
    $html .= "</tbody></table>";
    echo $html;
});

// Ejercicio 5: Detalle de Factura de Cliente Específica (Ficha Técnica - Corregido)
Route::get('/facturas/clientes/detalle/{numero}', function ($numero) {
    $facturas = [
        (object)['num_factura' => 'F-001', 'cliente' => 'Juan Pérez', 'fecha_emision' => '2026-07-10', 'total_pagar' => 150.00, 'estado' => 'Pagada'],
        (object)['num_factura' => 'F-002', 'cliente' => 'María López', 'fecha_emision' => '2026-07-12', 'total_pagar' => 85.50, 'estado' => 'Pendiente'],
        (object)['num_factura' => 'F-003', 'cliente' => 'Carlos Mendoza', 'fecha_emision' => '2026-07-13', 'total_pagar' => 320.00, 'estado' => 'Pagada'],
        (object)['num_factura' => 'F-004', 'cliente' => 'Ana Gómez', 'fecha_emision' => '2026-07-13', 'total_pagar' => 45.00, 'estado' => 'Pendiente']
    ];

    $encontrada = null;
    foreach ($facturas as $f) {
        if ($f->num_factura === $numero) {
            $encontrada = $f;
            break;
        }
    }

    if ($encontrada) {
        $vista = "
        <div style='border: 2px solid #333; padding: 20px; max-width: 400px; font-family: sans-serif; background: #fff;'>
            <h2>Ficha de Factura</h2>
            <p><strong>Código:</strong> {$encontrada->num_factura}</p>
            <ul>
                <li><strong>Cliente:</strong> <strong>{$encontrada->cliente}</strong></li>
                <li><strong>Fecha:</strong> {$encontrada->fecha_emision}</li>
                <li><strong>Total:</strong> \${$encontrada->total_pagar}</li>
                <li><strong>Estado:</strong> {$encontrada->estado}</li>
            </ul>
        </div>";
    } else {
        $vista = "<h1 style='font-family: sans-serif; color: red;'>Factura No Encontrada</h1>";
    }

    echo $vista;
});

// Ejercicio 6: Libro de Facturas de Proveedores (Cálculo de Totales)
Route::get('/facturas/proveedores/resumen', function () {
    $proveedores = [
        (object)["proveedor" => "Laboratorio Central S.A.", "nrc" => "12345-6", "monto_sin_iva" => 500.00],
        (object)["proveedor" => "Droguería San José", "nrc" => "78910-1", "monto_sin_iva" => 1200.00],
        (object)["proveedor" => "FarmaMayoristas", "nrc" => "45678-2", "monto_sin_iva" => 350.00]
    ];

    $total_neto = 0;
    $total_iva = 0;
    $total_bruto = 0;

    $html = "<h2>Libro de Facturas de Proveedores</h2>";
    $html .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%; text-align: left; font-family: sans-serif;'>
                <thead>
                    <tr style='background-color: #e9ecef;'>
                        <th>Proveedor</th><th>NRC</th><th>Monto sin IVA</th><th>IVA (13%)</th><th>Monto Total</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($proveedores as $p) {
        $iva_fila = $p->monto_sin_iva * 0.13;
        $total_fila = $p->monto_sin_iva + $iva_fila;

        $total_neto += $p->monto_sin_iva;
        $total_iva += $iva_fila;
        $total_bruto += $total_fila;

        $html .= "<tr>
                    <td>{$p->proveedor}</td>
                    <td>{$p->nrc}</td>
                    <td>\$" . number_format($p->monto_sin_iva, 2) . "</td>
                    <td>\$" . number_format($iva_fila, 2) . "</td>
                    <td>\$" . number_format($total_fila, 2) . "</td>
                  </tr>";
    }

    $html .= "</tbody>
                <tfoot style='background-color: #f8f9fa; font-weight: bold;'>
                    <tr>
                        <td colspan='2'>TOTALES</td>
                        <td>\$" . number_format($total_neto, 2) . "</td>
                        <td>\$" . number_format($total_iva, 2) . "</td>
                        <td>\$" . number_format($total_bruto, 2) . "</td>
                    </tr>
                </tfoot>
              </table>";

    echo $html;
});