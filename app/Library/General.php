<?php
namespace App\Library;

use Carbon\Carbon;

class General
{
    public $date;

    public $dateTime;

    public $themes;

    public function __construct()
    {
        $datetime = Carbon::now('Asia/Jakarta');
        $this->dateTime = $datetime->format('Y-m-d H:i:s');
        $this->date = $datetime->format('Y-m-d');
        $this->themes = 'layout.master';
    }

    public function viewData()
    {
        /*
         * define variable
         */
        $self = new self();

        /*
         * init view data
         */
        $viewData = array(
            'title' => 'Siakad',
            'general' => $self,
            'user' => $this->activeUser(),
        );

        return $viewData;
    }

    /*
     * get active user
     */
    public function activeUser()
    {
        if (session()->has('user') && session()->get('user') == true)
        {
            return session()->get('user');
        }
        else
        {
            return false;
        }
    }

    /*
     * Encryption Section
     */
    public function encrypt($str,$keyDefault = true)
    {
        if (!$keyDefault)
        {
            Aes::setKey(env('ENCRYPT_KEY'));
        }

        return Aes::enkrip($str);
    }

    public function decrypt($str,$keyDefault = true)
    {
        if (!$keyDefault)
        {
            Aes::setKey(env('ENCRYPT_KEY'));
        }

        return Aes::dekrip($str);
    }

    /*
     * flash message section
     */
    public function flashMessage()
    {
        $msg = NULL;

        if (session()->has('msgSuccess'))
        {
            $msg = "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".session('msgSuccess')."</div>";
        }
        if (session()->has('msgError'))
        {
            $msg = "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".session('msgError')."</div>";
        }
        if (session()->has('msgInfo'))
        {
            $msg = "<div class=\"alert alert-primary alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".session('msgInfo')."</div>";
        }
        if (session()->has('msgWarning'))
        {
            $msg = "<div class=\"alert alert-warning alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".session('msgWarning')."</div>";
        }

        return $msg;
    }

    /*
     * end flash message section
     */

    /*
     * Random String Section
     */
    private function assignRandValue($num) {

        // accepts 1 - 36
        switch($num) {
            case "1" : $rand_value = "a"; break;
            case "2" : $rand_value = "b"; break;
            case "3" : $rand_value = "c"; break;
            case "4" : $rand_value = "d"; break;
            case "5" : $rand_value = "e"; break;
            case "6" : $rand_value = "f"; break;
            case "7" : $rand_value = "g"; break;
            case "8" : $rand_value = "h"; break;
            case "9" : $rand_value = "i"; break;
            case "10" : $rand_value = "j"; break;
            case "11" : $rand_value = "k"; break;
            case "12" : $rand_value = "l"; break;
            case "13" : $rand_value = "m"; break;
            case "14" : $rand_value = "n"; break;
            case "15" : $rand_value = "o"; break;
            case "16" : $rand_value = "p"; break;
            case "17" : $rand_value = "q"; break;
            case "18" : $rand_value = "r"; break;
            case "19" : $rand_value = "s"; break;
            case "20" : $rand_value = "t"; break;
            case "21" : $rand_value = "u"; break;
            case "22" : $rand_value = "v"; break;
            case "23" : $rand_value = "w"; break;
            case "24" : $rand_value = "x"; break;
            case "25" : $rand_value = "y"; break;
            case "26" : $rand_value = "z"; break;
            case "27" : $rand_value = "A"; break;
            case "28" : $rand_value = "B"; break;
            case "29" : $rand_value = "C"; break;
            case "30" : $rand_value = "D"; break;
            case "31" : $rand_value = "E"; break;
            case "32" : $rand_value = "F"; break;
            case "33" : $rand_value = "G"; break;
            case "34" : $rand_value = "H"; break;
            case "35" : $rand_value = "I"; break;
            case "36" : $rand_value = "J"; break;
            case "37" : $rand_value = "K"; break;
            case "38" : $rand_value = "L"; break;
            case "39" : $rand_value = "M"; break;
            case "40" : $rand_value = "N"; break;
            case "41" : $rand_value = "O"; break;
            case "42" : $rand_value = "P"; break;
            case "43" : $rand_value = "Q"; break;
            case "44" : $rand_value = "R"; break;
            case "45" : $rand_value = "S"; break;
            case "46" : $rand_value = "T"; break;
            case "47" : $rand_value = "U"; break;
            case "48" : $rand_value = "V"; break;
            case "49" : $rand_value = "W"; break;
            case "50" : $rand_value = "X"; break;
            case "51" : $rand_value = "Y"; break;
            case "52" : $rand_value = "Z"; break;
            case "53" : $rand_value = "0"; break;
            case "54" : $rand_value = "1"; break;
            case "55" : $rand_value = "2"; break;
            case "56" : $rand_value = "3"; break;
            case "57" : $rand_value = "4"; break;
            case "58" : $rand_value = "5"; break;
            case "59" : $rand_value = "6"; break;
            case "60" : $rand_value = "7"; break;
            case "61" : $rand_value = "8"; break;
            case "62" : $rand_value = "9"; break;
        }
        return $rand_value;
    }

