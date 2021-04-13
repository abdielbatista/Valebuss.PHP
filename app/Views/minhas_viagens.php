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

<center><h1 style="color:white"><b>Minhas Viagens</b></h1></center>

<div class="card-group " style="height: 29.7rem; padding-left:0px; padding-right:0px">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title text-center font-weight-bold">Postadas</h2>

      <br>
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Cidade Destino</th>
      <th scope="col">Endereço</th>
      <th scope="col">Destino</th>
      <th scope="col">Horário</th>
      <th scope="col">Passageiros</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Araçuai</td>
      <td>Praça das rosas</td>
      <td>Ifnmg araçuai</td>
      <td>10:20</td>
      <td><i class="fa fa-user-plus" style="font-size:25px;color:blue" title="Clique para Visulizar Passageiros"></i></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Praça das rosas</td>
      <td>Thornton</td>
      <td>10:20</td>
      <td><i class="fa fa-user-plus" style="font-size:25px;color:blue" title="Clique para Visulizar Passageiros"></i></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Jacob</td>
      <td>Praça das rosas</td>
      <td>Thornton</td>
      <td>10:20</td>
      <td><i class="fa fa-user-plus" style="font-size:25px;color:blue" title="Clique para Visulizar Passageiros"></i></td>
    </tr>
    
    
    <tr>
      <th scope="row">4</th>
      <td>Jacob</td>
      <td>Praça das rosas</td>
      <td>Thornton</td>
      <td>10:20</td>
      <td><i class="fa fa-user-plus" style="font-size:25px;color:blue" title="Clique para Visulizar Passageiros"></i></td>
    </tr>


    

    
    
  </tbody>
</table>

      
</div>
  </div>

  <!--Segunda coluna do card -->

  <div class="card">
    <div class="card-body">
      <h2 class="card-title text-center font-weight-bold">Participando</h2>
      <br>

      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Fornecedor</th>
      <th scope="col">Cidade</th>
      <th scope="col">Endereço</th>
      <th scope="col">destino</th>
      <th scope="col">Horário</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Usuário</td>
      <td>Araçuai</td>
      <td>Praça das rosas</td>
      <td>Instituto Federal</td>
      <td>10:20</td>
      
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>Praça das rosas</td>
      <td>Instituto Federal</td>
      <td>10:20</td>
      
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>Praça das rosas</td>
      <td>Instituto Federal</td>
      <td>10:20</td>
      
    </tr>

    <tr>
      <th scope="row">4</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>Praça das rosas</td>
      <td>Instituto Federal</td>
      <td>10:20</td>
     
    </tr>


    

    
    
  </tbody>
</table>
      


    </div>
    </div>
  </div>


</div>


<?php
echo $this->include('includes/footer');

?>
