<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class EmployeeRepository
 * @package App\Repositories
 * @version August 4, 2021, 1:47 pm UTC
*/

class EmployeeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nome_funcionario',
        'cargo',
        'salario',
        'empresa_id',
        'created_at',
        'updated_at'
    ];

    public static function showEmployeeCompany(int $id)
    {
        return  DB::table('employees')
            ->where('empresa_id', $id)
            ->get();
    }

    public static function dataEmployeeModal(int $id)
    {
        return DB::table('companies')
            ->join('employees', 'employees.empresa_id', 'companies.id')
            ->where('employees.id', $id)
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
        return Employee::class;
    }



}
