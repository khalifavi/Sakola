<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Sakola Aksesoris module
 *
 * @author Isolaa
 * @package Sakola\Modules\Aksesoris
 */
class Module_Sakola_aksesoris extends Module {

    public $version = '0.1';

    public function info()
    {
        $info = array(
            'name' => array(
                'en' => 'Sakola Accessories',
                'id' => 'Sakola Aksesoris',
            ),
            'description' => array(
                'en' => 'Enables additional features in Sakola Module set',
                'id' => 'Memungkinkan fitur tambahan di Modul Sakola',
            ),
            'frontend'  => false,
            'backend'   => true,
            'menu'      => 'Sakola',
            );

        return $info;
    }

    /**
     * Installation logic
     *
     * This is handled by the installer only so that a default user can be created.
     *
     * @return boolean
     */
    public function install()
    {
        

        return true;
    }

    public function uninstall()
    {
        // This is a core module, lets keep it around.
        return false;
    }

    public function upgrade($old_version)
    {
        return true;
    }

}