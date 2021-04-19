<?php namespace App\Controllers;

use CodeIgniter\CLI\CLI;

class User extends BaseController
{
	//parte que so pode ser acessada se estiver logado
	
	public function index_login()
	{

		if(! $this->isLoggedIn()){

			$this->session->setFlashData ('msgErro', 'Faça o login primeiro.');

			return redirect()->to(base_url('site/login'));
		}
		
		
		else {

            $session = session();
            $log = $session->get('email');

            $data['titulo'] = "Página inicial CU";
            $data['logado'] = $this->isLoggedIn();

            $viagensModel = new \App\Models\public_carona_model(); 

            $viagensPubli = $viagensModel->where('cod_usuario !=',  $log )->findAll();

		
			

			//$dados_viagens = $viagensModel->where('cod_usuario', $log)->findAll();

			$dados_cidade_model = new \App\Models\dados_cidade_model();

			if(count($viagensPubli) != 0){
				$db      = \Config\Database::connect();

				$x = 1;
				arsort($viagensPubli);
				foreach($viagensPubli as $viagens){
				
					$query1 = $db->query("SELECT nome FROM cidades WHERE cod_cidade = '$viagens->cidade_destino' ");
					$row1 = $query1->getRowArray();
					
					$query2 = $db->query("SELECT nome FROM cidades WHERE cod_cidade = '$viagens->cidade_origem' ");
					$row2 = $query2->getRowArray();
					
					$viagens->cidade_destino = $row1['nome'];
					$viagens->cidade_origem = $row2['nome'];
				
					$viagens->data_viagem = date('d/m/Y',strtotime($viagens->data_viagem));
					$x++;
				}

			}

            //$urlUser = $usuarioModel->where('email_user', $log)->findAll();
            //d($urlUser);
			

                //$data['urli'] = $raizSistema;
                $data['titulo'] = "Página Inicial";
                $data['viagens'] = $viagensPubli;
				

                return view('index_login.php', $data);
			
		}
	}

	public function minhas_viagens(){
		$raizSistema = "http://localhost/valebuss/public/";
		if(! $this->isLoggedIn()){

			$this->session->setFlashData ('msgErro', 'Faça o login primeiro.');

			return redirect()->to(base_url('site/login'));
		}

		$session = session();
        //$log = $session->get('logado');
        //$nome = $session->get('nome');
        $id = $session->get('id');

		$log = $session->get('email');

        $data['titulo'] = "ValeBuss - Minhas Viagens";
        $data['logado'] = $this->isLoggedIn();


		//buscando dados para apresentar na tela de viagens/postadas
	
		$viagensModel = new \App\Models\public_carona_model(); 

        $dados_viagens = $viagensModel->where('cod_usuario', $log)->findAll();

		$dados_cidade_model = new \App\Models\dados_cidade_model();

		if(count($dados_viagens) != 0){
			$db      = \Config\Database::connect();

			$x = 1;
			arsort($dados_viagens);
			foreach($dados_viagens as $viagens){
			
				$query1 = $db->query("SELECT nome FROM cidades WHERE cod_cidade = '$viagens->cidade_destino' ");
				$row1 = $query1->getRowArray();
				
				$query2 = $db->query("SELECT nome FROM cidades WHERE cod_cidade = '$viagens->cidade_origem' ");
				$row2 = $query2->getRowArray();
				
				$viagens->cidade_destino = $row1['nome'];
				$viagens->cidade_origem = $row2['nome'];
			
				$viagens->data_viagem = date('d/m/Y',strtotime($viagens->data_viagem));
				$x++;
			}

		}
	

		//buscando dados para apresenntar na tela de viagens/participan
		$user_viagem_model = new \App\Models\user_viagem_model(); 

        $user_viagem = $user_viagem_model->where('cod_usuario', $log )->findAll();
		
		


		$viagensModel2 = new \App\Models\public_carona_model(); 

		$z = 1;
		arsort($user_viagem);
        foreach($user_viagem as $viagens_m2){
			//echo $viagens_m2->cod_viagem;
			$va = $viagens_m2->cod_viagem;
			
			$z++;
		}
		
		//print_r($user_viagem);

		
		$dados_viagens2 = $viagensModel2->findAll();
		
		//print_r($dados_viagens2);
		//$dados_cidade_model2 = new \App\Models\dados_cidade_model();
		//$t = count($dados_viagens2);
	

		if(count($dados_viagens2) != 0){
			$db      = \Config\Database::connect();

			$x = 1;
			arsort($dados_viagens2);
			foreach($dados_viagens2 as $userviagem2){
			
				$query1 = $db->query("SELECT nome FROM cidades WHERE cod_cidade = '$userviagem2->cidade_destino' ");
				$row1 = $query1->getRowArray();
				
				$query2 = $db->query("SELECT nome FROM cidades WHERE cod_cidade = '$userviagem2->cidade_origem' ");
				$row2 = $query2->getRowArray();
				
				$userviagem2->cidade_destino = $row1['nome'];
				$userviagem2->cidade_origem = $row2['nome'];
			
				$userviagem2->data_viagem = date('d/m/Y',strtotime($userviagem2->data_viagem));
				$x++;
			}

		}
	
	
		//usuarios cadastrados na viagem x
		$userModel = new \App\Models\user_viagem_model();
		$dados_user = $userModel->findAll(); 
		
		


		if(count($dados_viagens) == NULL ){
			$data['titulo'] = "ValeBuss - Minhas Viagens";
			$data['erro1'] = "Nenhuma viagem encontrada";
		}
		if( count($user_viagem) == NULL){
			$data['titulo'] = "ValeBuss - Minhas Viagens";
			$data['erro2'] = "Nenhuma viagem encontrada";
		}

		$data['viagem_null'] = $raizSistema;
		$data['dados_viagens'] = $dados_viagens;
		$data['dados_viagens2'] = $dados_viagens2;
		$data['user_viagem'] = $user_viagem;
		$data['dados_user'] = $dados_user;
		//return view('minhas_viagens.php', $data);
	
		
		return view('minhas_viagens', $data);	

	}


	

