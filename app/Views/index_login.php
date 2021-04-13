<?php
//header
echo $this->include('includes/header', array('titulo' => $titulo));

//css da pagina
echo $this->include('includes/style');

//footer padrão
echo $this->include('includes/footer');

?>

<?php $session = session(); ?>
<br>





<div class="card-group card border border-dark" style="height: 32.7rem; padding-left:0px; padding-right:0px">
    <div class="card">
        <div class="card-body">


            <h5 class="text-center" style="font-weight:bold">Veja as caronas em aberto ou
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">PUBLIQUE UMA</button>
            </h5>



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastre sua viagem</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="inline" method="post" action="<?php echo base_url("user/publica_carona") ?>" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Endereço de saida</label>
                                    <input type="text" class="form-control" id="endsaida" name="endsaida" aria-describedby="text" placeholder="Rua X, Vila, 20" >
                                    <small id="text" class="form-text text-muted">Rua; Bairro; Numero</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Endereço de destino</label>
                                    <input type="text" class="form-control" id="endchegada" name="endchegada" aria-describedby="text" placeholder="Instituto Federal"  >
                                    <small id="text" class="form-text text-muted">Rua; Bairro; Numero</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" >Estado:</label>
                                    <select name="estado" id="estado" >
                                    <option selected>Abrir menu de seleção</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cidade de saida</label>
                                    <input type="text" class="form-control" id="cidsaida" name="cidsaida" aria-describedby="text" placeholder="Araçuaí" >
                                    <small id="text" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cidade de chegada</label>
                                    <input type="text" class="form-control" id="cidchegada" name="cidchegada" aria-describedby="text" placeholder="Araçuaí" >
                                    <small id="text" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Data </label>
                                    <input type="date" class="form-control" id="data" name="data"   >
                                    <small id="data" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">horario de saida </label>
                                    <input type="time" class="form-control" id="horario" name="horario"   >
                                    <small id="time" class="form-text text-muted"></small>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Observação</label>
                                    <input type="text" class="form-control" id="obs" name="obs" aria-describedby="text" placeholder="Descreva a viagem caso seja nescessario">
                                    <small id="text" class="form-text text-muted"></small>
                                </div>
                                
                                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" >Publicar</button>
                        </div>
                    </div>
                </div>
            </div>

<!-- card -->
<div class="card" style="width: 25rem;">
    <?php if (isset($viagens)) : ?>
    <?php foreach ($viagens as $v) : ?>

                               <!--if (foto de perfil for "none" coloca uma foto padrao) -->
        <div class="card-body">
          <h5 class="card-title">Carona para <?php echo $v->end_destino ?></h5>
          <p class="card-text">Endereço de saida: <?php echo $v->end_origem ?></p>
          <p class="card-text">Cidade origem: <?php echo $v->cidade_origem ?></p>
          <p class="card-text">Cidade destino: <?php echo $v->cidade_destino ?></p>
          <p class="card-text">Hora: <?php echo $v->horario_saida ?></p>
          <p class="card-text">Descrição: <?php echo $v->descricao ?></p>
          <p class="card-text">Publicado por: <?php echo $v->cod_usuario ?></p>
          <div class="card-footer text-muted">
            Horario: "horario"
          </div>
          <div class="card-footer text-muted">
            Descriçao:
          </div>
          <a href="#" class="btn btn-primary">Aceitar Viajem</a>
        </div>
      </div>
      <!-- -->
      <?php endforeach ?>
      <?php endif ?>
      

            
        </div>
    </div>
</div>

