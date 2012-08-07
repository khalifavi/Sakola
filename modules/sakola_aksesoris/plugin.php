<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Sakola Aksesoris module
 *
 * @author Isolaa
 * @package Sakola\Modules\Aksesoris
 */
class Plugin_Sakola_aksesoris extends Plugin {

    static $id_counter = 0;

    public function gmap()
    {
        $id         = $this->attribute('id', $id_counter++);
        $width      = $this->attribute('width');
        $height     = $this->attribute('height');
        $longitude  = $this->attribute('longitude');
        $latitude   = $this->attribute('latitude');
        $marker     = $this->attribute('marker', FALSE);
        $static     = $this->attribute('static', FALSE);

        // TODO: script generator goes here
    }

}