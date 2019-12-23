<?php
namespace App\Repository;

use App\Models\EmployeeGroupModel;
use App\Models\EmployeeModel;

class EmployeeRepository
{

    public function employee()
    {
        return new EmployeeModel();
    }

    public function employeeGroup()
    {
        return new EmployeeGroupModel();
    }

    public function findEmployeeLogin($username)
    {
        $query = $this->employee()
            ->where('username',$username)
            ->orWhere('nip',$username)
            ->first();

        if (!$query)
        {
            return false;
        }
        else
        {
            return $query;
        }
    }

    public function getEmployee($key = null,$value = null)
    {

        $query = $this->employee();

        if (is_array($key))
        {
            $query->where($key);
        }
        elseif(!is_null($key) && !is_null($value))
        {
            $query->where($key,$value);
        }

        return $query->get();
    }

    public function getEmployeeGroup($key = null,$value = null)
    {

        $query = $this->employeeGroup();

        if (is_array($key))
        {
            $query->where($key);
        }
        elseif(!is_null($key) && !is_null($value))
        {
            $query->where($key,$value);
        }

        return $query->get();
    }

    function updateEmployeeRememberToken($uid,$token)
    {
        return $this->employee()
            ->where('uid',$uid)
            ->update(array('remember_token'=>$token));
    }

    public function getDropdownEmployeeGroup()
    {
        /*
         * define variable
         */
        $return[''] = '-- Select Employee Group --';
        $employeeGroup = $this->getEmployeeGroup();

        if ($employeeGroup->isNotEmpty())
        {
            foreach ($employeeGroup as $val){
                $return[$val->guid] = $val->name;
            }
        }

        return $return;
    }
}
