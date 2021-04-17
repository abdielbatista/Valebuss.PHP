<?php namespace App\Models;

use CodeIgniter\Model;

class veiculo_model extends Model
{
    protected $table      = 'veiculos';
    protected $primaryKey = 'placa';    

protected $allowedFields = ['placa', 'marca', 'modelo', 'qt_lugares', 'cod_usuario'];
    protected $returnType     = 'array';


    /*protected $validationRules = [
        'nome' => 'required|min_length[3]|alpha_numeric',
        'email' => 'required|min_length[3]|is_unique[usuarios.email]|valid_email',
        'senha' => 'required|min_length[3]'
    ];*/
}