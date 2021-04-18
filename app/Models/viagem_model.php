<?php namespace App\Models;

use CodeIgniter\Model;

class viagem_model extends Model
{
    protected $table      = 'usuario_viagem';
    protected $primaryKey = 'cod_usuario';    

protected $allowedFields = ['cod_usuario', 'cod_viagem'];
    protected $returnType     = 'array';


    /*protected $validationRules = [
        'nome' => 'required|min_length[3]|alpha_numeric',
        'email' => 'required|min_length[3]|is_unique[usuarios.email]|valid_email',
        'senha' => 'required|min_length[3]'
    ];*/
}