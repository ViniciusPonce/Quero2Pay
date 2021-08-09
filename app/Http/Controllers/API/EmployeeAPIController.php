<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmployeeAPIRequest;
use App\Http\Requests\API\UpdateEmployeeAPIRequest;
use App\Models\Employee;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * Class EmployeeController
 * @package App\Http\Controllers\API
 */

class EmployeeAPIController extends AppBaseController
{
    /** @var  EmployeeRepository */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the Employee.
     * GET|HEAD /employees
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $employees = $this->employeeRepository->all();
            return response()->json($employees);

        } catch (\Exception $e) {
            if(config('app.debug')){
                return $this->sendError('Nenhum funcionário encontrado', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }

    }

    /**
     * Store a newly created Employee in storage.
     * POST /employees
     *
     * @param CreateEmployeeAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEmployeeAPIRequest $request)
    {
        try {

            $input = $request->all();

            $this->employeeRepository->create($input);

            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Funcionario cadastrado com sucesso'
                ],
                201
            );
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $this->sendError('Erro ao cadastrar funcionario, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * Display the specified Employee.
     * GET|HEAD /employees/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $input = $this->employeeRepository->find($id);

            if(!empty($input)){
                return $this->sendResponse(new EmployeeResource($input), 'Funcionáio encontrado com sucesso');
            }

        }catch (\Exception $e){
            if (config('app.debug')) {
                return $this->sendError('Funcionário não encontrado, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * Update the specified Employee in storage.
     * PUT/PATCH /employees/{id}
     *
     * @param int $id
     * @param UpdateEmployeeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeAPIRequest $request)
    {
        try {
            $input = $request->all();
            /** @var Employee $employee */
            $employee = $this->employeeRepository->find($id);

            if (empty($employee)) {
                return $this->sendError('Funcionário não encontrado');
            }

            $employee = $this->employeeRepository->update($input, $id);

            return $this->sendResponse(new EmployeeResource($employee), 'Funcionário atualizado com sucesso');

        } catch (\Exception $e){
            if (config('app.debug')) {
                return $this->sendError('Funcionario não cadastrado, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * Remove the specified Employee from storage.
     * DELETE /employees/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            /** @var Employee $employee */
            $employee = $this->employeeRepository->find($id);

            if (empty($employee)) {
                return $this->sendError('Funcionário não encontrado');
            }

            $employee->delete();

            return $this->sendResponse(new EmployeeResource($employee), 'Funcionário deletado com sucesso');

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $this->sendError('Funcionario não cadastrado, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * @param $empresa_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showEmployeeCompany($empresa_id, Request $request)
    {
        try {

            $employees = EmployeeRepository::showEmployeeCompany($empresa_id);
            return response()->json($employees);

        } catch (\Exception $e) {
            if(config('app.debug')){
                return $this->sendError('Nenhum funcionário encontrado', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectRolesEmployee(Request $request)
    {
        try {
            $employees = Employee::CARGOS;

            return response()->json($employees);

        } catch (\Exception $e) {
            if(config('app.debug')){
                return $this->sendError('Nenhum funcionário encontrado', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function dataEmployeeModal($id, Request $request)
    {
        try {

            $employee = EmployeeRepository::dataEmployeeModal($id);
            return response()->json($employee);

        }catch (\Exception $e){
            if (config('app.debug')) {
                return $this->sendError('Funcionário não encontrado, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function listAll(Request $request)
    {
        try {
            $employees = EmployeeRepository::allEmployeesList();

            return response()->json($employees);

        }catch (\Exception $e){
            if (config('app.debug')) {
                return $this->sendError('Nenhum funcionário cadastrado', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function searchNameField($name)
    {
        try {

            $employees = EmployeeRepository::searchNameField($name);
            $employeeData = $employees->all();

            if (!empty($employeeData)) {
                return $this->sendResponse($employeeData, 'Funcionario encontrado com sucesso');
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $this->sendError('Funcionário nao encontrado, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }
}
