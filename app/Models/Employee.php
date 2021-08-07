<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Employee
 * @package App\Models
 * @version August 4, 2021, 1:47 pm UTC
 *
 * @property string $nome
 * @property string $description
 */
class Employee extends Model
{

    public $table = 'employees';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public const CARGOS = ['Programador', 'Designer', 'Administração'];

    public $fillable = [
        'nome_funcionario',
        'cargo',
        'salario',
        'empresa_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nome_funcionario' => 'string',
        'cargo' => 'string',
        'salario' => 'float',
        'empresa_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome_funcionario' => 'required|string|max:200',
        'cargo' => 'required|required'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

}
