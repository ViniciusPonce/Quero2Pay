<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class CompanyRepository
 * @package App\Repositories
 * @version August 3, 2021, 2:06 am UTC
*/

class CompanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nome',
        'cep',
        'rua',
        'bairro',
        'cidade',
        'estado',
        'numero',
        'complemento',
        'telefone',
        'created_at',
        'updated_at'
    ];

    public static function employeesThisCompany(int $id)
    {
        return DB::table('employees')
            ->where('empresa_id', $id)
            ->get();
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Company::class;
    }
}
