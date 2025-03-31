<?php
// php -S localhost:8000
set_time_limit(0);
require_once 'Faker.php';

$faker_types = include 'fakerTypes.php';

$faker = new Faker();

$tabela = $_POST['tabela'] ?? '';
$quantidade = intval($_POST['quantidade'] ?? 0);
$colunas = $_POST['colunas'] ?? [];
$tipos = $_POST['tipos'] ?? [];
$range_mins = $_POST['range_min'] ?? [];
$range_maxs = $_POST['range_max'] ?? [];


$campos = [];
foreach ($colunas as $index => $col) {
    if (!empty($col) AND !empty($tipos[$index])) {
        $campos[] = ['coluna' => trim($col), 'tipo' => trim($tipos[$index])];
    }
}

if (empty($tabela) OR $quantidade <= 0 OR empty($campos)) {
    die('Parâmetros não informados');
}

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="inserts.sql"');

for ($i = 0; $i < $quantidade; $i++) {
    $valores = [];

    foreach ($campos as $index => $campo) {
        $tipo = $campo['tipo'];
        $coluna = $campo['coluna'];
        $faker_method = $faker_types[$tipo]['faker'] ?? null;

        if (!$faker_method OR !method_exists($faker, $faker_method)) {
            $valor = 'NULL';
        } else {
            if ($faker_method === 'numberBetween') {
                $min = isset($range_mins[$index]) AND is_numeric($range_mins[$index]) ? (int) $range_mins[$index] : 1;
                $max = isset($range_maxs[$index]) AND is_numeric($range_maxs[$index]) ? (int) $range_maxs[$index] : 100;
                $valor = $faker->$faker_method($min, $max);
            } else {
                $valor = $faker->$faker_method();
            }
        }

        $valor = is_numeric($valor) ? $valor : "'" . addslashes($valor) . "'";
        $valores[] = $valor;
    }

    $colunasStr = implode(', ', array_column($campos, 'coluna'));
    $valoresStr = implode(', ', $valores);
    echo "INSERT INTO $tabela ($colunasStr) VALUES ($valoresStr);\n";
}
