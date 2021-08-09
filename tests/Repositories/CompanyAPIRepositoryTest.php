<?php namespace Tests\Repositories;

use App\Models\CompanyAPI;
use App\Repositories\CompanyAPIRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CompanyAPIRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CompanyAPIRepository
     */
    protected $companyAPIRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->companyAPIRepo = \App::make(CompanyAPIRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->make()->toArray();

        $createdCompanyAPI = $this->companyAPIRepo->create($companyAPI);

        $createdCompanyAPI = $createdCompanyAPI->toArray();
        $this->assertArrayHasKey('id', $createdCompanyAPI);
        $this->assertNotNull($createdCompanyAPI['id'], 'Created CompanyAPI must have id specified');
        $this->assertNotNull(CompanyAPI::find($createdCompanyAPI['id']), 'CompanyAPI with given id must be in DB');
        $this->assertModelData($companyAPI, $createdCompanyAPI);
    }

    /**
     * @test read
     */
    public function test_read_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->create();

        $dbCompanyAPI = $this->companyAPIRepo->find($companyAPI->id);

        $dbCompanyAPI = $dbCompanyAPI->toArray();
        $this->assertModelData($companyAPI->toArray(), $dbCompanyAPI);
    }

    /**
     * @test update
     */
    public function test_update_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->create();
        $fakeCompanyAPI = factory(CompanyAPI::class)->make()->toArray();

        $updatedCompanyAPI = $this->companyAPIRepo->update($fakeCompanyAPI, $companyAPI->id);

        $this->assertModelData($fakeCompanyAPI, $updatedCompanyAPI->toArray());
        $dbCompanyAPI = $this->companyAPIRepo->find($companyAPI->id);
        $this->assertModelData($fakeCompanyAPI, $dbCompanyAPI->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_company_a_p_i()
    {
        $companyAPI = factory(CompanyAPI::class)->create();

        $resp = $this->companyAPIRepo->delete($companyAPI->id);

        $this->assertTrue($resp);
        $this->assertNull(CompanyAPI::find($companyAPI->id), 'CompanyAPI should not exist in DB');
    }
}
