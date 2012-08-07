<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Sakola Aksesoris module
 *
 * @author PyroCMS Dev Team
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
            // 'roles'     => array('admin_profile_fields')
            // 'sections'  => array(
            //         'users' => array(
            //                 // 'name'  => 'user_list_title',
            //                 'uri'   => 'admin/users',
            //                     'shortcuts' => array(
            //                         'create' => array(
            //                             'name'  => 'user_add_title',
            //                             'uri'   => 'admin/users/create',
            //                             'class' => 'add'
            //                             )
            //                         )
            //                     ),
            //         'fields' => array(
            //                 // 'name'  => 'user_profile_fields_label',
            //                 'uri'   => 'admin/users/fields',
            //                     'shortcuts' => array(
            //                         'create' => array(
            //                             'name'  => 'user_add_field',
            //                             'uri'   => 'admin/users/fields/create',
            //                             'class' => 'add'
            //                             )
            //                         )
            //                     )
            //             )
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