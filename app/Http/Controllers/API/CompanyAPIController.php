<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompanyAPIRequest;
use App\Http\Requests\API\UpdateCompanyAPIRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Response;


/**
 * Class CompanyController
 * @package App\Http\Controllers\API
 */

class CompanyAPIController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the Company.
     * GET|HEAD /companies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $companies = $this->companyRepository->all();
            return response()->json($companies);

        } catch (\Exception $e){
            if(config('app.debug')){
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
        }catch (\Exception $e){
            if(config('app.debug')){
                return $this->sendError('Erro ao cadastrar empresa, verifique os dados', 203);
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
    public function show($id)
    {
        try {
            $input = $this->companyRepository->find($id);

            return $this->sendResponse(new CompanyResource($input), 'Empresa encontrada com sucesso');

        }catch (\Exception $e){
            if(config('app.debug')){
                return $this->sendError('Empresa nao encontrada, verifique os dados');
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

        }catch (\Exception $e){
            if(config('app.debug')){
                return $this->sendError('Empresa nao encontrada, verifique os dados');
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

        if (empty($company)) {
            return $this->sendError('Empresa não encontrada');
        }

        $company->delete();

        return $this->sendSuccess('Empresa deletada com sucesso');

        }catch (\Exception $e){
            if(config('app.debug')){
                return $this->sendError('Verifique os dados');
            }
            return $this->sendError('Erro de operação', 1011);
        }
    }
}
