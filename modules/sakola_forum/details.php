<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Sakola Forum module
 *
 * @author Isolaa
 * @package Sakola\Modules\Forum
 */
class Module_Sakola_forum extends Module {

    public $version = '0.1';

    public function info()
    {
        $info = array(
            'name' => array(
                'en' => 'Sakola Forum',
                'id' => 'Sakola Forum',
            ),
            'description' => array(
                'en' => 'Enables sakola forum',
                'id' => 'Memungkinkan fitur forum',
            ),
            'frontend'  => true,
            'backend'   => true,
            'menu'      => 'Sakola',
            'roles' => array(
                'manage_forums', 'delete_forums', 'manage_posts'
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
        $this->load->dbforge();
        
        $fields_forums = array(
                'id'            => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                                     'auto_increment' => TRUE
                              ),
                'name'          => array(
                                     'type' => 'VARCHAR',
                                     'constraint' => '150',
                              ),
                'description'   => array(
                                     'type' =>'TEXT',
                                     'null' => TRUE,
                              ),
                'order'         => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'topics_count'  => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'posts_count'   => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
            );

        $fields_topics = array(
                'id'            => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                                     'auto_increment' => TRUE
                              ),
                'title'         => array(
                                     'type' => 'VARCHAR',
                                     'constraint' => '255',
                              ),
                'time'          => array(
                                     'type' =>'DATETIME',
                              ),
                'views'         => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'forum_id'      => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'status'        => array(
                                     'type' => 'INT',
                                     'constraint' => 1,
                                     'unsigned' => TRUE,
                              ),
                'posts_count'   => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'last_post_id'  => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'last_post_time' => array(
                                     'type' => 'DATETIME',
                              ),
                'last_post_poster_name' => array(
                                     'type' => 'VARCHAR',
                                     'constraint' => 255,
                              ),
            );

        $fields_posts = array(
                'id'            => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                                     'auto_increment' => TRUE
                              ),
                'forum_id'      => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'topic_id'      => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'poster_id'     => array(
                                     'type' => 'INT',
                                     'constraint' => 11,
                                     'unsigned' => TRUE,
                              ),
                'poster_name'   => array(
                                     'type' => 'VARCHAR',
                                     'constraint' => 255,
                              ),
                'body'          => array(
                                     'type' =>'TEXT',
                                     'null' => TRUE,
                              ),
                'parsed'        => array(
                                     'type' =>'TEXT',
                                     'null' => TRUE,
                              ),
                'type'          => array(
                                     'type' => "SET( 'html', 'markdown', 'wysiwyg-advanced', 'wysiwyg-simple' )",
                              ),
                'time'          => array(
                                     'type' => 'DATETIME',
                              ),
                'poster_ip'     => array(
                                     'type' => 'VARCHAR',
                                     'constraint' => 15,
                              ),
                'status'        => array(
                                     'type' => 'INT',
                                     'constraint' => 1,
                                     'unsigned' => TRUE,
                              ),
            );
        
        $this->dbforge->add_field($fields_forums);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sakola_forums', TRUE);

        $this->dbforge->add_field($fields_topics);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sakola_topics', TRUE);

        $this->dbforge->add_field($fields_posts);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sakola_posts', TRUE);


        return true;
    }

    public function uninstall()
    {
        $this->load->dbforge();

        $this->dbforge->drop_table('sakola_posts');
        $this->dbforge->drop_table('sakola_topics');
        $this->dbforge->drop_table('sakola_forums');

        // This is a core module, lets keep it around.
        return true;
    }

    public function upgrade($old_version)
    {
        return true;
    }

}