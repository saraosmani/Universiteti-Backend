<?php

namespace App\Helpers;

class SeksionHelper
{
    public static function renditDitet(): array
    {
        return ['Hene', 'Marte', 'Merkure', 'Enjte', 'Premte', 'Shtune', 'Diele'];
    }

    public static function formatoOrarin(string $oreF, string $oreM): string
    {
        return substr($oreF, 0, 5) . ' - ' . substr($oreM, 0, 5);
    }

    public static function grupoPorDita(array $seksionet): array
    {
        $grouped = [];
        foreach ($seksionet as $seksion) {
            $grouped[$seksion['SEK_DITA']][] = $seksion;
        }
        return $grouped;
    }

    public static function mergoMeStudentet(array $seksionet, array $studentet): array
    {
        $studentetMap = collect($studentet)->keyBy('SEK_ID');
        return array_map(function ($seksion) use ($studentetMap) {
            $seksion['NR_STUDENTEVE'] = $studentetMap->get($seksion['SEK_ID'])['NR_STUDENTEVE'] ?? 0;
            return $seksion;
        }, $seksionet);
    }
}