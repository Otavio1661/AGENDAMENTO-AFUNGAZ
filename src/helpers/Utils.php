<?php

namespace src\helpers;

use core\Controller;
use Exception;
use src\Config;


class Utils extends Controller
{
    public static function formatarDataBrasileira(string $data): string
    {
        // Tenta criar o objeto DateTime com base na string
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $data)
            ?: \DateTime::createFromFormat('Y-m-d', $data);

        // Se não for uma data válida, retorna como veio
        if (!$dateTime) {
            return $data;
        }

        // Retorna com hora se tiver
        return strpos($data, ' ') !== false
            ? $dateTime->format('d/m/Y H:i:s')
            : $dateTime->format('d/m/Y');
    }
}
