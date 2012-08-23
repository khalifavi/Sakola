<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sakola_kalender extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('sakola_kalender');

        $this->load->driver('Streams');
    }

    public function index($year=FALSE, $month=FALSE)
    {
        $prefs = array (
           'show_next_prev' => TRUE,
           'next_prev_url'  => site_url('sakola_kalender/index/'),
           'day_type'       => 'long',
         );
        $prefs['template'] = '
           {table_open}<table class="kalender table-bordered">{/table_open}

           {heading_row_start}<tr class="kalender-heading">{/heading_row_start}

           {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
           {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
           {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

           {heading_row_end}</tr>{/heading_row_end}

           {week_row_start}<tr class="kalender-weeks">{/week_row_start}
           {week_day_cell}<td>{week_day}</td>{/week_day_cell}
           {week_row_end}</tr>{/week_row_end}

           {cal_row_start}<tr class="kalender-days">{/cal_row_start}
           {cal_cell_start}<td>{/cal_cell_start}

           {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
           {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

           {cal_cell_no_content}{day}{/cal_cell_no_content}
           {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

           {cal_cell_blank}&nbsp;{/cal_cell_blank}

           {cal_cell_end}</td>{/cal_cell_end}
           {cal_row_end}</tr>{/cal_row_end}

           {table_close}</table>{/table_close}
        ';
        $this->load->library('calendar', $prefs);

        $params = array(
            'stream' => 'events',
            'namespace' => 'sakola',
            'date_by' => 'date',
            'order_by' => 'date',
        );

        $params['year'] = ($year) ? $year : date('Y');
        $params['month'] = ($month) ? $month : date('m');

        if($year && !$month)
        {
            // set month to this month if this year, else set to january
            $params['month'] = ($year == date('Y')) ? date('m') : 1;
        }

        $this->data->events = $this->streams->entries->get_entries($params);

        $days = array();
        $temp = 0;

        foreach($this->data->events['entries'] as $event):
            $temp = date_format(new DateTime('@'.$event['date']), 'd');
            $days[$temp] = site_url("sakola_kalender/events/${params['year']}/${params['month']}/$temp");
        endforeach;

        unset($temp);

        $this->data->calendar = $this->calendar->generate($year, $month, $days);

        $this->template
            ->title($this->module_details['name'])
            // ->append_js('module::index.js')
            ->append_css('module::sakola_kalender.css')
            ->build('index', $this->data);
    }

    public function events($year=FALSE, $month=FALSE, $day=FALSE)
    {
        $params = array(
            'stream' => 'events',
            'namespace' => 'sakola',
            'date_by' => 'date',
            'order_by' => 'date'
        );

        $params['year'] = ($year) ? $year : date('Y');
        $params['month'] = ($month) ? $month : date('m');
        $params['day'] = ($day) ? $day : date('d');
        
        if($year && !$month)
        {
            // remove month
            unset($params['month']);
            unset($params['day']);
        }
        if($month && !$day)
        {
            unset($params['day']);
        }

        $this->data->events = $this->streams->entries->get_entries($params);

        $this->template
            ->title($this->module_details['name'])
            // ->append_js('module::index.js')
            ->append_css('module::sakola_kalender.css')
            ->build('events', $this->data);
    }

}
/* End of file sakola_kalender.php */
