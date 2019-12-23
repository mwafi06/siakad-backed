<?php
if  ( ! function_exists('employeeRepository'))
{
    function employeeRepository()
    {
        return new \App\Repository\EmployeeRepository();
    }
}

if  ( ! function_exists('generalRepository'))
{
    function generalRepository()
    {
        return new \App\Repository\GeneralRepository();
    }
}
