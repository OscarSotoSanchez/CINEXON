<?php

include_once 'fpdf/fpdf.php';

class PDF extends FPDF {

    //Cabecera de página
    function Header() {
        $this->SetFont('Helvetica', '', 12);
        $this->Cell(110);
        $this->Cell(30, 20, "Twitter:        @Cinexon_mola", 0, 0, 'L');
        $this->Cell(-30);
        $this->Cell(0, 30, "Facebook:   Cinexon Mola Mogollon", 0, 0, 'L');
        $this->Cell(-80);
        $this->Cell(0, 50, "Fecha: " . date("d-m-Y"), 0, 0, 'L');
        $this->Image('../../views/resource/img/icono_pdf.png', 8, 8, 110, 35, 'png');
        $this->Ln(60);
    }

    //Pie de página
    function Footer() {
        //Texto
        $this->Cell(0); //A 0 cm de la derecha
        $this->SetY(-25); //A 25 cm del fondo
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(0, 10, utf8_decode('Si hubiese algún problema'), 0, 0, 'L');
        $this->SetY(-21);
        $this->Cell(0, 10, utf8_decode('póngase en contacto con nosotros en:'), 0, 0, 'L');
        $this->SetY(-17);
        $this->Cell(0, 10, utf8_decode('cinexon.olj@gmail.com'), 0, 0, 'L');
        //Código de barras
        $this->Cell(120); //A 120cm de la derecha
        $this->SetY(-25); //A 25 cm del fondo
        $this->Image('../../views/resource/img/barcode.gif', 140, 270, 50, 20, 'gif');
    }

    //Tabla de las películas
    function tablaSesiones($columnas, $entradas) {
        //Imprimir las cabeceras de la tabla
        $pos_y = 97;
        $this->SetXY(15, $pos_y);
        $this->SetFillColor(66, 88, 110);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B', 14);
        for ($x = 0; $x < count($columnas); $x++) {
            if ($x % 2 == 0) {
                $this->Cell(40, 13, $columnas[$x], 0, 0, 'C', true);
            } else {
                $this->Cell(140, 13, $columnas[$x], 0, 0, 'C', true);
            }
        }
        $pos_y += 13;

        for ($x = 0; $x < count($entradas); $x++) {
            $this->SetXY(15, $pos_y);
            $this->SetFillColor(178, 187, 195);
            $this->SetTextColor(0);
            $this->SetFont('', '', 12);
            $this->Cell(40, 10, ($x + 1), 0, 0, 'C', true);
            $this->Cell(140, 10, $entradas[$x], 0, 0, 'C', true);
            $pos_y+=8;
        }
    }

//tablaSesiones
    //Tabla de los cines
    function tablaCines($columnas, $local, $direccion) {
        $pos_y = 162;
        $this->SetXY(15, $pos_y);
        $this->SetFillColor(66, 88, 110);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B', 14);

        //Imprimir las cabeceras de la tabla
        for ($x = 0; $x < count($columnas); $x++) {
            if ($x % 2 == 0) {
                $this->Cell(80, 13, $columnas[$x], 0, 0, 'C', true);
            } else {
                $this->Cell(100, 13, $columnas[$x], 0, 0, 'C', true);
            }
        }
        $pos_y += 13;

        //Imprimir el cuerpo de la tabla
        $this->SetXY(15, $pos_y);
        $this->SetFillColor(178, 187, 195);
        $this->SetTextColor(0);
        $this->SetFont('', '', 12);
        $this->Cell(80, 10, utf8_decode($local), 0, 0, 'C', true);
        $this->Cell(100, 10, utf8_decode($direccion), 0, 0, 'C', true);
        //$this->Cell(40,13,$local,0,0,'C',true);
        //$this->Cell(40,13,$direccion,0,0,'C',true);
    }

//tablaCines
    //Función descarga
    function downloadPDF($titulo, $local, $direccion, $entradas, $sesion) {
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AddPage();

        /* ==Variables de prueba==
          $titulo = 'Pelicula 1';                                                 //ELIMINAR
          $local = 'Cine 1';                                                      //ELIMINAR
          $direccion = utf8_decode('Calle Falsa nº123');                          //ELIMINAR
          $filas = array(6,7);                                                    //ELIMINAR
          $butacas = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);   //ELIMINAR
          $sesion = '19:30';      												//ELIMINAR
         */

        //Título y sesión
        $pdf->SetFont('Helvetica', '', 20);
        $pdf->SetXY(95, 45);
        $pdf->Cell(20, 10, utf8_decode($titulo), 0, 0, 'C');
        $pdf->SetXY(95, 50);
        $pdf->Cell(20, 20, utf8_decode($sesion), 0, 0, 'C');

        //Butacas y filas
        $pdf->SetFont('Helvetica', '', 14);
        $pdf->SetXY(12, 72);
        $pdf->Cell(20, 10, utf8_decode('El portador del presente vale se declara comprador delas entradas para la '), 0, 0, 'L');
        $pdf->SetXY(12, 72);
        $pdf->Cell(20, 20, utf8_decode('película y la sesión declaradas arriba en la fecha del documento.'), 0, 0, 'L');
        $pdf->SetXY(12, 87);
        $pdf->Cell(20, 10, utf8_decode('Las entradas compradas corresponderán a las siguientes posiciones:'), 0, 0, 'L');

        //Títulos de las columnas:
        $columnas = array(utf8_decode('Fila'),
            utf8_decode('Butacas'));

        $arrayPintar = array();
        $fila = "";
        for ($x = 0; $x < count($entradas); $x++) {
            if ($x == 0) {
                $fila = ($entradas[$x][1] + 1);
            } else {
                if ($entradas[$x - 1][0] == $entradas[$x][0]) {
                    echo $entradas[$x][1];
                    $fila .= ", " . ($entradas[$x][1] + 1);
                } else {
                    array_push($arrayPintar, $fila);
                    $fila = ($entradas[$x][1] + 1);
                }
            }

            if ($x == (count($entradas) - 1)) {
                array_push($arrayPintar, $fila);
            }
        }

        $pdf->tablaSesiones($columnas, $arrayPintar);


        //Cines
        $pdf->SetFont('Helvetica', '', 14);
        $pdf->SetXY(12, 142);
        $pdf->Cell(20, 10, utf8_decode('El presente vale será efectivo única y exclusivamente en la fecha indicada'), 0, 0, 'L');
        $pdf->SetXY(12, 142);
        $pdf->Cell(20, 20, utf8_decode('en la parte superior del documento y en los locales declarados abajo:'), 0, 0, 'L');


        //Títulos de las columnas:
        $columnas = array(utf8_decode('Cine'),
            utf8_decode('Dirección'));

        $pdf->tablaCines($columnas, $local, $direccion);

        //Despedida
        $pdf->SetFont('Helvetica', '', 14);
        $pdf->SetXY(12, 242);
        $pdf->Cell(20, 10, utf8_decode('Disfrute de su película'), 0, 0, 'L');

        //Descarga
        ob_end_clean();
        $pdf->Output($titulo . '-(' . $sesion .')(' . date("d/m/Y") . ').pdf', 'D');
    }

//downloadPDF
}

//Class
?>