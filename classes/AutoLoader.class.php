<?php 

// Load my root class
require_once(__ROOT_DIR . '/classes/MyObject.class.php');

class AutoLoader extends MyObject {
    public function __construct() {
        spl_autoload_register(array($this, 'load'));
    }

// This method will be automatically executed by PHP whenever it encounters
// an unknown class name in the source code

    private function load($className) {
        $className = ucfirst($className);
        $directories = ['classes', 'model', 'controller', 'view', 'model/User'];
        foreach ($directories as $dir)
        {
            if(is_readable(__ROOT_DIR . '/'. $dir .'/'. $className .'.class.php'))
            {
                require_once(__ROOT_DIR . '/'. $dir .'/'. $className .'.class.php');
                break;
            }
        }
    }
}
$__LOADER = new AutoLoader();

//CECI EST UN COMMENTAIRE DE TEST GIT
?>