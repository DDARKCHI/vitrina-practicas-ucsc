<?php

return [
    'projects' => [
        [
            'name' => 'SIDEc',
            'category' => 'Datos ambientales',
            'description' => 'Gestiona registros y resultados de bioensayos en un espacio de trabajo para el seguimiento de análisis ambientales.',
            'code' => 'SD',
            'url' => env('PORTAL_SIDEC_URL'),
        ],
        [
            'name' => 'SistemaHorarios',
            'category' => 'Gestión académica',
            'description' => 'Organiza y consulta horarios académicos desde una plataforma centralizada.',
            'code' => 'SH',
            'url' => env('PORTAL_HORARIOS_URL'),
        ],
    ],
];
