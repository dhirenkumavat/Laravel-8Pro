<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';

class Dashboard extends BaseController {

	 /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagination','session');
        $this->load->model('project_model');
        $this->load->model('referral_model');
        $this->load->model('site_model','site');
        $this->isLoggedIn();
        $access = array();
        if($_SESSION['role'] == 1)
            $_SESSION['roleAccess'] = array(1,2,3,4,8);
        if($_SESSION['role'] == 2)
            $_SESSION['roleAccess'] = array(2,3,4);
        if($_SESSION['role'] == 3)
            $_SESSION['roleAccess'] = array(3,4);
        if($_SESSION['role'] == 4)
            $_SESSION['roleAccess'] = array(4);
        if($_SESSION['role'] == 8)
            $_SESSION['roleAccess'] = array(3,4,8);

    if($_SESSION['role'] == 1)
            $_SESSION['roleAccessStr'] = '(1,2,3,4,5,6)';
        if($_SESSION['role'] == 2)
            $_SESSION['roleAccessStr'] = '(2,3,4)';
        if($_SESSION['role'] == 3)
            $_SESSION['roleAccessStr'] = '(3,4)';
        if($_SESSION['role'] == 4)
            $_SESSION['roleAccessStr'] = '(4)';
        if($_SESSION['role'] == 8)
            $_SESSION['roleAccessStr'] = '(3,4,8)';
    }
	public function index()
	{
       // die('fff');
		$this->global['pageTitle'] = 'Amplify : Dashboard';
        $this->global['PageEdit'] = "Dashboard";
        $data = array();
        $data['stages'] = $this->project_model->getStages();
        foreach ($data['stages'] as  $value) {
            $stageCount = $this->project_model->getStageCount($value->stageId);
            $totalstageCount[$value->stageId] = isset($stageCount['stage_count'])?$stageCount['stage_count']:0;
        }
        $data['totalstageCount'] = $totalstageCount;

        $data['pendingTaskToday'] = $this->project_model->getpendingTaskToday();
        $data['pendingTaskWeek'] = $this->project_model->getpendingTaskWeek();
        $data['pendingTaskMonth'] = $this->project_model->getpendingTaskMonth();
        $data['pendingTaskYear'] = $this->project_model->getpendingTaskYear();

        $data['completedTaskToday'] = $this->project_model->getcompletedTaskToday();
        $data['completedTaskWeek'] = $this->project_model->getcompletedTaskWeek();
        $data['completedTaskMonth'] = $this->project_model->getcompletedTaskMonth();
        $data['completedTaskYear'] = $this->project_model->getcompletedTaskYear();

        $data['userCount'] = $this->project_model->getUserCount();
        $data['projectCount'] = $this->project_model->getProjectCount();
        $data['monthCount'] = $this->project_model->getProjectCountMonth();
        $data['yearCount'] = $this->project_model->getProjectCountYear();

        $data['tagsData'] = $this->project_model->gettagData();
        $data['filesData'] = $this->project_model->getfileData();
        $data['fileType'] = $this->project_model->getfiletypeData();
        $data['fileSize'] = $this->project_model->getfileSize();


        $data['leadFileToday'] = $this->project_model->getnewfile();

        $data['newfileToday'] = $data['leadFileToday']['new_file'];
        $data['fileweekCount'] = $this->project_model->getfileweekCount();
        $data['filemonthCount'] = $this->project_model->getfilemonthCount();
        $data['fileyearCount'] = $this->project_model->getfileyearCount();

        $data['phoneDataToday'] = $this->project_model->getphoneDataToday();
        $data['phoneDataWeekly'] = $this->project_model->getphoneDataWeekly();
        $data['phoneMonthlyCount'] = $this->project_model->getphoneMonthlyCount();
        $data['phoneyearlyCount'] = $this->project_model->getphoneyearlyCount();
        $data['phoneData'] = $this->project_model->getphoneData();
        $data['phoneDataMonthly'] = $this->project_model->getphoneDataMonthly();

        $data['emailDataToday'] = $this->project_model->getemailDataToday();
        $data['emailDataWeekly'] = $this->project_model->getemailDataWeekly();
        $data['emailMonthlyCount'] = $this->project_model->getemailMonthlyCount();
        $data['emailyearlyCount'] = $this->project_model->getemailYearlyCount();
        $data['emailData'] = $this->project_model->getemailData();
        $data['emailDataMonthly'] = $this->project_model->getemailDataMonthly();

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $data['lastDay'] = $lastDay = $date->format('d');
        if(!($this->input->post('startdate') != '')){
            $data['startdate'] = $startdate = date('m/01/Y');
            $date = new DateTime('now');
            $date->modify('last day of this month');
            $data['lastDay'] = $lastDay = $date->format('d');
            $data['enddate'] = $enddate = date('m/31/Y');
        }
        else {
            $data['startdate'] = $startdate = $this->input->post('startdate');
            $data['enddate'] = $enddate = $this->input->post('enddate');
        }

            // chart data
            $data['Monthly'] = 'Daily';
            $parts = explode('/',$startdate);
            $data['startdatechart'] = $startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $parts = explode('/',$enddate);
            $data['enddatechart'] = $enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $data['graphProjectPriceQuantity'] = $this->project_model->graphProjectPriceQuantityDaily($startdate,$enddate);
            $data['graphEstimatorPriceQuantity'] = $this->project_model->graphEstimatorPriceQuantityDaily($startdate,$enddate);

            $data['graphPendingPriceQuantity'] = $this->project_model->graphPendingPriceQuantityDaily($startdate,$enddate);
            $data['graphPendingBudgetPriceQuantity'] = $this->project_model->graphPendingBudgetsPriceQuantityDaily($startdate,$enddate);
            $data['graph90EstimatorPriceQuantity'] = $this->project_model->graph90EstimatorPriceQuantityDaily($startdate,$enddate);
            $data['graphProjectsbyScopePriceQuantity'] = $this->project_model->graphProjectsbyScopePriceQuantityDaily($startdate,$enddate);
            $data['graphProjectsWonbyScopePriceQuantity'] = $this->project_model->graphProjectsWonbyScopePriceQuantityDaily($startdate,$enddate);
            $data['graphProjectsLostbyScopePriceQuantity'] = $this->project_model->graphProjectsLostbyScopePriceQuantityDaily($startdate,$enddate);
            $data['graphSalesWonbyScopePriceQuantity'] = $this->project_model->graphSalesWonbyScopePriceQuantityDaily($startdate,$enddate);
            $data['graphSalesWonbyScopePriceQuantity'] = $this->project_model->graphSalesWonbyScopePriceQuantityDaily($startdate,$enddate);
            $data['graphEstimatorWonbyScopePriceQuantity'] = $this->project_model->graphEstimatorWonbyScopePriceQuantityDaily($startdate,$enddate);
            $data['graphCompanyPriceQuantity'] = $this->project_model->graphCompanyPriceQuantityDaily($startdate,$enddate);
            $data['totalwon'] = $this->project_model->graphTotalWonSalesQuantityDaily($startdate,$enddate);
            $data['total90won'] = $this->project_model->graphTotal90WonSalesQuantityDaily($startdate,$enddate);

        $this->loadViews('dashbord', $this->global, $data, null);
	}

    public function download($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');

            //get file info from database
            $fileInfo = $this->project_model->getfilesData($id);
            //file path
            //$targetDir =  base_url()."assets/uploads/files/";
            $file =  FCPATH. 'assets/uploads/files/'.$fileInfo['name'];
            //download file from directory

            $data = file_get_contents($file);
            force_download($fileInfo['name'], $data);
            //force_download($fileInfo['name'],$file);
            redirect('dashboard');
        }
    }

    function getWonProjects(){
        $salesId    = $this->input->post('salesId');
        $startdate  = $this->input->post('startdate');
        $enddate    = $this->input->post('enddate');
        $parts = explode('/',$startdate);
        $startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $parts = explode('/',$enddate);
        $enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $graphSalesWonbyProjectArray = $this->project_model->graphSalesWonbyProject($salesId,$startdate,$enddate);
        $html = "";
        $html.= "<table class='table table-striped table-bordered first dataTable no-footer'><tr><th>ID</th><th>Project Name</th><th>Price</th></tr>";
        foreach ($graphSalesWonbyProjectArray as $key => $value) {
            $html.= "<tr><td>".$value['projectId']."</td><td>".$value['projectName']."</td><td>".$value['bid_price']."</td></tr>";
        }
        $html.="</table>";
        echo json_encode(array('status'=>true,'html'=>$html));
    }


    function getSalesWonByIndividualDetails(){
        $startdate  = $this->input->post('startdate');
        $enddate    = $this->input->post('enddate');
        $parts = explode('/',$startdate);
        $startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $parts = explode('/',$enddate);
        $enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $graphSalesWonbyProjectArray = $this->project_model->graphSalesWonbyProject($startdate,$enddate);
        $graphSalesArray = array();
        foreach($graphSalesWonbyProjectArray as $graphSalesWonbyProject){
            $graphSalesArray[$graphSalesWonbyProject['name']][] = $graphSalesWonbyProject;
        }

        $html = "";

        $i=1;
        setlocale(LC_MONETARY, 'en_US');
        foreach ($graphSalesArray as $key => $value) {
            $html.= "<p><a href='javascript:void(0)' onclick='showSalesTable(".$i.");'>".$key."</a></p>";
            $html.= "<table style='display:none' id='SalesProjectDetails_".$i."' class='table table-striped table-bordered first dataTable no-footer SalesProjectDetails'><tr><th>Project ID</th><th>Project Name</th><th>Price</th></tr>";
            foreach ($value as $k=>$val) {

                $bidprice = money_format('%.0n', str_replace( '$', '',str_replace( ',', '',(double)$val['bid_price']))) ;
                $html.= "<tr><td>".$val['projectId']."</td><td>".$val['projectName']."</td><td>".$bidprice."</td></tr>";
            }
            $html.="</table>";
            $i++;
        }

        echo json_encode(array('status'=>true,'html'=>$html));
    }

    function getEstimatorWonByIndividualDetails(){
        $startdate  = $this->input->post('startdate');
        $enddate    = $this->input->post('enddate');
        $parts = explode('/',$startdate);
        $startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $parts = explode('/',$enddate);
        $enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $graphEstimatorWonbyProjectArray = $this->project_model->graphEstimatorWonbyProject($startdate,$enddate);
        $graphEstimatorArray = array();
        foreach($graphEstimatorWonbyProjectArray as $graphEstimatorWonbyProject){
            $graphEstimatorArray[$graphEstimatorWonbyProject['name']][] = $graphEstimatorWonbyProject;
        }

        $html = "";
        setlocale(LC_MONETARY, 'en_US');
        $i=1;
        foreach ($graphEstimatorArray as $key => $value) {
            $html.= "<p><a href='javascript:void(0)' onclick='showEstimatorTable(".$i.");'>".$key."</a></p>";
            $html.= "<table style='display:none' id='EstimatorProjectDetails_".$i."' class='table table-striped table-bordered first dataTable no-footer EstimatorProjectDetails'><tr><th>Project ID</th><th>Project Name</th><th>Price</th></tr>";
            foreach ($value as $k=>$val) {
                $bidprice = money_format('%.0n', str_replace( '$', '',str_replace( ',', '',(double)$val['bid_price']))) ;
                $html.= "<tr><td>".$val['projectId']."</td><td>".$val['projectName']."</td><td>".$bidprice."</td></tr>";
            }
            $html.="</table>";
            $i++;
        }

        echo json_encode(array('status'=>true,'html'=>$html));
    }
}
