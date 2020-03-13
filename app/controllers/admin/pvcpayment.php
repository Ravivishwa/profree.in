<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pvcpayment extends CI_Controller {
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

    private $Table = 'tbl_pvcpayment_options';
    private $sortBy = 'title';
    private $sortType = 'asc';
    private $sortBySession = 'payment_orderBy';
    private $sortTypeSession = 'payment_orderType';

    private $SEARCH_SESSION = 'paymentSEARCH_SESS';
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

        $this->load->view('admin/pvcpayment/pvcpaymentView', $data);
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

        $this->load->view('admin/pvcpayment/pvcpaymentView', $data);
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

        redirect(base_url().'admin/payment','refresh');
    }


    public function add(){
        $data['pageTitle'] = $this->project_model->projectName().' :: payment : Add Payment Plan';
        $data['Message'] = '';
        $data['heading'] = 'PVC Payment Plan: Add PVC Payment Plan';
        $data['pageName'] = 'pvcpayment';
        $isValid = false;
        $data['site_currency'] = $this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings');
        $data['title'] = '';
        $data['shortDescription'] = '';
        $data['description'] = '';
        $data['price'] = '';
        $data['others'] = '';
        $data['tax'] = '';
        $data['total'] = '';
        $data['userfile'] = '';
        $data['properties'] = 0;
        $data['time_period'] = 0;
        if((bool)($this->input->post('btnAddpvcpayment')) == TRUE){
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['shortDescription'] = $this->input->post('shortDescription');
            $data['price'] = $this->input->post('price');
            $data['others'] = $this->input->post('others');
            $data['tax'] = $this->input->post('tax');
            $data['total'] = $this->input->post('total');
            $data['properties'] = $this->input->post('properties');
            $data['time_period'] = $this->input->post('time_period');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if($this->form_validation->run() === TRUE){

                $image_name = '';
                $isValid = true;
                if (!empty($_FILES['userfile']['name'])){

                    initializeImageSettings();
                    if ($this->upload->do_upload()){
                        $img_data = array($this->upload->data());
                        $image_name = $img_data[0]['file_name'];
                        resize_image($image_name, 'medium', 500, 500);
                        resize_image($image_name, 'thumbs', 100, 70);
                    }
                    else{
                        $error = array($this->upload->display_errors());
                        $data['Message'] = $error[0];
                        $isValid = false;
                    }
                }

            }

            if($isValid){
                $agentId = $this->session->userdata('agentId');
                $Date = getCurrentDate();
                $Time = getCurrentTime();
                $DbFieldsAry = array('agentId', 'title', 'shortDescription', 'description', 'price', 'properties', 'time_period', 'picture', 'date', 'status');
                $InfoAry = array($agentId, $data['title'], $data['shortDescription'], $data['description'], $data['price'], $data['properties'], $data['time_period'], $image_name, $Date, 'YES');
                if($this->general_model->addInfo_Simple($DbFieldsAry, $InfoAry, $this->Table)){

                    $activityId = $this->general_model->getSingleValue($data['title'], 'title', 'ID', $this->Table);
                    $this->general_model->addAgentActivity($agentId, $this->Table, $activityId, 'added new payment', $Date, $Time);
                    setMessage('success_message', 'Payment Plan added successfully!');
                    redirect(base_url().'admin/payment', 'refresh');
                }
                else{
                    setMessage('error_message', 'Unable to perofrm this operation, please try again later!');
                    redirect(base_url().'admin/pvcpayment', 'refresh');
                }
            }
            else{
                $this->load->view('admin/pvcpayment/addpvcpaymentView', $data);
            }
        }
        else{
            $this->load->view('admin/pvcpayment/addpvcpaymentView', $data);
        }
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


    public function update($ID = NULL, $page = NULL){
        $data['pageTitle'] = $this->project_model->projectName().' :: pvcpayment : Update PVC Payment Plan';
        $data['Message'] = '';
        $data['heading'] = 'PVC Payment Plan: Update PVC Payment Plan';
        $data['pageName'] = 'pvcpayment';
        $data['page'] = $page;
        $data['ID'] = $ID;
        $isValid = false;
        $data['site_currency'] = $this->general_model->single_value("ID = '1'", 'currency', 'tbl_settings');
        $DATA = $this->general_model->getSingleData_Simple($ID, 'ID', $this->Table);
        if((bool)($this->input->post('btnUpdatepayment')) == TRUE){

            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['picture'] = $this->input->post('picture');
            $data['shortDescription'] = $this->input->post('shortDescription');
            $data['price'] = $this->input->post('price');
            $data['others'] = $this->input->post('others');
            $data['tax'] = $this->input->post('tax');
            $data['total'] = $this->input->post('total');
            $data['properties'] = $this->input->post('properties');
            $data['time_period'] = $this->input->post('time_period');
            $this->form_validation->set_rules('title', 'Title', 'trim|required');

            if($this->form_validation->run() === TRUE){

                $image_name = $data['picture'];
                $isValid = true;
                if (!empty($_FILES['userfile']['name'])){

                    initializeImageSettings();
                    if ($this->upload->do_upload()){
                        $img_data = array($this->upload->data());
                        $image_name = $img_data[0]['file_name'];
                        resize_image($image_name, 'medium', 500, 500);
                        resize_image($image_name, 'thumbs', 100, 70);

                        if($data['picture'] != ''){removeImage($data['picture']);}
                    }
                    else{
                        $error = array($this->upload->display_errors());
                        $data['Message'] = $error[0];
                        $isValid = false;
                    }
                }

                if($isValid){
                    $updateDbFieldsAry = array('agentId', 'title', 'shortDescription', 'description', 'price', 'properties',  'time_period','picture');
                    $updateInfoAry = array($this->session->userdata('agentId'), $data['title'], $data['shortDescription'], $data['description'], $data['price'], $data['properties'], $data['time_period'], $image_name);
                    $this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

                    $this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'updated link', getCurrentDate(), getCurrentTime());
                    setMessage('success_message', 'Payment Plan updated successfully!');
                    redirect(base_url().'admin/pvcpayment/p/'.$page, 'refresh');
                }
                else{
                    $this->load->view('admin/pvcpayment/editpvcpaymentView', $data);
                }
            }
            else{
                $this->load->view('admin/pvcpayment/editpvcpaymentView', $data);
            }
        }
        else{
            $data['title'] = $DATA->title;
            $data['description'] = $DATA->description;
            $data['picture'] = $DATA->picture;
            $data['shortDescription'] = $DATA->shortDescription;
            $data['price'] = $DATA->price;
            $data['others'] = $DATA->others;
            $data['tax'] = $DATA->tax;
            $data['total'] = $DATA->total;
            $data['properties'] = $DATA->properties;
            $data['time_period'] = $DATA->time_period;
            $this->load->view('admin/pvcpayment/editpvcpaymentView', $data);
        }
    }

    public function performAction($page){

        $action = $_POST['actionType'];

        $totalRows = $_POST['counter_number'];

        switch($action){

            case 'activeAll':
                for($i=1; $i<=$totalRows; $i++){

                    if((bool)($this->input->post('CB'.$i)) == TRUE){
                        $ID = $this->input->post('CB'.$i);
                        $this->changeStatusALL($ID, 'YES');
                    }
                }
                setMessage('success_message', 'Status updated successfully!');
                break;

            case 'inActiveAll':
                for($i=1; $i<=$totalRows; $i++){

                    if((bool)($this->input->post('CB'.$i)) == TRUE){
                        $ID = $this->input->post('CB'.$i);
                        $this->changeStatusALL($ID, 'NO');
                    }
                }
                setMessage('success_message', 'Status updated successfully!');
                break;

            case 'deleteAll':
                for($i=1; $i<=$totalRows; $i++){

                    if((bool)($this->input->post('CB'.$i)) == TRUE){
                        $ID = $this->input->post('CB'.$i);

                        $imageName = $this->general_model->getSingleValue($ID, 'ID', 'picture', $this->Table);

                        $this->deleteAll($ID);

                        if($imageName != ''){removeImage($imageName);}
                    }
                }
                setMessage('success_message', 'Removed successfully!');
                break;
        }

        redirect(base_url().'admin/payment/p/'.$page, 'refresh');
    }


    private function changeStatusALL($ID, $status){

        $updateDbFieldsAry = array('status');
        $updateInfoAry = array($status);
        $this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

        $this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());
    }


    private function deleteAll($agentId){

        if($this->general_model->deleteData($agentId, 'ID', $this->Table)){

            $this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $agentId, 'removed payment', getCurrentDate(), getCurrentTime());
        }
    }

    public function changeStatus($ID, $status, $page){

        if($ID == NULL || $status == NULL || $page == NULL){
            setMessage('error_message', 'Unable to change status, something went wrong from your side. Please try again later with proper procedure!');
            redirect(base_url().'admin/payment', 'refresh');
        }

        if($status == 'YES'){
            $newStatus = 'NO';
        }
        else{
            $newStatus = 'YES';
        }

        $updateDbFieldsAry = array('status');
        $updateInfoAry = array($newStatus);
        $this->general_model->updateInfo_Simple($ID, 'ID', $updateDbFieldsAry, $updateInfoAry, $this->Table);

        $this->general_model->addAgentActivity($this->session->userdata('agentId'), $this->Table, $ID, 'changed status', getCurrentDate(), getCurrentTime());

        redirect(base_url().'admin/payment/p/'.$page,'refresh');
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
