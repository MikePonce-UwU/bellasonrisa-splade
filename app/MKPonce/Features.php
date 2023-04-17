<?php

namespace App\MKPonce;

class Features
{

    public static function enabled(string $feature)
    {
        return in_array($feature, config('mkponce.features', []));
    }
    public static function supportsStudentsManagement()
    {
        return static::enabled(static::studentsManagement());
    }
    public static function supportsNotesManagement()
    {
        return static::enabled(static::notesManagement());
    }
    public static function supportsEmployeesManagement()
    {
        return static::enabled(static::employeesManagement());
    }
    public static function supportsRolesManagement()
    {
        return static::enabled(static::rolesManagement());
    }
    public static function supportsPermissionsManagement()
    {
        return static::enabled(static::permissionsManagement());
    }
    public static function supportsPaymentsManagement()
    {
        return static::enabled(static::paymentsManagement());
    }
    public static function supportsMatriculatesManagement()
    {
        return static::enabled(static::matriculatesManagement());
    }
    public static function supportsInvoicesManagement()
    {
        return static::enabled(static::invoicesManagement());
    }
    public static function supportsGradesManagement()
    {
        return static::enabled(static::gradesManagement());
    }
    public static function supportsSubjectsManagement()
    {
        return static::enabled(static::subjectsManagement());
    }

    public static function studentsManagement(){
        return 'students-management';
    }
    public static function notesManagement(){
        return 'notes-management';
    }
    public static function employeesManagement(){
        return 'employees-management';
    }
    public static function rolesManagement(){
        return 'roles-management';
    }
    public static function permissionsManagement(){
        return 'permissions-management';
    }
    public static function paymentsManagement(){
        return 'payments-management';
    }
    public static function matriculatesManagement(){
        return 'matriculates-management';
    }
    public static function invoicesManagement(){
        return 'invoices-management';
    }
    public static function gradesManagement(){
        return 'grades-management';
    }
    public static function subjectsManagement(){
        return 'subjects-management';
    }
}
