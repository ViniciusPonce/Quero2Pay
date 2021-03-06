<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompanyAPIRequest;
use App\Http\Requests\API\UpdateCompanyAPIRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

use function MongoDB\BSON\toJSON;


/**
 * Class CompanyController
 * @package App\Http\Controllers\API
 */

class CompanyAPIController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;
    private $employeeRepository;

    public function __construct(CompanyRepository $companyRepository, EmployeeRepository $employeeRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the Company.
     * GET|HEAD /companies
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
//            $companies = $this->companyRepository->all();
            $companies = Company::paginate(10);
            return response()->json($companies);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $this->sendError('Nenhuma empresa encontrada', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }

    }

    /**
     * Store a newly created Company in storage.
     * POST /companies
     *
     * @param CreateCompanyAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCompanyAPIRequest $request)
    {
        try {
            $input = $request->all();

            $this->companyRepository->create($input);

            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Empresa cadastrada com sucesso'
                ],
                201
            );
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $this->sendError('Erro ao cadastrar empresa, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }

    }

    /**
     * Display the specified Company.
     * GET|HEAD /companies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id)
    {
        try {
            $input = $this->companyRepository->find($id);

            if (!empty($input)){
                return $this->sendResponse(new CompanyResource($input), 'Empresa encontrada com sucesso');
            }

        } catch (\Exception $e) {
            if(config('app.debug')){
                return $this->sendError('Empresa nao encontrada, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * Update the specified Company in storage.
     * PUT/PATCH /companies/{id}
     *
     * @param int $id
     * @param UpdateCompanyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompanyAPIRequest $request)
    {
        try {
            $input = $request->all();
            /** @var Company $company */
            $company = $this->companyRepository->find($id);

            if (empty($company)) {
                return $this->sendError('Company not found');
            }

            $company = $this->companyRepository->update($input, $id);

            return $this->sendResponse(new CompanyResource($company), 'Company updated successfully');

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $this->sendError('Empresa nao encontrada, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }

    /**
     * Remove the specified Company from storage.
     * DELETE /companies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{
        /** @var Company $company */
        $company = $this->companyRepository->find($id);
        $employeesData = CompanyRepository::employeesThisCompany($id);
        $employeesForDelete = Employee::whereIn('id', $employeesData->pluck('id'));

        if (empty($company)) {
            return $this->sendError('Empresa não encontrada');
        }

        $employeesForDelete->delete();
        $company->delete();

        return $this->sendSuccess('Empresa deletada com sucesso');

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $this->sendError('Verifique os dados', 404);
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
            $company = CompanyRepository::searchNameField($name);
            $companyData = $company->all();

            if (!empty($companyData)) {
                return $this->sendResponse($companyData, 'Empresa encontrada com sucesso');
            }

        } catch (\Exception $e) {
            if(config('app.debug')){
                return $this->sendError('Empresa nao encontrada, verifique os dados', 404);
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }


}
