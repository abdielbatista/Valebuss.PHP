<?php

namespace App\Controllers;

use CodeIgniter\CLI\CLI;

class Viagens extends BaseController
{

    public function Viag()
    {
        if (!$this->isLoggedIn()) {

            $this->session->setFlashData('msgErro', 'Faça o login primeiro.');

            return redirect()->to(base_url('site/login'));
        } else {

            $session = session();
            $log = $session->get('email');

            $data['titulo'] = "Página inicial CU";
            $data['logado'] = $this->isLoggedIn();

            $viagensModel = new \App\Models\public_carona_model(); 

            $viagensPubli = $viagensModel->findAll();

            //$urlUser = $usuarioModel->where('email_user', $log)->findAll();
            //d($urlUser);

            if (count($viagensModel) == 0) {
                $data['titulo'] = "Página Inicial";
                $data['erro'] = "Nenhuma Viagem publicada";

                return view('index_login.php', $data);
            }else{

                //$data['urli'] = $raizSistema;
                $data['titulo'] = "Página Inicial";
                $data['viagens'] = $viagensPubli;

                return view('index_login.php', $data);
            }
        }
    }

    public function aceitar(){
        $email = $this->request->getPost('emailuser');
		$codviagem = $this->request->getPost('codviagem');

        // viagens que  estou participando
			$user_viagem_model = new \App\Models\user_viagem_model(); 

            $user_viagem = $user_viagem_model->where('cod_usuario', $email )->findAll();
            
    
            $viagensModel2 = new \App\Models\public_carona_model(); 
    
            $z = 1;
            arsort($user_viagem);
            foreach($user_viagem as $viagens_m2){
                if($viagens_m2->cod_usuario == $email and $viagens_m2->cod_viagem == $codviagem){

                    
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
                        $data['usuario_cad'] = 1;
                        $data['viagens'] = $viagensPubli;
                       
                        

                        return view('index_login.php', $data);
                            
                }
                
            }
            
            //print_r($user_viagem);

        $dados = [
			'cod_usuario' => $email,
			'cod_viagem' => $codviagem,
		];

		$viagemModel = new \App\Models\viagem_model();
		$viagemModel->insert($dados);

       //$data['viages_participando'] = $user_viagem;

        return redirect()->to(base_url('user/minhas_viagens'));

    }
}
