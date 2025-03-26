<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="arboles.css">
    <title>Árbol Binario - Recorridos y Visualización</title>
</head>
<body>
    <h2>Construir Árbol Binario y mostrar Preorden, Inorden y Postorden</h2>
    <form method="post">
        <label>Ingrese los valores separados por espacios (ejemplo: A B D E C):</label><br>
        <input type="text" name="valor" required><br><br>
        <input type="submit" value="Insertar y Mostrar Recorridos">
    </form>
    <?php
    require 'claseArbolBinario.php';
    if (isset($_POST['valor'])) {
        $arbol = new ArbolBinario();
        $valores = explode(" ", strtoupper(trim($_POST['valor'])));
        foreach ($valores as $val) {
            $arbol->insertar($val);
        }
        echo "<h3>Recorridos del Árbol:</h3>";
        echo "Preorden: " . implode(" ", $arbol->preorden($arbol->raiz)) . "<br>";
        echo "Inorden: " . implode(" ", $arbol->inorden($arbol->raiz)) . "<br>";
        echo "Postorden: " . implode(" ", $arbol->postorden($arbol->raiz)) . "<br>";
        echo "<h3>Árbol Binario Visual:</h3>";
        echo "<div class='arbol'>";
        $arbol->imprimirArbol($arbol->raiz);
        echo "</div>";
    }
    ?>
    <a href="../index.html">Inicio</a>
</body>
</html>