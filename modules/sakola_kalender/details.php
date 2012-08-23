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
            'shortcuts' => array(
                array(
                   'name' => 'kalender:new',
                   'uri' => 'admin/sakola_kalender/create',
                   'class' => 'add'
                ),
            ),
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
        // We're using the streams API to
        // do data setup.
        $this->load->driver('Streams');

        $this->load->language('sakola_kalender/sakola_kalender');

        // Add sakola_kalender streams
        if ( ! $this->streams->streams->add_stream(lang('kalender:events'), 'events', 'sakola', 'kalender_', null)) return false;

        // Add some fields
        $fields = array(
            array(
                'name' => 'lang:events',
                'slug' => 'event',
                'namespace' => 'sakola',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'events',
                'title_column' => true,
                'required' => true
            ),
            array(
                'name' => 'lang:description',
                'slug' => 'description',
                'namespace' => 'sakola',
                'type' => 'textarea',
                'assign' => 'events',
                'required' => false
            ),
            array(
                'name' => 'lang:date',
                'slug' => 'date',
                'namespace' => 'sakola',
                'type' => 'datetime',
                'extra' => array(
                    'start_date' => '-1D',
                    // 'end_date' => '-1D +1Y',
                    'input_type' => 'datepicker',
                    'use_time' => 'yes',
                    'storage' => 'unix',
                    ),
                'assign' => 'events',
                'required' => true
            )
        );

        $this->streams->fields->add_fields($fields);

        return true;
    }

    public function uninstall()
    {
        $this->load->driver('Streams');

        if($this->streams->streams->delete_stream('events', 'sakola'))
        {
            // delete the fields
            $this->streams->fields->delete_field('event', 'sakola');
            $this->streams->fields->delete_field('description', 'sakola');
            $this->streams->fields->delete_field('date', 'sakola');
        }

        return true;
    }

    public function upgrade($old_version)
    {
        return true;
    }

}