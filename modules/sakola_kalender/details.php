<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Sakola Forum module
 *
 * @author Isolaa
 * @package Sakola\Modules\Kalender
 */
class Module_Sakola_kalender extends Module {

    public $version = '0.1';

    public function info()
    {
        $info = array(
            'name' => array(
                'en' => 'Sakola Calendar',
                'id' => 'Sakola Kalender',
            ),
            'description' => array(
                'en' => 'Enables sakola calendar (events calendar)',
                'id' => 'Memungkinkan fitur kalender (kalender kegiatan)',
            ),
            'frontend'  => true,
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