<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\SeksionHelper;

class SeksionHelperTest extends TestCase
{
    /** @test */
    public function test_rendit_ditet_returns_correct_array()
    {
        $expected = ['Hene', 'Marte', 'Merkure', 'Enjte', 'Premte', 'Shtune', 'Diele'];
        $this->assertEquals($expected, SeksionHelper::renditDitet());
    }

    /** @test */
    public function test_formato_orarin_removes_seconds()
    {
        // Database often gives 08:30:00, we want 08:30
        $result = SeksionHelper::formatoOrarin('08:30:00', '10:00:00');
        $this->assertEquals('08:30 - 10:00', $result);
    }

    /** @test */
    public function test_grupo_por_dita_organizes_data_correctly()
    {
        $data = [
            ['SEK_DITA' => 'Hene', 'emri' => 'Leksion'],
            ['SEK_DITA' => 'Marte', 'emri' => 'Seminar'],
            ['SEK_DITA' => 'Hene', 'emri' => 'Laborator'],
        ];

        $result = SeksionHelper::grupoPorDita($data);

        // Assert that 'Hene' has 2 items and 'Marte' has 1
        $this->assertCount(2, $result['Hene']);
        $this->assertCount(1, $result['Marte']);
        $this->assertEquals('Leksion', $result['Hene'][0]['emri']);
    }

    /** @test */
    public function test_mergo_me_studentet_combines_arrays_correctly()
    {
        $seksionet = [
            ['SEK_ID' => 1, 'emri' => 'Seksioni 1'],
            ['SEK_ID' => 2, 'emri' => 'Seksioni 2']
        ];

        $studentetCount = [
            ['SEK_ID' => 1, 'NR_STUDENTEVE' => 25],
            ['SEK_ID' => 2, 'NR_STUDENTEVE' => 10]
        ];

        $result = SeksionHelper::mergoMeStudentet($seksionet, $studentetCount);

        $this->assertEquals(25, $result[0]['NR_STUDENTEVE']);
        $this->assertEquals(10, $result[1]['NR_STUDENTEVE']);
        
        // Test default value if SEK_ID is missing
        $seksionetMissing = [['SEK_ID' => 99]];
        $resultMissing = SeksionHelper::mergoMeStudentet($seksionetMissing, $studentetCount);
        $this->assertEquals(0, $resultMissing[0]['NR_STUDENTEVE']);
    }
}