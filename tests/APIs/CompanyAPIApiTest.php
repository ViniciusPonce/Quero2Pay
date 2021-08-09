<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CompanyAPI;

class CompanyAPIApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/company_a_p_is', $companyAPI
        );

        $this->assertApiResponse($companyAPI);
    }

    /**
     * @test
     */
    public function test_read_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/company_a_p_is/'.$companyAPI->id
        );

        $this->assertApiResponse($companyAPI->toArray());
    }

    /**
     * @test
     */
    public function test_update_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->create();
        $editedCompanyAPI = factory(CompanyAPI::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/company_a_p_is/'.$companyAPI->id,
            $editedCompanyAPI
        );

        $this->assertApiResponse($editedCompanyAPI);
    }

    /**
     * @test
     */
    public function test_delete_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/company_a_p_is/'.$companyAPI->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/company_a_p_is/'.$companyAPI->id
        );

        $this->response->assertStatus(404);
    }
}
