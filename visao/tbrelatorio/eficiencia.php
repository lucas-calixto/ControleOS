<table class="table">
    <thead>
        <tr>
            <th class="col-lg-3">Cliente</th>
            <th class="col-lg-2">Tempo Gasto</th>
            <th class="col-lg-7">Detalhes</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data_inicio = filter_input(INPUT_POST, "data_inicio");
        $data_fim = filter_input(INPUT_POST, "data_fim");
        $tecnico = filter_input(INPUT_POST, "tecnico");
        $cont = 0;
        $tempo = 0;

        foreach ($daoRelatorio->listaPorData(0, 1000, $data_inicio, $data_fim, $tecnico) as $ordem) {
            $cont++;
            ?>
            <tr>
                <td><?php
                    $cliente = $ordem->getCod_cliente_ordem();
                    echo $cliente->getNome_cliente();
                    ?>
                </td>
                <td><?php
                    $horaInicio = (date("G", strtotime($ordem->getHora_inicio_ordem())) * 60) + date("i", strtotime($ordem->getHora_inicio_ordem()));
                    $horaFim = (date("G", strtotime($ordem->getHora_fim_ordem())) * 60) + date("i", strtotime($ordem->getHora_fim_ordem()));
                    echo $horaFim - $horaInicio . " MINUTOS";
                    $tempo = $tempo + ($horaFim - $horaInicio);
                    ?></td>
                <td><?= $ordem->getDesc_resolve_ordem() ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <?php $tpm = floor($tempo / ($cont == 0 ? 1 : $cont)); ?>
</table>