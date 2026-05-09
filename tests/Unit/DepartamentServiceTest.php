<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\DepartamentService;
use App\Services\Departament\Dao\DepartamentDao;
use App\Models\Departament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\FakultetSeeder; 

class DepartamentServiceTest extends TestCase
{
    use RefreshDatabase;
    use MockeryPHPUnitIntegration;

    protected $mockDao;
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(FakultetSeeder::class);
        $this->mockDao = Mockery::mock(DepartamentDao::class);
        $this->service = new DepartamentService($this->mockDao);
    }

    public function test_get_all_departaments()
    {
        $this->mockDao->shouldReceive('getAll')
            ->once()
            ->andReturn(new Collection([]));

        $result = $this->service->getAllDepartaments();

        $this->assertInstanceOf(Collection::class, $result);
    }

public function test_it_creates_departament_successfully()
    {
        // 3. NO MORE HACKS! We removed Validator::extend
        // The validator will now actually check the database we seeded above.

        $data = [
            'dep_id' => 'TST', 
            'dep_em' => 'Test Department Name',
            'fak_id' => 'FTI', // This ID exists thanks to the seeder
            'ped_id' => 'P12345678A'
        ];

        $this->mockDao->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn(new Departament($data));

        $result = $this->service->createDepartament($data);

        $this->assertEquals('TST', $result->dep_id);
    }
    public function test_create_departament_validation_fails()
    {
        $this->expectException(ValidationException::class);
        $this->service->createDepartament([]);
    }

    public function test_update_departament_not_found()
    {
        $id = 'NON';

        $this->mockDao->shouldReceive('findById')
            ->once()
            ->with($id)
            ->andReturn(null);

        $result = $this->service->updateDepartament($id, ['dep_em' => 'New Name']);

        $this->assertNull($result);
    }

    public function test_delete_departament_success()
    {
        $id = 'TST';
        $mockDepartament = new Departament(['dep_id' => 'TST']);

        $this->mockDao->shouldReceive('findById')
            ->once()
            ->with($id)
            ->andReturn($mockDepartament);

        $this->mockDao->shouldReceive('delete')
            ->once()
            ->with($mockDepartament)
            ->andReturn(true);

        $result = $this->service->deleteDepartament($id);

        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}