<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Company
 * @package App\Models
 * @version August 3, 2021, 2:06 am UTC
 *
 * @property string $Company
 * @property string $description
 */
class Company extends Model
{

    public $table = 'companies';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public $fillable = [
        'nome',
        'cep',
        'rua',
        'bairro',
        'cidade',
        'estado',
        'numero',
        'complemento',
        'telefone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cep' => 'string',
        'rua' => 'string',
        'bairro' => 'string',
        'cidade' => 'string',
        'estado' => 'string',
        'numero' => 'integer',
        'complemento' => 'string',
        'telefone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required|max:200',
        'cep' => 'required',
        'rua' => 'required',
        'bairro' => 'required',
        'cidade' => 'required',
        'estado' => 'required',
        'numero' => 'required'
    ];


}
