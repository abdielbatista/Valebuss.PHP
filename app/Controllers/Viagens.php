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
}
