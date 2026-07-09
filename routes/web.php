<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PARTE 1: ESTRUCTURAS GLOBALES Y TABLAS DINÁMICAS
|--------------------------------------------------------------------------
*/

// Ejercicio 1: Catálogo de Clientes VIP (Uso de Objetos e Interpolación Básica)
Route::get('/clientes/vip', function () {
    // 1. Crear un arreglo que contenga un mínimo de 3 objetos usando (object)[...]
    $clientes = [
        (object)[
            'id' => 1, 
            'nombre' => 'Carlos Mendoza', 
            'telefono' => '7744-1234', 
            'puntos_altruistas' => 150
        ],
        (object)[
            'id' => 2, 
            'nombre' => 'Ana Beatriz Ramos', 
            'telefono' => '2255-6789', 
            'puntos_altruistas' => 320
        ],
        (object)[
            'id' => 3, 
            'nombre' => 'Roberto Flores', 
            'telefono' => '6100-4321', 
            'puntos_altruistas' => 95
        ]
    ];

    // 2. Lógica de Renderizado: Estructura de la tabla en la variable $html
    $html = "<h2>Catálogo de Clientes VIP</h2>";
    $html .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    $html .= "<thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Puntos Altruistas</th>
                </tr>
              </thead>";
    $html .= "<tbody>";

    // Bucle foreach para recorrer los objetos e interpolar sus propiedades
    foreach ($clientes as $cliente) {
        $html .= "<tr>
                    <td>{$cliente->id}</td>
                    <td>{$cliente->nombre}</td>
                    <td>{$cliente->telefono}</td>
                    <td>{$cliente->puntos_altruistas}</td>
                  </tr>";
    }

    $html .= "</tbody>";
    $html .= "</table>";

    // 3. Al final, imprime la variable con un echo
    echo $html;
});


// Ejercicio 2: Panel de Proveedores Internacionales
Route::get('/proveedores/internacionales', function () {
    // 1. Colección de objetos proveedores
    $proveedores = [
        (object)[
            'empresa' => 'Pfizer Global', 
            'pais_origen' => 'Estados Unidos', 
            'medicamento_principal' => 'Lipitor', 
            'tiempo_entrega_dias' => 10
        ],
        (object)[
            'empresa' => 'Bayer AG', 
            'pais_origen' => 'Alemania', 
            'medicamento_principal' => 'Aspirina', 
            'tiempo_entrega_dias' => 20 // Mayor a 15 para activar advertencia
        ],
        (object)[
            'empresa' => 'Novartis', 
            'pais_origen' => 'Suiza', 
            'medicamento_principal' => 'Voltaren', 
            'tiempo_entrega_dias' => 12
        ]
    ];

    // 2. Almacenar en una variable todo el código
    $tablaProveedores = "<h2>Panel de Proveedores Internacionales</h2>";
    $tablaProveedores .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    $tablaProveedores .= "<thead>
                            <tr>
                                <th>Empresa</th>
                                <th>País de Origen</th>
                                <th>Medicamento Principal</th>
                                <th>Tiempo de Entrega (Días)</th>
                            </tr>
                          </thead>";
    $tablaProveedores .= "<tbody>";

    foreach ($proveedores as $prov) {
        // Lógica: Si tiempo_entrega_dias es mayor a 15, incluye advertencia de texto
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

    $tablaProveedores .= "</tbody>";
    $tablaProveedores .= "</table>";

    // 3. Todo el bloque debe imprimirse mediante un solo echo
    echo $tablaProveedores;
});


// Ejercicio 3: Inventario Automatizado de Lotes de Medicamentos
Route::get('/lotes/inventario', function () {
    // 1. Arreglo de objetos que representa los lotes de la farmacia
    $lotes = [
        (object)[
            'codigo_lote' => 'LOT-2026A', 
            'nombre_medicamento' => 'Insulina Humana', 
            'cantidad_cajas' => 50, 
            'temperatura_requerida_celsius' => 4 // Menor o igual a 5°C
        ],
        (object)[
            'codigo_lote' => 'LOT-2026B', 
            'nombre_medicamento' => 'Paracetamol 500mg', 
            'cantidad_cajas' => 200, 
            'temperatura_requerida_celsius' => 22
        ],
        (object)[
            'codigo_lote' => 'LOT-2026C', 
            'nombre_medicamento' => 'Vacuna BCG', 
            'cantidad_cajas' => 35, 
            'temperatura_requerida_celsius' => 2 // Menor o igual a 5°C
        ]
    ];

    $inventarioHtml = "<h2>Inventario Automatizado de Lotes de Medicamentos</h2>";
    $inventarioHtml .= "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
    $inventarioHtml .= "<thead>
                            <tr>
                                <th>Código Lote</th>
                                <th>Medicamento</th>
                                <th>Cantidad (Cajas)</th>
                                <th>Temperatura Requerida</th>
                            </tr>
                          </thead>";
    $inventarioHtml .= "<tbody>";

    // 2. Lógica de Control: Al recorrer los objetos para armar la tabla HTML, evalúa la temperatura
    foreach ($lotes as $lote) {
        $nombreFinal = $lote->nombre_medicamento;

        // Si la temperatura es menor o igual a 5°C, agrega la etiqueta
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

    $inventarioHtml .= "</tbody>";
    $inventarioHtml .= "</table>";

    // 3. Imprime el bloque final
    echo $inventarioHtml;
});