	public function publica_carona(){
		if(! $this->isLoggedIn()){

			$this->session->setFlashData ('msgErro', 'Faça o login primeiro.');

			return redirect()->to(base_url('site/login'));
		}
		
		$endsaida = $this->request->getPost('endsaida');
		$endchegada = $this->request->getPost('endchegada');
		$estado = $this->request->getPost('estado');
		$cidsaida = $this->request->getPost('cidsaida');
		$cidchegada = $this->request->getPost('cidchegada');
		$data =  $this->request->getPost('data');
		$horario = $this->request->getPost('horario');
		$obs = $this->request->getPost('obs');

		$dados_cidade_model = new \App\Models\dados_cidade_model();

		//SELECT cid.cod_cidade , cid.id_estado, es.id, es.uf FROM  cidades  as cid JOIN  estados as es ON cid.id_estado = es.id WHERE cid.nome = 'Araçuaí'

		$db      = \Config\Database::connect();

		$builder1 = $db->table('estados');
		$query1 = $db->query("SELECT cid.cod_cidade, es.id, es.uf FROM cidades as cid JOIN estados as es ON cid.id_estado = es.id WHERE cid.nome = '$cidsaida' and es.uf = '$estado' ");
		$row1 = $query1->getRowArray();
		$cidsaida = $row1['cod_cidade'];

		
		$query2 = $db->query("SELECT cid.cod_cidade, es.id FROM cidades as cid JOIN estados as es ON cid.id_estado = es.id WHERE cid.nome = '$cidchegada' and es.uf = '$estado' ");
		$row2 = $query2->getRowArray();
		$cidchegada = $row2['cod_cidade'];
		
		$builder1 = $db->table('viagem');
		$query3 = $db->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'viagens' AND table_schema = 'valebuss' ");
		$row3 = $query3->getRowArray();
		$auto_increment = $row3['AUTO_INCREMENT'] ;
		

		

		/*$builder = $db->table('cidades');

		$query = $db->query("SELECT cod_cidade ,nome , id_estado FROM cidades WHERE cod_cidade = '$id_estado1'  ");
		$row = $query->getRowArray();
		$cidsaida = $row['cod_cidade'];
		*/

		$public_carona_model = new \App\Models\public_carona_model();
		
		$dados = [
			'cod_viagem' => "",
			'end_origem' => $endsaida,
			'end_destino' => $endchegada,
			'cidade_origem' => $cidsaida,
			'cidade_destino' => $cidchegada,
			'horario_saida' => $horario,
			'descricao' =>  $obs,
			'cod_usuario' => $_SESSION['email'],
			'data_viagem' => $data
		];

		$public_carona_model = new \App\Models\public_carona_model(); 
		$public_carona_model->insert($dados);
		
		//inserindo na tabela viagem_cidade
		$db2      = \Config\Database::connect();

		$builder5 = $db2->table('viagem_cidade');
		$data = [
			'cod_viagem' => $auto_increment,
			'cod_cidade'  => $cidchegada
		];
		
		$builder5->insert($data);

		//$session = session();
        //$log = $session->get('logado');
        //$nome = $session->get('nome');
        //$id = $session->get('id');

		

        $data['titulo'] = "CurtURL's - Página Inicial";
        $data['logado'] = $this->isLoggedIn();

		
		return redirect()->to(base_url('user/index_login'));

		
	}

