<?php

use App\MKPonce\Features;

return [
    /**
     * Features son las características que la aplicación MKSchool soporta, las cuales pueden ser:
     *
     * -> Gestión de estudiantes
     * -> Gestión de notas
     * -> Gestión de empleados, que es lo mismo que usuarios
     * -> Gestión de roles y permisos
     * -> Gestión de planilla, que es, pagos a los empleados
     * -> Gestión de matrículas, que es, nuevo ingreso y matrícula de estudiantes
     * -> Gestión de facturas, que es, ingresar las facturas que ya fueran registradas en papel/físico
     * -> Gestión de...
     */
    'features' => [
        Features::invoicesManagement(),
        Features::matriculatesManagement(),
        Features::notesManagement(),
        Features::paymentsManagement(),
        Features::rolesManagement(),
        // Features::permissionsManagement(),
        Features::productsManagement(),
    ],
];
