<?php
use Spipu\Html2Pdf\Html2Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once(__DIR__ . '/sistema.php');

class Reportes extends Sistema {

    public function generarPDF($titulo, $columnas, $datos, $nombreArchivo = 'Reporte.pdf') {
        require_once __DIR__ . '/../vendor/autoload.php'; // Esta línea ya usa __DIR__

        $content = "
        <style>
            body {
                font-family: 'Helvetica', 'Arial', sans-serif;
                background-color: #f8f9fa;
                color: #333;
                position: relative;
            }
            .contenedor {
                width: 90%;
                margin: 40px auto;
                text-align: center;
                background-color: #ffffff;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                position: relative;
            }
            .logo {
                position: absolute;
                top: 20px;
                right: 20px;
                width: 100px; 
                height: auto;
            }
            h1 {
                font-size: 26px;
                margin-bottom: 25px;
                color: #2c3e50;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            table {
                width: 70%;
                margin: 0px 0px 0px 25%;
                border-collapse: collapse;
                font-size: 14px;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #dee2e6;
                padding: 10px 15px;
                text-align: center;
            }
            th {
                background-color: #034e9eff;
                color: white;
                font-weight: bold;
            }
            tr:nth-child(even) {
                background-color: #f2f6fc;
            }
            tr:hover {
                background-color: #e9f0fa;
            }
            .no-data {
                color: #888;
                font-style: italic;
                text-align: center;
            }
        </style>

        <div class='contenedor'>
            <img src='../images/institucion/tecnm_celaya_logo.png' class='logo'>
            <h1>{$titulo}</h1>
            <table>
                <thead>
                    <tr>";
        
        foreach ($columnas as $col) {
            $content .= "<th>{$col}</th>";
        }

        $content .= "</tr></thead><tbody>";

        if (!empty($datos)) {
            foreach ($datos as $fila) {
                $content .= "<tr>";
                foreach ($fila as $valor) {
                    $content .= "<td>{$valor}</td>";
                }
                $content .= "</tr>";
            }
        } else {
            $content .= "<tr><td colspan='".count($columnas)."' class='no-data'>No hay datos disponibles</td></tr>";
        }

        $content .= "</tbody></table></div>";

        $html2pdf = new Html2Pdf('P', 'A4', 'es');
        $html2pdf->writeHTML($content);
        $html2pdf->output($nombreArchivo);
    }

    public function institucionesInvestigadores() {
        require_once __DIR__ . '/../vendor/autoload.php'; 
        $institucion = new Institucion();
        $data = $institucion->reporteInstitucionesInvestigadores();

        foreach ($data as $row) {
            $datos[] = [$row['institucion'], $row['cantidad_investigadores']];
        }

        $this->generarPDF(
            "Instituciones e Investigadores",
            ["Institución", "Cantidad de Investigadores"],
            $datos,
            "ReporteInstituciones.pdf"
        );
    }

    public function generarExcel($titulo, $columnas, $datos, $nombreArchivo = 'Reporte.xlsx') {
        require_once __DIR__ . '/../vendor/autoload.php'; // Esta línea ya usa __DIR__
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', $titulo);
    }
}
?>
