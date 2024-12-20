<?php
require_once('../tcpdf/tcpdf.php');
require_once('../app/config/database.php');
require_once('../app/models/proyecto.php');

use App\Models\Proyecto;

date_default_timezone_set('America/La_Paz');
$tipo = $_GET['tipo'] ?? 'e';
$tipo = $tipo == 'e' ? 'EGRESO' : 'INGRESO';
$pdf = new TCPDF("L", "mm", "A4", true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Author');
$pdf->SetTitle('Reporte Proyecto');
$pdf->SetSubject('Subject');
$pdf->SetKeywords('Keywords');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();
$html = '<style>
.center{text-align: center;}
.right{text-align: right;}
.bold{font-weight: bold;}
.border{border: 1px solid black;}
.border-top{border-top: 1px solid black;}
.h-20{height: 40px;line-height: 40px;}
</style>';
$html .= '<p class="right">' . date('j M. Y H:i') . '</p>';
$html .= '<h1 align="center">REPORTE DE PROYECTOS ' . $tipo . '</h1>';
$html .= '<table cellpadding="3" border="0">
  <tr class="center bold" style="line-height:30px">
    <td colspan="10" class="border h-20">Fecha</td>
    <td colspan="10" class="border h-20">Estado</td>
    <td colspan="35" class="border h-20">Detalle</td>
    <td colspan="15" class="border h-20">Monto</td>
    <td colspan="15" class="border h-20">Monto Pagado</td>
    <td colspan="15" class="border h-20">Saldo</td>
  </tr>';
$res = Proyecto::getProyectoConMontoTotalPago(['tipo' => $tipo, 'year' => date('Y')]);
$montoTotal = 0;
$montoTotalPagado = 0;
$montoTotalSaldo = 0;
foreach ($res as $row) {
  $saldo = floatval($row['montoRef']) - floatval($row['totalPagado']);
  $montoTotal += $row['montoRef'];
  $montoTotalPagado += $row['totalPagado'];
  $montoTotalSaldo += $saldo;
  $html .= '<tr>
    <td colspan="10" class="center">' . date('d/m/Y', strtotime($row['fechaCreacion'])) . '</td>
    <td colspan="10">' . ($row['estado'] ?? 'PENDIENTE') . '</td>
    <td colspan="35">' . strtoupper($row['proyecto']) . '</td>
    <td colspan="15" class="right">' . number_format($row['montoRef'], 2) . '</td>
    <td colspan="15" class="right">' . number_format($row['totalPagado'], 2) . '</td>
    <td colspan="15" class="right">' .  number_format($saldo, 2) . '</td>
  </tr>';
}
$html .= '
<tr>
  <td colspan="55" class="right"><b>Totales: </b></td>
  <td colspan="15" class="border-top right">' . number_format($montoTotal, 2) . '</td>
  <td colspan="15" class="border-top right">' . number_format($montoTotalPagado, 2) . '</td>
  <td colspan="15" class="border-top right">' . number_format($montoTotalSaldo, 2) . '</td>
</tr>
</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('reporteProyecto.pdf', 'I');
