<?php

class Estadistica
{
    private $numeros = []; // Almacena los números ingresados

    // Constructor que recibe un array de números
    public function __construct($numeros)
    {
        $this->setNumeros($numeros);
    }

    // Setter para definir los números (verifica que sean válidos)
    public function setNumeros($numeros)
    {
        if (!is_array($numeros) || empty($numeros)) {
            throw new Exception("Debe ingresar una lista válida de números.");
        }

        foreach ($numeros as $num) {
            if (!is_numeric($num)) {
                throw new Exception("Todos los valores deben ser números.");
            }
        }

        $this->numeros = $numeros;
    }

    // Getter para obtener los números almacenados
    public function getNumeros()
    {
        return $this->numeros;
    }

    // Método para calcular el promedio
    public function calcularPromedio()
    {
        return array_sum($this->numeros) / count($this->numeros);
    }

    // Método para calcular la mediana
    public function calcularMediana()
    {
        $numerosOrdenados = $this->numeros;
        sort($numerosOrdenados);
        $cantidad = count($numerosOrdenados);
        $indiceMedio = floor($cantidad / 2);

        if ($cantidad % 2 == 0) {
            return ($numerosOrdenados[$indiceMedio - 1] + $numerosOrdenados[$indiceMedio]) / 2;
        } else {
            return $numerosOrdenados[$indiceMedio];
        }
    }

    // Método para calcular la moda
    public function calcularModa()
    {
        $redondeados = array_map(fn($n) => (string) round($n, 2), $this->numeros); // Redondeo y conversión a string
        $frecuencias = array_count_values($redondeados); // Cuenta valores únicos
        arsort($frecuencias); // Ordena de mayor a menor frecuencia
        
        $maxFrecuencia = reset($frecuencias); // Obtiene la máxima frecuencia
        $modas = array_keys($frecuencias, $maxFrecuencia); // Encuentra las modas
    
        if (count($modas) == count($this->numeros)) {
            return "No hay moda (todos aparecen con la misma frecuencia)";
        }
    
        return implode(", ", $modas);
    }
}

// Captura de datos desde un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entrada = $_POST['numeros'];
    $numeros = array_map('floatval', explode(',', $entrada));

    try {
        $estadistica = new Estadistica($numeros);
        echo "Números ingresados: " . implode(", ", $estadistica->getNumeros()) . "<br>";
        echo "Promedio: " . $estadistica->calcularPromedio() . "<br>";
        echo "Mediana: " . $estadistica->calcularMediana() . "<br>";
        echo "Moda: " . $estadistica->calcularModa() . "<br>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Estadística</title>
</head>
<body>
    <h1>Calculadora de Promedio, Mediana y Moda</h1>
    <form method="post">
        <label>Ingrese los números separados por comas:</label><br>
        <input type="text" name="numeros" required>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>
