<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pvcrequests extends CI_Controller {
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    private $Table = 'tbl_pvcprint_details';
    private $sortBy = 'time';
    private $sortType = 'asc';
    private $sortBySession = 'pvcpayment_orderBy';
    private $sortTypeSession = 'pvcpayment_orderType';

    private $SEARCH_SESSION = 'pvcpaymentSEARCH_SESS';
    private $searchString = '';
    /************		Image Processing	******************/
    private $imagePath = '../btPublic/bt-uploads/';

    function __construct(){

        parent::__construct();

        if(!$this->general_model->isModuleEnabled('pvcpayment')){
            redirect(base_url().'admin/dashboard', 'refresh');
        }

    }

    public function index()
    {
        $data['pageTitle'] = $this->project_model->projectName().' :: Payment Plan';

        $data['Message'] = '';
        $data['heading'] = 'PVC Payment Plan';
        $data['pageName'] = 'pvcrequests';
        $data['site_currency'] = $this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings');
        $config['base_url'] = base_url().'admin/pvcpayment/p/';
        $config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

        $data['sessionSearch'] = $this->SEARCH_SESSION;
        if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
            $data['sessionSearch'] = $this->SEARCH_SESSION;
            $this->searchString = $this->session->userdata($this->SEARCH_SESSION);
            $dbFieldsArray = array('title', 'description');
            $config['total_rows'] = $this->general_model->getTotalDataSingleArgumentSearch($this->searchString, $dbFieldsArray, 'ID', $this->Table);
        }

        $config['uri_segment'] = 3;
        $config['per_page'] = $this->session->userdata('recordsPerPage');
        $data['per_page'] = $this->session->userdata('recordsPerPage');
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['counter'] = $page;
        $data['page'] = $page;
        $data['bgColor'] = '#f4f1f1';
        $data['chkCount'] = 0;

        $sort = $this->getSort();
        $data['QUERY'] = $this->general_model->getAllDataSimple($this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

        if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
            $data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
        }

        $this->load->view('admin/pvcResults_view', $data);
    }

    public function p(){

        $data['pageTitle'] = $this->project_model->projectName().' :: payment';
        $data['Message'] = '';
        $data['heading'] = 'PVC Payment Plan';
        $data['pageName'] = 'pvcpayment';
        $data['site_currency'] = $this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings');
        $config['base_url'] = base_url().'admin/payment/p/';
        $config['total_rows'] = $this->general_model->getTotalDataSimple('ID', $this->Table);

        $data['sessionSearch'] = $this->SEARCH_SESSION;
        if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
            $data['sessionSearch'] = $this->SEARCH_SESSION;
            $this->searchString = $this->session->userdata($this->SEARCH_SESSION);
            $dbFieldsArray = array('title', 'description');
            $config['total_rows'] = $this->general_model->getTotalDataSingleArgumentSearch($this->searchString, $dbFieldsArray, 'ID', $this->Table);
        }

        $config['uri_segment'] = 4;
        $config['per_page'] = $this->session->userdata('recordsPerPage');
        $data['per_page'] = $this->session->userdata('recordsPerPage');
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['counter'] = $page;
        $data['page'] = $page;
        $data['bgColor'] = '#f4f1f1';
        $data['chkCount'] = 0;

        $sort = $this->getSort();
        $data['QUERY'] = $this->general_model->getAllDataSimple($this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);

        if((bool)($this->session->userdata($this->SEARCH_SESSION)) == TRUE){
            $data['QUERY'] = $this->general_model->getAllDataSingleArgumentSEARCH($this->searchString, $dbFieldsArray, $this->Table, $config["per_page"], $page, $sort['by'], $sort['type']);
        }

        $this->load->view('admin/pvcrequests_view', $data);
    }

    private function addSort($orderBy, $orderType){

        $data = array($this->sortBySession => $orderBy, $this->sortTypeSession => $orderType);

        $this->session->set_userdata($data);


    }

    private function getSort(){

        if((bool)($this->session->userdata($this->sortBySession)) == TRUE && (bool)($this->session->userdata($this->sortTypeSession)) == TRUE){

            $this->sortBy = $this->session->userdata($this->sortBySession);
            $this->sortType = $this->session->userdata($this->sortTypeSession);
        }

        $sort = array('by' => $this->sortBy, 'type' => $this->sortType);
        return $sort;


    }

    public function Sort($sortBy = NULL){

        if($sortBy == NULL){
            setMessage('error_message', 'Unable to sort, something went wrong from your side. Please try again later with proper procedure!');
            redirect(base_url().'admin/payment', 'refresh');
        }

        $currentSortType = $this->session->userdata($this->sortTypeSession);
        $currentSortBy = $this->session->userdata($this->sortBySession);

        if($currentSortBy != '' && $currentSortType != ''){

            if($currentSortType == 'asc'){
                $newSortType = 'desc';
            }
            else{
                $newSortType = 'asc';
            }

            if($currentSortBy != $sortBy){
                $newSortType = 'asc';
            }
        }
        else{

            $newSortType = 'desc';
        }

        $this->addSort($sortBy, $newSortType);

        redirect(base_url().'admin/pvcpayment','refresh');
    }




    public function delete($agentId = NULL, $page = NULL){
        if($agentId == NULL || $page == NULL){
            setMessage('error_message', 'Unable to delete payment, something went wrong from your side. Please try again later with proper procedure!');
            redirect(base_url().'admin/pvcpayment', 'refresh');
        }

        if($this->general_model->getSingleValue($agentId, 'ID', 'ID', $this->Table) > 0 && isNumber($agentId)){
            $imageName = $this->general_model->getSingleValue($agentId, 'ID', 'picture', $this->Table);
            if($this->general_model->deleteData($agentId, 'ID', $this->Table)){
                if($imageName != ''){removeImage($imageName); }
                $this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed payment', getCurrentDate(), getCurrentTime());

                setMessage('success_message', 'payment removed successfully!');
                redirect(base_url().'admin/pvcpayment/p/'.$page, 'refresh');
            }
        }
        else{
            setMessage('error_message', 'Unable to delete payment, something went wrong from your side. Please try again later with proper procedure!');
            redirect(base_url().'admin/pvcpayment', 'refresh');
        }
    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
