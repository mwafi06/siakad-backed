<?php
namespace App\Repository;

use App\Models\EmployeeGroupModel;
use App\Models\EmployeeModel;

class EmployeeRepository
{

    /**
     * load employee model
     * @return EmployeeModel
     */
    public function employee()
    {
        return new EmployeeModel();
    }

    /**
     * load employee group model
     * @return EmployeeGroupModel
     */
    public function employeeGroup()
    {
        return new EmployeeGroupModel();
    }

    /**
     * find employee data for login
     * @param $username
     * @return bool
     */
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

    /**
     * get employee data
     * @param null $key
     * @param null $value
     * @return mixed
     */
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

    /**
     * get employee group data
     * @param null $key
     * @param null $value
     * @return mixed
     */
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

    /**
     * update employee remember token data
     * @param $uid
     * @param $token
     * @return mixed
     */
    function updateEmployeeRememberToken($uid,$token)
    {
        return $this->employee()
            ->where('uid',$uid)
            ->update(array('remember_token'=>$token));
    }

    /**
     * get dropdown employee group data
     * @return mixed
     */
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
