<?php
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$uri = rtrim(dirname(filter_input(INPUT_SERVER, 'PHP_SELF')), '/\\');

define( 'DS', DIRECTORY_SEPARATOR );
define( 'BASE_DIR', dirname( dirname( __FILE__ ) ) . DS );

require_once BASE_DIR . 'controle' . DS . 'OrdemControle.php';
require_once BASE_DIR . 'modelo' . DS . 'Ordem.php';

require_once BASE_DIR . 'controle' . DS . 'TipoControle.php';
require_once BASE_DIR . 'modelo' . DS . 'Tipo.php';

require_once BASE_DIR . 'modelo' . DS . 'Cliente.php';

require_once BASE_DIR . 'controle' . DS . 'TecnicoControle.php';
require_once BASE_DIR . 'modelo' . DS . 'Tecnico.php';

$ordemControle = new OrdemControle();
$daoTecnico = new TecnicoControle();
$daoTipo = new TipoControle();

foreach ($ordemControle->lista(0, 1) as $ordem) {
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
            .tg .tg-d55q{font-weight:bold;font-size:14px;vertical-align:top}
            .tg .tg-e3zv{font-weight:bold}
            .tg .tg-yw4l{vertical-align:top}
            .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top}
            .tg .tg-9hbo{font-weight:bold;vertical-align:top}
            .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
        </style>
        <table class="tg" style="table-layout: fixed; width: 834px">
            <colgroup>
                <col style="width: 122px">
                <col style="width: 275px">
                <col style="width: 46px">
                <col style="width: 266px">
                <col style="width: 125px">
            </colgroup>
            <tr>
                <th class="tg-e3zv">CLIENTE:</th>
                <th class="tg-yw4l text-capitalize">cliente</th>
                <th class="tg-yw4l"></th>
                <th class="tg-l2oz">DATA SOLICITAÇÃO:</th>
                <th class="tg-d55q">10/02/2017</th>
            </tr>
            <tr>
                <td class="tg-9hbo">SOLICITANTE:</td>
                <td class="tg-yw4l">DANIEL</td>
                <td class="tg-yw4l"></td>
                <td class="tg-l2oz">TELEFONE:</td>
                <td class="tg-yw4l">38 9 9217-7861</td>
            </tr>
            <tr>
                <td class="tg-9hbo" colspan="5">DATA / HORA INICIO: ______/_____/______   _____:_____  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA / HORA INICIO: ______/_____/______    _____:_____</td>
            </tr>
            <tr>
                <td class="tg-9hbo">ENDEREÇO:</td>
                <td class="tg-yw4l" colspan="4">AV GOVERNADOR VALADARES, 590 - CENTRO, PORTEIRINHA / MG</td>
            </tr>
            <tr>
                <td class="tg-9hbo">ATENDENTE:</td>
                <td class="tg-yw4l">PATRICIA</td>
                <td class="tg-yw4l"></td>
                <td class="tg-l2oz">TÉCNICO:</td>
                <td class="tg-yw4l">LENISSON</td>
            </tr>
            <tr>
                <td class="tg-9hbo">TIPO DE O.S.</td>
                <td class="tg-yw4l" colspan="2">ATIVAÇÃO</td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
            </tr>
            <tr>
                <td class="tg-9hbo">DESCRIÇÃO:</td>
                <td class="tg-yw4l" colspan="4"><?= $ordem->getDesc_ordem() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo">OBSERVAÇÕES:</td>
                <td class="tg-yw4l" colspan="4">FOI REALIZADO A TROCA DA ANTENA DO CLIENTE</td>
            </tr>
            <tr>
                <td class="tg-9hbo" colspan="2">DESCRIÇÃO DOS SERVIÇOS REALIZADOS:</td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
            </tr>
            <tr>
                <td class="tg-yw4l" colspan="5">_______________________________________________________________________________________________________</td>
            </tr>
            <tr>
                <td class="tg-yw4l" colspan="5">_______________________________________________________________________________________________________</td>
            </tr>
            <tr>
                <td class="tg-yw4l" colspan="5">_______________________________________________________________________________________________________</td>
            <tr>
                <td class="tg-9hbo" colspan="5">ATENDIMENTO CONCLUÍDO: SIM (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NÃO (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MOTIVO: ______________________________________________</td>
            </tr>
            <tr>
                <td class="tg-yw4l" colspan="5">    ____________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________________________</td>
            </tr>
            <tr>
                <td class="tg-amwm" colspan="2">TÉCNICO</td>
                <td class="tg-yw4l"></td>
                <td class="tg-9hbo" colspan="2">                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CLIENTE </td>
            </tr>
            <tr>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
            </tr>
        </table>

        <hr />

    </body>
</html>
