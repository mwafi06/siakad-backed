<?php
namespace App\Repository;

use App\Models\ModuleCategoryModel;
use App\Models\ModuleModel;
use App\Models\TeacherModel;

class GeneralRepository
{
    public function module()
    {
        return new ModuleModel();
    }

    public function teacher()
    {
        return new TeacherModel();
    }

    public function moduleCategory()
    {
        return new ModuleCategoryModel();
    }

    public function getModule($key = null,$value = null)
    {
        $query = $this->module();

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

    public function getModuleCategory($key = null,$value = null)
    {
        $query = $this->moduleCategory();

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
}
