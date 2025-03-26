<?php
class Acronimo
{
    private $frase;
    private $acronimo;

    public function __construct($frase)
    {
        $this->setFrase($frase);
    }

    public function setFrase($frase)
    {
        $this->frase = $this->procesarFrase($frase);
        $this->acronimo = $this->generarAcronimo();
    }

    public function getAcronimo()
    {
        return $this->acronimo;
    }

    public function procesarFrase($frase)
    {
        $frase = strtoupper($frase);
        $fraseLimpia = "";
    
        for ($i = 0; $i < strlen($frase); $i++) {
            $caracter = $frase[$i];
    
            if (($caracter >= 'A' && $caracter <= 'Z') || $caracter == ' ' || $caracter == '-') {

                $fraseLimpia .= $caracter;
            }
        }
    
        return trim($fraseLimpia);
    }

    public function generarAcronimo()
    {
        $acronimo = "";
        $longitud = strlen($this->frase);
        $tomarLetra = true; 
    
        for ($i = 0; $i < $longitud; $i++) {

            $caracter = $this->frase[$i];
    
            if ($tomarLetra && (($caracter >= 'A' && $caracter <= 'Z') || ($caracter >= 'a' && $caracter <= 'z'))) {
                $acronimo .= $caracter;
                $tomarLetra = false; 
            }
    
            if ($caracter == ' ' || $caracter == '-') {
                $tomarLetra = true;
            }
        }
        return $acronimo;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acronimos</title>
</head>
<body>
    
</body>
</html>