<?php

namespace App\MKPonce;

class MKPonce{
    public static function supportsStudentsManagement()
    {
        return Features::supportsStudentsManagement();
    }
    public static function supportsNotesManagement()
    {
        return Features::supportsNotesManagement();
    }
    public static function supportsEmployeesManagement()
    {
        return Features::supportsEmployeesManagement();
    }
    public static function supportsPermissionsManagement()
    {
        return Features::supportsPermissionsManagement();
    }
    public static function supportsRolesManagement()
    {
        return Features::supportsRolesManagement();
    }
    public static function supportsPaymentsManagement()
    {
        return Features::supportsPaymentsManagement();
    }
    public static function supportsMatriculatesManagement()
    {
        return Features::supportsMatriculatesManagement();
    }
    public static function supportsInvoicesManagement()
    {
        return Features::supportsInvoicesManagement();
    }
    public static function supportsGradesManagement()
    {
        return Features::supportsGradesManagement();
    }
    public static function supportsSubjectsManagement()
    {
        return Features::supportsSubjectsManagement();
    }
}
