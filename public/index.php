<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Electrodomésticos</title>
    <link href="../public/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $color = strtolower($_POST['color']);
    $consumo = $_POST['consumo'];
    $peso = $_POST['peso'];

    // Validar y asignar valores por defecto
    if (!in_array($consumo, ['A', 'B', 'C'])) {
        $consumo = 'C';
    }

    if ($peso < 0 || $peso > 49) {
        $peso = 1;
    }

    if (!in_array($color, ['blanco', 'gris', 'negro'])) {
        $color = 'blanco';
    }

    // Tabla de precios por consumo energético
    $preciosConsumo = [
        'A' => 100,
        'B' => 80,
        'C' => 60
    ];

    // Tabla de precios por peso
    if ($peso <= 10) {
        $precioPeso = 1;
    } elseif ($peso <= 20) {
        $precioPeso = 2;
    } elseif ($peso <= 30) {
        $precioPeso = 3;
    } elseif ($peso <= 40) {
        $precioPeso = 4;
    } else {
        $precioPeso = 5;
    }

    // Calcular precio del producto
    $precioProducto = $preciosConsumo[$consumo] * $precioPeso;

    // Tabla de descuentos por color (en porcentaje)
    $descuentos = [
        'blanco' => 5,
        'gris' => 10,
        'negro' => 15
    ];

    // Calcular descuento
    $descuento = ($precioProducto * $descuentos[$color]) / 100;
    $precioFinal = $precioProducto - $descuento;

    // Almacenar información en un array asociativo
    $electrodomestico = [
        'nombre' => $nombre,
        'color' => $color,
        'consumo' => $consumo,
        'peso' => $peso,
        'precio_producto' => $precioProducto,
        'descuento' => $descuento,
        'precio_final' => $precioFinal
    ];

    echo "<div class='max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mb-4'>";
    echo "<h2 class='text-2xl font-bold mb-4'>Datos recibidos:</h2>";
    echo "<p><strong>Nombre del Electrodoméstico:</strong> " . htmlspecialchars($electrodomestico['nombre']) . "</p>";
    echo "<p><strong>Color:</strong> " . htmlspecialchars($electrodomestico['color']) . "</p>";
    echo "<p><strong>Consumo Energético:</strong> " . htmlspecialchars($electrodomestico['consumo']) . "</p>";
    echo "<p><strong>Peso (kg):</strong> " . htmlspecialchars($electrodomestico['peso']) . "</p>";
    echo "<p><strong>Precio del Producto:</strong> $" . htmlspecialchars(number_format($electrodomestico['precio_producto'], 2)) . "</p>";
    echo "<p><strong>Descuento:</strong> $" . htmlspecialchars(number_format($electrodomestico['descuento'], 2)) . " (" . $descuentos[$color] . "%)</p>";
    echo "<p><strong>Precio Final:</strong> $" . htmlspecialchars(number_format($electrodomestico['precio_final'], 2)) . "</p>";
    echo "</div>";
}
?>

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Formulario de Electrodomésticos</h1>
    <form action="" method="post" class="space-y-4">
        <div>
            <label for="nombre" class="block text-gray-700">Nombre del Electrodoméstico</label>
            <input type="text" id="nombre" name="nombre" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
        </div>
        <div>
            <label for="color" class="block text-gray-700">Color</label>
            <input type="text" id="color" name="color" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
        </div>
        <div>
            <label for="consumo" class="block text-gray-700">Consumo Energético</label>
            <select id="consumo" name="consumo" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                <option value="">Seleccione una opción</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>
        <div>
            <label for="peso" class="block text-gray-700">Peso (kg)</label>
            <input type="number" id="peso" name="peso" step="0.01" class="w-full mt-1 p-2 border border-gray-300 rounded-md" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Enviar</button>
    </form>
</div>
</body>
</html>
<body class="bg-gray-100 p-6">
    <div class="flex flex-wrap justify-center space-x-4">
        <div class="bg-white p-4 rounded-md shadow-md w-72">
            <h2 class="text-lg font-bold mb-4">Tabla de colores</h2>
            <table class="table-auto w-full text-left text-sm">
                <thead>
                    <tr>
                        <th class="px-2 py-1 border">Color</th>
                        <th class="px-2 py-1 border">Porcentaje de descuento del valor del producto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-2 py-1 border">Blanco</td>
                        <td class="px-2 py-1 border">5%</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 border">Gris</td>
                        <td class="px-2 py-1 border">7%</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 border">Negro</td>
                        <td class="px-2 py-1 border">10%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-white p-4 rounded-md shadow-md w-72">
            <h2 class="text-lg font-bold mb-4">Tabla de consumo energetico</h2>
            <table class="table-auto w-full text-left text-sm">
                <thead>
                    <tr>
                        <th class="px-2 py-1 border">Letra</th>
                        <th class="px-2 py-1 border">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-2 py-1 border">A</td>
                        <td class="px-2 py-1 border">100$</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 border">B</td>
                        <td class="px-2 py-1 border">80$</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 border">C</td>
                        <td class="px-2 py-1 border">60$</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-white p-4 rounded-md shadow-md w-72">
            <h2 class="text-lg font-bold mb-4">Tabla de Peso</h2>
            <table class="table-auto w-full text-left text-sm">
                <thead>
                    <tr>
                        <th class="px-2 py-1 border">Tamaño</th>
                        <th class="px-2 py-1 border">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-2 py-1 border">ENTRE 0 y 19 kg</td>
                        <td class="px-2 py-1 border">10$</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 border">entre 20 y 49 kg</td>
                        <td class="px-2 py-1 border">50$</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>