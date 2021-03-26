<?php namespace App\Models;

use CodeIgniter\Model;

class dados_cidade_model extends Model
{
        protected $table      = 'cidades';
        protected $primaryKey = 'cod_cidade';
    
        protected $returnType     = 'object';
        protected $useSoftDeletes = false;
    
protected $allowedFields = ['cod_cidade', 'nome', 'id_estado'];
    
        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';
    
        //protected $validationRules    = 'viagens';
        protected $validationMessages = [];
        protected $skipValidation     = false;
    
}