<?php

namespace Tests\Unit;

// REMOVED: use PHPUnit\Framework\TestCase; <-- This was the cause of the error
use Tests\TestCase; 
use App\Services\StudentService;
use App\Services\Student\Dao\StudentDao;
use App\Models\Student;
use Illuminate\Validation\ValidationException;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class StudentServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected $studentDaoMock;
    protected $studentService;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Create a Mock for the DAO
        $this->studentDaoMock = Mockery::mock(StudentDao::class);

        // 2. Inject the Mock into the Service
        $this->studentService = new StudentService($this->studentDaoMock);
    }

    /**
     * Test successful student creation.
     */
    public function test_create_student_with_valid_data()
    {
        $validData = [
            'stu_id'             => 'DRABCA123456',
            'stu_em'             => 'Dionis',
            'stu_mb'             => 'Mbiemri',
            'stu_gjini'          => 'M',
            'stu_dl'             => '2000-01-01',
            'stu_nuid'           => 'A12345678B',
            'stu_email'          => 'dionis.test@university.edu.al',
            'stu_dat_regjistrim' => '2026-05-01'
        ];

        $this->studentDaoMock
            ->shouldReceive('create')
            ->once()
            ->with($validData)
            ->andReturn(new Student($validData));

        $result = $this->studentService->createStudent($validData);

        $this->assertInstanceOf(Student::class, $result);
        $this->assertEquals('Dionis', $result->stu_em);
    }

    /**
     * Test validation failure (Invalid Email).
     */
    public function test_create_student_fails_with_invalid_email()
    {
        $this->expectException(ValidationException::class);

        $invalidData = [
            'stu_id'    => 'DRABCA123456',
            'stu_em'    => 'John',
            'stu_mb'    => 'Doe',
            'stu_gjini' => 'M',
            'stu_dl'    => '2000-01-01',
            'stu_nuid'  => '1234567890',
            'stu_email' => 'not-an-email', 
        ];

        $this->studentDaoMock->shouldNotReceive('create');

        $this->studentService->createStudent($invalidData);
    }

    /**
     * Test update logic for non-existent student.
     */
    public function test_update_returns_null_if_student_not_found()
    {
        $id = 'NON_EXISTENT_ID';
        
        $this->studentDaoMock
            ->shouldReceive('findById')
            ->once()
            ->with($id)
            ->andReturn(null);

        $result = $this->studentService->updateStudent($id, ['stu_em' => 'New Name']);

        $this->assertNull($result);
    }

    /**
     * Test delete logic handles missing student.
     */
    public function test_delete_returns_false_if_student_not_found()
    {
        $id = '99999';

        $this->studentDaoMock
            ->shouldReceive('findById')
            ->once()
            ->with($id)
            ->andReturn(null);

        $result = $this->studentService->deleteStudent($id);

        $this->assertFalse($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}