<?php
//header
echo $this->include('includes/header', array('titulo' => $titulo));

//css da pagina
echo $this->include('includes/style');

//footer padrão
echo $this->include('includes/footer');
//style="height: 32.7rem; padding-left:px; padding-right:0px"
?>

<?php $session = session(); ?>

<?php if (isset($msgSuc)) : ?>

<script>
    window.onload = function() {
        M.toast({
            html: '<?php echo $msgSuc ?>'
        })
    };


   
</script>

<?php endif; ?>




<center><h1 style="color:white"><b>Minhas Viagens</b></h1></center>

<div class="card-group " style="height: 29.7rem; padding-left:0px; padding-right:0px;">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title text-center font-weight-bold">Postadas</h2>
      
      <?php if (isset($erro1)) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?php echo $erro1; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <?php endif; ?>

      <table class="table table-striped">
  <thead>
    <tr>
    <?php if (isset($dados_viagens) and !isset($erro1)) : ?>
      <th scope="col">#</th>
      <th scope="col">Origem/Destino</th>
      <th scope="col">Saida</th>
      <th scope="col">Destino</th>
      <th scope="col">Data</th>
      <th scope="col">Horário</th>
      <th scope="col">Passageiros</th>
    </tr>
  </thead>
  <tbody>
  
    <?php $c = 1;
        arsort($dados_viagens);
        foreach ($dados_viagens as $viagens) : ?>
      <tr>
        <th scope="row"><?php echo $c ?></th>
        <td ><?php echo $viagens->cidade_origem."/".$viagens->cidade_destino ?></td>
        <td><?php echo $viagens->end_origem ?></td>
        <td><?php echo $viagens->end_destino ?></td>
        <td><?php echo $viagens->data_viagem ?></td>
        <td><?php echo $viagens->horario_saida ?></td>
        <td><i class="fa fa-user-plus" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?php echo $c ?>"  style="font-size:25px;color:blue; cursor:pointer" title="Clique para Visulizar Passageiros" ></i></td>


      <!-- Modal -->
<div class="modal fade" id="exampleModalLong<?php echo $c ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle"><b>Usuários Cadastrados:</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
        arsort($dados_user);
        $cont = 1;
        foreach ($dados_user as $usuarios){
         
            if($viagens->cod_viagem == $usuarios->cod_viagem and $viagens->cod_usuario != $usuarios->cod_usuario){
              
              echo "<b>".$cont."°- ".$usuarios->cod_usuario."</b><br>";
              $cont++;
            }
            
        }

      
      ?>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </tr>
    <?php $c++ ?>

    <?php endforeach ?>
    <?php endif ?>
    
  </tbody>
  
</table>

      
</div>
  </div>

  <!--Segunda coluna do card -->

  <div class="card">
    <div class="card-body">
      <h2 class="card-title text-center font-weight-bold">Participando</h2>
    
      <?php if (isset($erro2)) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?php echo $erro2; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <?php endif; ?>
      <table class="table table-striped">
  <thead>
    <tr>
    <?php if (isset($user_viagem) and !isset($erro2)) : ?>
      <th scope="col">#</th>
      <th scope="col">Email Forn.</th>
      <th scope="col">Origem/Destino</th>
      <th scope="col">Saida</th>
      <th scope="col">Destino</th>
      <th scope="col">Data</th>
      <th scope="col">Horário</th>
    </tr>
  </thead>
  <tbody>
  
  <?php $x = 1;
      arsort($dados_viagens2);
      //arsort($userviagem);
      foreach ($dados_viagens2 as $userviagem2): ?>
    <tr>
    <?php foreach($user_viagem as $user_v):?>
    <?php if($userviagem2->cod_viagem == $user_v->cod_viagem){ ?>
      
      <th scope="row" ><?php echo $x ?></th>
      
      <td title="<?php  echo $userviagem2->cod_usuario ?>"><i class='fas fa-user-alt' style='font-size:24px'></i> </td>
      <td><?php  echo $userviagem2->cidade_origem."/".$userviagem2->cidade_destino ?></td>
      <td><?php  echo $userviagem2->end_origem ?></td>
      <td><?php  echo $userviagem2->end_destino ?></td>
      <td><?php  echo $userviagem2->data_viagem ?></td>
      <td><?php  echo $userviagem2->horario_saida ?></td>
     
  <?php $x++ ?>
  
  <?php } ?>
  <?php endforeach ?>
    <?php endforeach ?>
    <?php endif ?>
    

  </tbody>
</table>
      


    </div>
    </div>
  </div>


</div>


<?php
echo $this->include('includes/footer');

?>
