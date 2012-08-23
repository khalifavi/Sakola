<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('sakola_kalender');

        $this->load->driver('Streams');
    }

    public function index()
    {

        $params = array(
            'stream' => 'events',
            'namespace' => 'sakola',
            'paginate' => 'yes',
            'page_segment' => 4,
            'show_past' => FALSE,
            'date_by' => 'date',
            'order_by' => 'date'
        );

        $this->data->events = $this->streams->entries->get_entries($params);

        $this->template->title($this->module_details['name'])
                ->build('admin/index', $this->data);
    }

    public function _index()
    {
        $extra['title'] = lang('kalender:events');
        $extra['buttons'] = array(
            array(
                'label' => lang('global:edit'),
                'url' => 'admin/sakola_kalender/edit/-entry_id-'
            ),
            array(
                'label' => lang('global:delete'),
                'url' => 'admin/sakola_kalender/delete/-entry_id-',
                'confirm' => true
            )
        );

        $this->streams->cp->entries_table('events', 'sakola', 1, 'admin/sakola_kalender/index', true, $extra);
    }

    public function create()
    {
        $this->template->title(lang('kalender:new'));

        $extra = array(
            'return' => 'admin/sakola_kalender',
            'success_message' => lang('kalender:submit_success'),
            'failure_message' => lang('kalender:submit_failure'),
            'title' => lang('kalender:new')
        );

        $this->streams->cp->entry_form('events', 'sakola', 'new', null, true, $extra);
    }


    public function edit($id = 0)
    {
        $this->template->title(lang('kalender:edit'));

        $extra = array(
            'return' => 'admin/sakola_kalender',
            'success_message' => lang('kalender:submit_success'),
            'failure_message' => lang('kalender:submit_failure'),
            'title' => lang('kalender:edit')
        );

        $this->streams->cp->entry_form('events', 'sakola', 'edit', $id, true, $extra);
    }

    public function delete($id = 0)
    {
        $this->streams->entries->delete_entry($id, 'events', 'sakola');
        $this->session->set_flashdata('error', lang('kalender:deleted'));
        redirect('admin/sakola_kalender/');
    }

}
/* End of file admin.php */