	//cadastrar os novos usuarios
	public function inseriruser()
	{
		$data['msg'] = "";
		$data['erro_email'] = "";
		$data['erro_nome_senha'] = "";


		$nome = $this->request->getPost('nome');
		$email = $this->request->getPost('email');
		$senha = $this->request->getPost('senha');
		$senhacon = $this->request->getPost('senhacon');



		$pessoaModel = new \App\Models\pessoa_model(); 
			

		$valida_dados = [
			'nome' => $nome,
			'email' => $email,
			'Senha' => $senha,
			'senhacon' => $senhacon
		];


		$validation =  \Config\Services::validation();
		$validation->setRuleGroup('usuarios');

		if ( ! $validation->run( $valida_dados ) ){

			$validationErrors = $validation->getErrors();
			$data = $validation->listErrors();
			
			$this->session->setFlashData ('msgErro',$data);
			
			return redirect()->to(base_url('site/cadastro'));

		}
		
		
		date_default_timezone_set('America/fortaleza');
		$dados = [
			'nome' => $nome,
			'email' => $email,
			'senha' => password_hash($senha, PASSWORD_DEFAULT)
		];
		
		//inserindo usuario
		$usuarioModel = new \App\Models\user_model(); 
		$usuarioModel->insert($dados);
		


		//inserir veiculo
		$placa = $this->request->getPost('placa');
		$marca = $this->request->getPost('marca');
		$modelo = $this->request->getPost('modelo');
		$qtlugares = $this->request->getPost('qtlugares');

		
		$dados_veiculos = [
			'placa' => $placa,
			'marca' => $marca,
			'modelo' => $modelo,
			'qt_lugares' => $qtlugares,
			'cod_usuario' => $email
		];

		

		//inserindo veiculo 
		$veiculo_model = new \App\Models\veiculo_model();
		$veiculo_model->insert($dados_veiculos);



		$this->session->set('logado', 1);
		$this->session->set('nome', $nome);
		$this->session->set('email', $email);
		
		
		return redirect()->to(base_url('user/index_login'));		
		
	

	}
	
	public function new_senha(){
		$msgErro = $this->session->getFlashData('msgErro');
		$data = [
			'titulo' => "CurtURL's - Nova Senha",
			'logado' => $this->isLoggedIn(),
			'msgErro' => $msgErro
		] ;

		return view('new_senha.php',$data);
	}

	public function alteraSenha(){
		
	
		$email = $_SESSION['email'];
		

		$senhaAtual = $this->request->getPost('senhaAtual');
		$novaSenha = $this->request->getPost('novaSenha');
		$senhaConf = $this->request->getPost('senhaConf');
		
		
		$db = \Config\Database::connect();
       

        $query = $db->query("SELECT senha FROM usuarios WHERE email = '$email' ");
		$senhaAtual_bd = $query->getRow('senha');
			

		if(password_verify($senhaAtual, $senhaAtual_bd)){
			//password_hash($senha, PASSWORD_DEFAULT)
			if($novaSenha == $senhaConf){
				$usuarioModel = new \App\Models\pessoa_model();
                   
				$update_usuarios = [
					'senha' =>password_hash($novaSenha, PASSWORD_DEFAULT)
				];

				$db2      = \Config\Database::connect();
				$update_usuarioModel = $db2->table('usuarios');

				$update_usuarioModel->where('email', $email);
				$update_usuarioModel->update($update_usuarios);
				return redirect()->to(base_url('user/index_login'));
				}
			else{
				$this->session->setFlashData('msgErro', 'A nova senha e a de confirmacao devem ser iguais ! ');
				return redirect()->to(base_url('user/new_senha'));
			}

			
		}

		else{
			$this->session->setFlashData('msgErro', 'Senha Invalida');
			
			return redirect()->to(base_url('user/new_senha'));
		}
		
		


		
	}


}	