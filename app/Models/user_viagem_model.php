<?php namespace App\Models;

use CodeIgniter\Model;

class user_viagem_model extends Model
{
        protected $table      = 'usuario_viagem';
        protected $primaryKey = 'cod_usuario';
    
        protected $returnType     = 'object';
        protected $useSoftDeletes = false;
    
protected $allowedFields = ['cod_usuario','cod_viagem'];
    
        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';
    
        //protected $validationRules    = 'viagens';
        protected $validationMessages = [];
        protected $skipValidation     = false;
    
}