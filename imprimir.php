<?php
function montaCartao(array $params)
{
    $numeros = array();
    $cartoes = array();

    for ($i = 0; $i < $params['quantidade']; $i++) {
        $numeros[$i] = $i;
    }
    
    $quantidadeBilhetes = $params['quantidade'] - 1; 
    
    for ($w = 0; $w < $params['participantes']; $w++) {
        $numerosDaSorte = array();

        for ($z = 0; $z < $params['pbilhetes']; $z++) {
            $numCartoes = "";
            for ($y = 0; $y < $params['nbilhetes']; $y++) {
                $aleatorio = mt_rand(0, $quantidadeBilhetes);
                $numeroSorteado = str_pad($numeros[$aleatorio], 3, "0", STR_PAD_LEFT);
                $numCartoes .= (!empty($numCartoes) ? " - " . $numeroSorteado : $numeroSorteado);

                unset($numeros[$aleatorio]);
                sort($numeros);

                $quantidadeBilhetes--;
            }
            $numerosDaSorte[] = $numCartoes;
        }
        $cartoes[] = array('cota' => $w + 1, 'num' => $numerosDaSorte);
    }
    //return array($cartoes, implode(', ', $numeros));
    return array($cartoes, $numeros);
}

function montaHTML(array $bilhete, array $params)
{
    $premio = $params['premio'];
    $titulo = $params['titulo'];
    $dtsorteio = $params['data'];
    $valor = $params['valor'];
    if ($params['nbilhetes'] > 1) $sePlural = "s";
    
    $html = '';
    $html .= '<!DOCTYPE html>';
    $html .= '<html>';
    $html .= '<head>';
    $html .= '  <title>Bilhetes da Rifa</title>';
    $html .= '</head>';
    $html .= '<body>';
    $html .= '<style>';
    $html .= '    .centralizado { text-align: center; }';
    $html .= '    .tabelao { border-width: 1px; }';
    $html .= '</style>';

    foreach ($bilhete[0] as $bilhetes):

        $html .= '    <table cellPadding="3" cellspacing="0" style="width: 100%;" class="centralizado" border="1">';
        $html .= '        <tr>';
        $html .= '            <td colspan="2">';
        $html .= '                <h1>Cota ' . $bilhetes['cota'] . '</h1>';
        $html .= '            </td>';
        $html .= '        </tr>';

        foreach ($bilhetes['num'] as $numeros):
            $html .= '            <tr>';
            $html .= '                <td style="width: 30%">';
            $html .= '                    Número' . $sePlural . ' da Sorte:<br />';
            $html .= '                    <h3>' . $numeros . '</h3><br /><br />';
            $html .= '                    <span style="font-size: 11px"><b>Nome:</b></span> _________________________<br /><br />';
            $html .= '                    <span style="font-size: 11px"><b>Fone:</b></span> __________________________';
            $html .= '                </td>';
            $html .= '                <td>';
            $html .= '                    <table cellPadding="0" cellspacing="0" style="width: 100%;" class="centralizado" border="1">';
            $html .= '                        <tr>';
            $html .= '                            <td>';
            $html .= '                                <h2>' . ($titulo == "" ? "Ação entre Amigos" : $titulo) . '</h2><br>';
            $html .= '                                PRÊMIO: <b>' . $premio . '</b><br /><br />';
            $html .= '                                Valor: <b>' . $valor . '</b> | Data do Sorteio: <b>' . $dtsorteio . '</b><br />';
            $html .= '                                <span style="font-size: 11px">(Pelo 1º prêmio da Loteria Federal)</span>';
            $html .= '                            </td>';
            $html .= '                        </tr>';
            $html .= '                        <tr>';
            $html .= '                            <td>';
            $html .= '                                Número' . $sePlural . ' da Sorte:<br>';
            $html .= '                                <h3>' . $numeros . '</h3>';
            $html .= '                            </td>';
            $html .= '                        </tr>';
            $html .= '                        <tr>';
            $html .= '                            <td>';
            $html .= '                                <span style="font-size: 9px">';
            if ($params['quantidade'] > 100 ) {
            $html .= '                                    * O bilhete premiado será extraído ao cupom cujo número é igual aos três últimos números do primeiro prêmio.';
            }
            else {
            $html .= '                                    * O bilhete premiado será extraído ao cupom cujo número é igual aos dois últimos números do primeiro prêmio.';
            }
            $html .= '                                </span>';
            $html .= '                            </td>';
            $html .= '                        </tr>';

            $html .= '                    </table>';
            $html .= '                </td>';
            $html .= '            </tr>';

        endforeach;

        $html .= '    </table>';
        $html .= '    <p style="page-break-before: always">&nbsp;</p>';

    endforeach;

    /* Detalhamento dos números */
    $html .= ' <table cellPadding="3" cellspacing="0" style="width: 100%;" class="centralizado" border="1">';
    $html .= '     <tr>';
    $html .= '         <td colspan="2">';
    $html .= '             <h1>Detalhamento</h1>';
    $html .= '         </td>';
    $html .= '     </tr>';

    foreach ($bilhete[0] as $bilhetes):
        $c = 0;
        $html .= '        <tr>';
        $html .= '            <td style="width: 20%">';
        $html .= '                <b>Cota' . $bilhetes['cota'] . '</b><br /><br />____________________';
        $html .= '            </td>';
        $html .= '            <td>';
        $html .= '                <b>Números</b><br />';
        foreach ($bilhetes['num'] as $numeros):
            $html .= '                    ' . (($c > 0) ? ' | ' . $numeros : $numeros);
            $c++;
        endforeach;
        $html .= '            </td>';
        $html .= '        </tr>';
    endforeach;
    $html .= ' </table>';

    /* Números que sobraram */
    if (!empty($bilhete[1])):
        $c = 0;

        $html .= '    <br><br>';
        $html .= '    <table cellPadding="3" cellspacing="0" style="width: 100%;" class="centralizado" border="1">';
        $html .= '        <tr>';
        $html .= '            <td><h1>Número(s) não Sorteado(s)</h1></td>';
        $html .= '        </tr>';
        $html .= '        <tr>';
        $html .= '            <td>';
        $html .= '                <br />';
        foreach ($bilhete[1] as $naoSorteados):
            $html .= '                    ' . (($c > 0) ? ' | ' : '') . str_pad($naoSorteados, 3, "0", STR_PAD_LEFT);
            $c++;
        endforeach;
        $html .= '                <br><br>Total de número(s): ' . $c;
        $html .= '            </td>';
        $html .= '        </tr>';
        $html .= '    </table>';
    endif;

    $html .= ' </body>';
    $html .= ' </html>';

    // retorno
    return $html;
}

try {
    $params = $_REQUEST;
    $bilhetes = montaCartao($params);
    $html = montaHTML($bilhetes, $params);

    //echo $html; //return;

    include_once 'vendor/mpdf/mpdf.php';
    $mpdf = new mPDF('utf-8', 'A4', '', '', 8, 8, 5, 10, 10, 10, 'P');
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->SetFooter('{DATE d/m/Y H:i} |{PAGENO} / {nb}| Ação entre amigos');
    $mpdf->WriteHTML($html);
    $mpdf->Output("rifa_" . date('Ymd') . '.pdf', 'I');
    die;

} catch (Exception $ex) {
    die($ex->getMessage());
}