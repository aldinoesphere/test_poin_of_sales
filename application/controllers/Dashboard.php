<?php


/**
*
*/
class Dashboard extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['laporan_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
        $count_data = [];
        $days_data = [];

        $report_data = $this->laporan_model->get_chart_daily_report($start_date, $end_date);
        $i = 1;
        foreach ($report_data as $rd) {
            $count_data[] = [$i, $rd->total];
            $days_data[] = [$i, $rd->tanggal];
            $i++;
        }

        $data['count_data'] = $count_data;
        $data['days_data'] = $days_data;
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/dashboard/view', $data);
        $this->load->view('v2/dashboard/footer');
    }
}
