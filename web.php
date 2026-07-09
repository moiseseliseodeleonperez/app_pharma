<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';


// --- RUTA DE CATEGORÍAS ---
Route::get('/categorias', function () {
    $categorias = json_decode(json_encode([
        ["codigo" => "A02", "categoria" => "Medicamentos para el tratamiento de Trastornos causados por Ácidos"],
        ["codigo" => "A03", "categoria" => "Medicamentos contra Trastornos Funcionales Gastrointestinales"],
        ["codigo" => "A04", "categoria" => "Medicamentos Antieméticos y Antinauseosos"],
        ["codigo" => "A06", "categoria" => "Medicamentos para el Estreñimiento"],
        ["codigo" => "A07", "categoria" => "Medicamentos Antidiarreicos, Antiinflamatorios y Antiinfecciosos Intestinales"],
        ["codigo" => "A10", "categoria" => "Medicamentos usados en Diabetes"],
        ["codigo" => "A11", "categoria" => "Vitaminas"],
        ["codigo" => "A12", "categoria" => "Suplementos Minerales"]
    ]));

    $html = "<h2>Listado de Categorías</h2>";
    $html .= "<table border='1' cellpadding='5' cellspacing='0'>";
    $html .= "<thead><tr><th>CÓDIGO</th><th>CATEGORÍA</th></tr></thead><tbody>";

    foreach ($categorias as $cat) {
        $html .= "<tr><td>{$cat->codigo}</td><td>{$cat->categoria}</td></tr>";
    }

    $html .= "</tbody></table>";
    return $html;
});

// --- RUTA DE MEDICAMENTOS ---
Route::get('/medicamentos', function () {
    $medicamentos = json_decode(json_encode([
        ["codigo" => "A02BA02", "num" => "1", "nombre" => "Ranitidina", "dosis" => "50 mg", "forma" => "Líquidos parenterales", "via" => "IM/IV"],
        ["codigo" => "A02BA03", "num" => "2", "nombre" => "Famotidina", "dosis" => "40 mg", "forma" => "Sólidos orales", "via" => "VO"],
        ["codigo" => "A02BC01", "num" => "3", "nombre" => "Omeprazol", "dosis" => "20 mg", "forma" => "Sólidos orales", "via" => "VO"],
        ["codigo" => "A02BC01", "num" => "4", "nombre" => "Omeprazol", "dosis" => "40 mg", "forma" => "Sólidos parenterales", "via" => "IV"],
        ["codigo" => "A03BA01", "num" => "1", "nombre" => "Atropina (Sulfato)", "dosis" => "0.5-1 mg/mL", "forma" => "Líquidos parenterales", "via" => "SC/IM/IV"],
        ["codigo" => "A03BA03", "num" => "2", "nombre" => "Hiosciamina (bromuro de n-butil hioscina)", "dosis" => "10 mg", "forma" => "Sólidos orales", "via" => "VO"],
        ["codigo" => "A03BA03", "num" => "3", "nombre" => "Hiosciamina (bromuro de n-butil hioscina)", "dosis" => "20 mg/mL", "forma" => "Líquidos parenterales", "via" => "IM/IV"],
        ["codigo" => "A03FA01", "num" => "4", "nombre" => "Metoclopramida (clorhidrato)", "dosis" => "5 mg/mL", "forma" => "Líquidos parenterales", "via" => "IM/IV"],
        ["codigo" => "A03FA01", "num" => "5", "nombre" => "Metoclopramida (clorhidrato)", "dosis" => "10 mg", "forma" => "Sólidos orales", "via" => "VO"],
        ["codigo" => "A04AA01", "num" => "1", "nombre" => "Ondansetron", "dosis" => "8 mg", "forma" => "Sólidos orales", "via" => "VO"],
        ["codigo" => "A04AA01", "num" => "2", "nombre" => "Ondansetron", "dosis" => "2 mg/mL", "forma" => "Líquidos parenterales", "via" => "IV"],
        ["codigo" => "A04AA02", "num" => "3", "nombre" => "Granisetron", "dosis" => "1 mg", "forma" => "Sólidos orales", "via" => "VO"],
        ["codigo" => "A04AA02", "num" => "4", "nombre" => "Granisetron", "dosis" => "1 mg/mL", "forma" => "Líquidos parenterales", "via" => "IV"],
        ["codigo" => "R06AA11", "num" => "5", "nombre" => "Dimenhidrinato", "dosis" => "50 mg", "forma" => "Sólidos orales", "via" => "VO"],
        ["codigo" => "R06AA11", "num" => "6", "nombre" => "Dimenhidrinato", "dosis" => "50 mg/mL", "forma" => "Líquidos parenterales", "via" => "IM/IV"]
    ]));

    $html = "<h2>Listado de Medicamentos</h2>";
    $html .= "<table border='1' cellpadding='5' cellspacing='0'>";
    $html .= "<thead><tr><th>Código</th><th>№</th><th>Nombre</th><th>Dosis</th><th>Forma farmacéutica</th><th>Vía de administración</th></tr></thead><tbody>";

    foreach ($medicamentos as $med) {
        $html .= "<tr>
                    <td>{$med->codigo}</td>
                    <td>{$med->num}</td>
                    <td>{$med->nombre}</td>
                    <td>{$med->dosis}</td>
                    <td>{$med->forma}</td>
                    <td>{$med->via}</td>
                  </tr>";
    }

    $html .= "</tbody></table>";
    return $html;
});