    private function getRandAlphaNumeric($length) {
        $rand_id = false;
        if ($length>0) {
            $rand_id="";
            for ($i=1; $i<=$length; $i++) {
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,62);
                $rand_id .= $this->assignRandValue($num);
            }
        }
        return $rand_id;
    }

    private function getRandNumeric($length) {
        $rand_id = false;
        if ($length>0) {
            $rand_id="";
            for($i=1; $i<=$length; $i++) {
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(53,62);
                $rand_id .= $this->assignRandValue($num);
            }
        }
        return $rand_id;
    }

    private function getRandNoZero($length) {
        $rand_id = false;
        if ($length>0) {
            $rand_id="";
            for($i=1; $i<=$length; $i++) {
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(54,62);
                $rand_id .= $this->assignRandValue($num);
            }
        }
        return $rand_id;
    }

    private function getRandAlpha($length) {
        $rand_id = false;
        if ($length>0) {
            $rand_id="";
            for($i=1; $i<=$length; $i++) {
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,52);
                $rand_id .= $this->assignRandValue($num);
            }
        }
        return $rand_id;
    }

    public function random_string($type = 'alnum',$length = 8)
    {
        $random = '';

        switch ($type)
        {
            case 'alpha':
                $random = $this->getRandAlpha($length);
                break;
            case 'alnum':
                $random = $this->getRandAlphaNumeric($length);
                break;
            case 'numeric':
                $random = $this->getRandNumeric($length);
                break;
            case 'nozero':
                $random = $this->getRandNoZero($length);
                break;
        }

        return $random;
    }
    /*
     * End Random String Section
     */

    /*
     * generate sidebar
     */
    public function getModule($category = 'all',$object = true){

        $module = session()->has('module') ? session()->get('module') : generalRepository()->getModule()->sortBy('mod_order');
        $module = $category == 'all' ?  $module->toArray() : $module->where('module_category_id',$category)->toArray();
        $data   = array();

        foreach ($module as $value){
            $value = (object)$value;

            if ($value->parent_id == 0){
                $data[$value->modid] = $value;
                $data[$value->modid]->{'detail'} = array();
            }else{
                $data[$value->parent_id]->detail[] = $value;
            }
        }

        if ($object)
        {
            return json_decode(json_encode($data));
        }
        else
        {
            return $data;
        }
    }

    public function findPermalink($needle, $array){
        foreach ($array as $key => $val) {
            if ($val->permalink == $needle) {
                return true;
            }
        }
        return false;
    }

    public function findModAlias($needle, $array){
        foreach ($array as $key => $val) {
            if ($val->mod_alias == $needle) {
                return true;
            }
        }
        return false;
    }

    public function roleMod($role = 'read')
    {
        /*
         * define variable
         */
        $user = $this->activeUser();
        $module = session()->has('module') ? session()->get('module') : generalRepository()->getModule();
        $roles = session()->has('role') ? session()->get('role') : employeeRepository()->getEmployeeGroup('uid',$user->uid)->first() ;
        $roleMod = array();

        switch($role)
        {
            case 'create':
                $role = explode(',', $roles->create);
                break;
            case 'update':
                $role = explode(',', $roles->update);
                break;
            case 'delete':
                $role = explode(',', $roles->delete);
                break;
            default:
                $role = explode(',', $roles->read);
        }

        $getMod = $module->whereIn('modid',$role);

        foreach($getMod->all() as $val)
        {
            $roleMod[$val->modid] =$val->mod_alias;
        }

        return $roleMod;
    }

    public function modAccess($alias = '', $role = 'read')
    {
        $access = FALSE;
        $roleMod = $this->roleMod($role);

        if(is_array($roleMod) && in_array($alias, $roleMod))
        {
            $access = TRUE;
        }

        return $access;
    }

    public function generateSidebar($modAlias = null)
    {
        /*
         * define variable
         */
        $currentUrl = '/'.preg_replace("/^\//","",\Request::path());
        $category   = generalRepository()->getModuleCategory()->sortBy('order');
        $template   = NULL;
        $parent = $child = $sidebar = '';

        $sidebar .= "<ul class=\"nav nav-pills nav-sidebar flex-column  text-sm nav-legacy nav-flat nav-compact\" data-widget=\"treeview\" role=\"menu\" data-accordion=\"false\">";

        foreach ($category as $cat)
        {
            /*
             * get category
             */
            $data       = $this->getModule($cat->id,false);

            $sidebar .= "<li class=\"nav-header\">".strtoupper($cat->name)."</li>";

            foreach ($data as $item) {
                if (count($item->detail) > 0) {
                    $active = $this->findPermalink($currentUrl,$item->detail);
                    $activeSecond = $this->findModAlias($modAlias,$item->detail);
                    $active = $active == true || $activeSecond == true ? 'active' : '';
                    $active_parent = $active == true || $activeSecond == true ? 'menu-open' : '';
                    $modAccess = false;

                    foreach ($item->detail as $child_item)
                    {
                        $checkModAccess = $this->modAccess($child_item->mod_alias);

                        if ($checkModAccess)
                        {
                            $modAccess = true;
                        }
                    }

                    $parent = "<li class=\"nav-item has-treeview $active_parent\"><a href=\"#\" class=\"nav-link $active\"><i class=\"nav-icon $item->mod_icon\"></i><p>".ucfirst($item->mod_name)."<i class=\"right fas fa-angle-left\"></i></p></a>\n";

                    if ($modAccess)
                    {
                        /*
                         * generate child
                         */
                        $child = "<ul class=\"nav nav-treeview\">";
                        foreach ($item->detail as $child_item) {
                            if ($this->modAccess($child_item->mod_alias)) {
                                $active = $currentUrl == $child_item->permalink || $modAlias == $child_item->mod_alias ? 'active' : '';
                                $child .= "<li class=\"nav-item\"><a href=\"$child_item->permalink\" class=\"nav-link $active\"><i class=\"far fa-circle nav-icon\"></i><p>" . ucfirst($child_item->mod_name) . "</p></a></li>\n";
                            }
                        }
                        $child .= "</ul>\n";

                        $parent .= $child;
                        $parent .= "</li>";
                    }

                }
                else {
                    if ($this->modAccess($item->mod_alias)) {
                        $active = $currentUrl == $item->permalink || $modAlias == $item->mod_alias ? 'active' : (strpos($currentUrl, $item->permalink) === 0 && $item->permalink != '/' ? 'active' : '');
                        $parent = "<li class=\"nav-item\"><a href=\"$item->permalink\" class=\"nav-link $active\"><i class=\"nav-icon $item->mod_icon\"></i><p>" . ucfirst($item->mod_name) . "</p></a></li>\n";
                    }
                }
            }

            $sidebar .= $parent;
        }

        $sidebar .= "</ul>";

        return $sidebar;
    }

    /*
     * end generate sidebar
     */
}
