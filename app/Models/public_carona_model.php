<?php namespace App\Models;

use CodeIgniter\Model;

class public_carona_model extends Model
{
        protected $table      = 'viagens';
        protected $primaryKey = 'cod_viagem';
    
        protected $returnType     = 'object';
        protected $useSoftDeletes = false;
    
protected $allowedFields = ['cod_viagem','end_origem', 'end_destino', 'cidade_origem', 'cidade_destino', 'horario_saida', 'descricao', 'cod_usuario'];
    
        protected $useTimestamps = false;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';
    
        //protected $validationRules    = 'viagens';
        protected $validationMessages = [];
        protected $skipValidation     = false;
    
}