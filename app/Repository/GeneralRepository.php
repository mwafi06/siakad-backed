<?php
namespace App\Repository;

use App\Models\ModuleCategoryModel;
use App\Models\ModuleModel;
use App\Models\TeacherModel;

class GeneralRepository
{
    /**
     * load module model
     * @return ModuleModel
     */
    public function module()
    {
        return new ModuleModel();
    }

    /**
     * load teacher model
     * @return TeacherModel
     */
    public function teacher()
    {
        return new TeacherModel();
    }

    /**
     * load module category model
     * @return ModuleCategoryModel
     */
    public function moduleCategory()
    {
        return new ModuleCategoryModel();
    }

    /**
     * get data module
     * @param null $key
     * @param null $value
     * @return mixed
     */
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

    /**
     * get module category data
     * @param null $key
     * @param null $value
     * @return mixed
     */
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
