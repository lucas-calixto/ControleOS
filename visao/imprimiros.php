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

$ordem = $ordemControle->busca(filter_input(INPUT_GET, 'cod_ordem'));
$cliente = $ordem->getCod_cliente_ordem();
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
        <link rel="icon" type="image/png" sizes="32x32" href="imagens/favicon-32x32.png">
    </head>
    <body onload="self.print();">
        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
            .tg .tg-d55q{font-weight: bold;font-size:14px;vertical-align:bottom;text-align:right}
            .tg .tg-e3zv{font-weight:bold;text-align:left}
            .tg .tg-yw4l{vertical-align:top;text-align:left}
            .tg .tg-l2oz{font-weight:bold;text-align:right;vertical-align:top}
            .tg .tg-9hbo{font-weight:bold;vertical-align:top}
            .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
        </style>
        <table class="tg" style="table-layout: fixed; width: 834px">
            <colgroup>
                <col style="width: 122px">
                <col style="width: 275px">
                <col style="width: 46px">
                <col style="width: 256px">
                <col style="width: 135px">
            </colgroup>
            <tr>
                <th class="tg-e3zv">CLIENTE:</th>
                <th class="tg-yw4l text-capitalize"><?= $cliente->getNome_cliente() ?></th>
                <th class="tg-yw4l"></th>
                <th class="tg-l2oz">DATA SOLICITAÇÃO:</th>
                <th class="tg-d55q"><?= date('d/m/Y', strtotime($ordem->getData_cad_ordem())) . ' - ' . date('H:i', strtotime($ordem->getHora_cad_ordem())) ?></th>
            </tr>
            <tr>
                <td class="tg-9hbo">SOLICITANTE:</td>
                <td class="tg-yw4l"><?= $ordem->getSolicitatante_ordem() ?></td>
                <td class="tg-yw4l"></td>
                <td class="tg-l2oz">TELEFONE:</td>
                <td class="tg-yw4l"><?= $cliente->getTelefone_um_cliente() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo" colspan="5">DATA / HORA INICIO: ______/_____/______   _____:_____  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA / HORA INICIO: ______/_____/______    _____:_____</td>
            </tr>
            <tr>
                <td class="tg-9hbo">ENDEREÇO:</td>
                <td class="tg-yw4l" colspan="4"><?= $cliente->getEndereco_cliente() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo">ATENDENTE:</td>
                <td class="tg-yw4l"><?= $ordem->getCod_atendente_ordem()->getNome_atendente() ?></td>
                <td class="tg-yw4l"></td>
                <td class="tg-l2oz">TÉCNICO:</td>
                <td class="tg-yw4l"><?= $ordem->getCod_tecnico_ordem()->getNome_tecnico() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo">TIPO DE O.S.</td>
                <td class="tg-yw4l" colspan="2"><?= $ordem->getCod_tipo_ordem()->getDesc_tipo() ?></td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
            </tr>
            <tr>
                <td class="tg-9hbo">DESCRIÇÃO:</td>
                <td class="tg-yw4l" colspan="4"><?= $ordem->getDesc_ordem() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo">OBSERVAÇÕES:</td>
                <td class="tg-yw4l" colspan="4"><?= $ordem->getDesc_total_ordem() ?></td>
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
                <td class="tg-9hbo" colspan="5">ATENDIMENTO CONCLUÍDO: SIM (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NÃO (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp; MOTIVO: _________________________________________________</td>
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
                <th class="tg-yw4l text-capitalize"><?= $cliente->getNome_cliente() ?></th>
                <th class="tg-yw4l"></th>
                <th class="tg-l2oz">DATA SOLICITAÇÃO:</th>
                <th class="tg-d55q"><?= date('d/m/Y', strtotime($ordem->getData_cad_ordem())) ?></th>
            </tr>
            <tr>
                <td class="tg-9hbo">SOLICITANTE:</td>
                <td class="tg-yw4l"><?= $ordem->getSolicitatante_ordem() ?></td>
                <td class="tg-yw4l"></td>
                <td class="tg-l2oz">TELEFONE:</td>
                <td class="tg-yw4l"><?= $cliente->getTelefone_um_cliente() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo" colspan="5">DATA / HORA INICIO: ______/_____/______   _____:_____  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA / HORA INICIO: ______/_____/______    _____:_____</td>
            </tr>
            <tr>
                <td class="tg-9hbo">ENDEREÇO:</td>
                <td class="tg-yw4l" colspan="4"><?= $cliente->getEndereco_cliente() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo">ATENDENTE:</td>
                <td class="tg-yw4l"><?= $ordem->getCod_atendente_ordem()->getNome_atendente() ?></td>
                <td class="tg-yw4l"></td>
                <td class="tg-l2oz">TÉCNICO:</td>
                <td class="tg-yw4l"><?= $ordem->getCod_tecnico_ordem()->getNome_tecnico() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo">TIPO DE O.S.</td>
                <td class="tg-yw4l" colspan="2"><?= $ordem->getCod_tipo_ordem()->getDesc_tipo() ?></td>
                <td class="tg-yw4l"></td>
                <td class="tg-yw4l"></td>
            </tr>
            <tr>
                <td class="tg-9hbo">DESCRIÇÃO:</td>
                <td class="tg-yw4l" colspan="4"><?= $ordem->getDesc_ordem() ?></td>
            </tr>
            <tr>
                <td class="tg-9hbo">OBSERVAÇÕES:</td>
                <td class="tg-yw4l" colspan="4"><?= $ordem->getDesc_total_ordem() ?></td>
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
                <td class="tg-9hbo" colspan="5">ATENDIMENTO CONCLUÍDO: SIM (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NÃO (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)&nbsp; MOTIVO: _________________________________________________</td>
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

    </body>
</html>
