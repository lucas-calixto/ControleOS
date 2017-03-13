<table class="table">
    <thead>
        <tr>
            <th class="col-lg-3">Cliente</th>
            <th class="col-lg-2">Qualificação</th>
            <th class="col-lg-7">Observações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data_inicio = filter_input(INPUT_POST, "data_inicio");
        $data_fim = filter_input(INPUT_POST, "data_fim");
        $tecnico = filter_input(INPUT_POST, "tecnico");
        $cont = 0;
        $tempo = 0;

        foreach ($daoRelatorio->listaAtendimento(0, 1000, $data_inicio, $data_fim, $tecnico) as $atendimento) {
            $cont++;
            ?>
            <tr>
                <td><?php
                    $cliente = $clienteDAO->busca($atendimento->getOrdem_atendimento()->getCod_cliente_ordem());
                    echo $cliente->getNome_cliente();
                    ?>
                </td>
                <td><?php
                    echo $atendimento->getNota_atendimento();
                    ?></td>
                <td><?= $atendimento->getObs_atendimento() ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>