<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'categoria'; // Cambia 'categoria' por el nombre de tu tabla
    protected $primaryKey = 'idCategoria';
    protected $allowedFields = ['idCategoria', 'descripcion']; // Campos permitidos
}