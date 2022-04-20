<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';
class Setting extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model');
        $this->load->model('project_model');
        $this->load->model('user_model');
        $this->load->library('email');
        $this->load->library('excel');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the setting.
     */
    public function index()
    {

        $userlist = $this->user_model->getAllActiveUser();
        // echo '<pre>';
        // print_r($userlist);

        $this->global['pageTitle'] = 'Amplify : Dashboard';

        $this->loadViews('dashboard', $this->global, null, null);
    }

    /**
     * This function is used to load the stage list.
     */
    public function stageList()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get call key
            $sqlCallKey    = "SELECT * FROM amp_setting WHERE id = 1";
            $resultCallKey = $this->db->query($sqlCallKey)->result_array();
            $data['phoneSystem']    = $resultCallKey[0]['phonecall_enable'];
            $data['phoneSystemkey'] = $resultCallKey[0]['phonecall_key'];
            $data['fs_url'] = $resultCallKey[0]['filesystem_url'];
             //-------------------------------------------------------------------------------------------

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->setting_model->stageListCount($searchText);
            $refcount = $this->setting_model->refTypeCount();
            $tagcount = $this->setting_model->tagCount();
            $sellingcount = $this->setting_model->sellingCount();
            $returns = $this->paginationCompress('stageList/', $count, 10);
            $data['count'] = $count;
            $data['refcount'] = $refcount;
            $data['tagcount'] = $tagcount;
            $data['sellingcount'] = $sellingcount;
            $data['stageList'] = $this->setting_model->stageList($searchText, $returns['page'], $returns['segment']);
            $data['tagList'] = $this->setting_model->tagList($searchText, $returns['page'], $returns['segment']);
            $data['jobtypeList'] = $this->setting_model->jobtypeList($searchText, $returns['page'], $returns['segment']);
            $data['crossSelling'] = $this->setting_model->sellingList($searchText, $returns['page'], $returns['segment']);
            $data['referralList'] = $this->setting_model->referralList($searchText, $returns['page'], $returns['segment']);

            $userId = $this->session->userdata['userId'];
            $where = array("userid"=>$userId);
            $data['smtpDetail'] = $this->setting_model->select_where('amp_smtp',$where);
            $this->global['pageTitle'] = 'Amplify : Settings';

            $this->loadViews('settings/stage_List', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load the add new form.
     */
    public function addNewStage()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Amplify : Add New Stage';

            $this->loadViews('settings/add_stage', $this->global, null);
        }
    }


    /**
     * This function is used to load the add new form.
     */
    public function addNewSelling()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Amplify : Add New Selling';

            $this->loadViews('settings/add_selling', $this->global, null);
        }
    }


    /**
     * This function is used to load the add new form.
     */
    public function addNewTag()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Amplify : Add New Tag';

            $this->loadViews('settings/add_tag', $this->global, null);
        }
    }

    /**
     * This function is used to load the add new job type form.
     */
    public function addNewJobType()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Amplify : Add New Job Type';

            $this->loadViews('settings/add_jobtype', $this->global, null);
        }
    }


    /**
     * This function is used to load the add new form.
     */
    public function addNewRef()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Amplify : Add New Referral';

            $this->loadViews('settings/add_ref', $this->global, null);
        }
    }

    
    /**
     * This function is used to add new Stage to the system.
     */
    public function addStage()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('stage_name', 'Stage Name', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('color', 'Color', 'trim|required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->addNewStage();
            } else {
                $stage_name = $this->security->xss_clean($this->input->post('stage_name'));
                // $color = $this->security->xss_clean($this->input->post('color'));
                $current_order = $this->setting_model->currentOrder();
                $newOrder = $current_order['stageOrder']+1;

                $stageInfo = array('stageName' => $stage_name,'stageOrder' => $newOrder,'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->setting_model->addNewStage($stageInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Stage created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Stage creation failed');
                }

                redirect('settings');
            }
        }
    }


    /**
     * This function is used to add new Selling to the system.
     */
    public function addSelling()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('ownership_name', 'Ownership Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('policyExp', 'policyExp', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('businessOwner', 'businessOwner', 'required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->addNewSelling();
            } else {
                $ownership_name = $this->security->xss_clean($this->input->post('ownership_name'));
                $policyExp = $this->security->xss_clean($this->input->post('policyExp'));
                $businessOwner = $this->input->post('businessOwner');
                $current_order = $this->setting_model->currentSellingOrder();
                $newOrder = $current_order['sellingOrder']+1;

                $sellingInfo = array('ownership' => $ownership_name, 'policyExpiration' => $policyExp, 'businessOwner' => $businessOwner,'sellingOrder' => $newOrder,'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->setting_model->addNewSelling($sellingInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Selling created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Selling creation failed');
                }

                redirect('settings');
            }
        }
    }


    /**
     * This function is used to add new tag to the system.
     */
    public function addTag()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('tagName', 'Tag Name', 'trim|required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->addNewTag();
            } else {
                $tagName = $this->security->xss_clean($this->input->post('tagName'));
                
                $current_order = $this->setting_model->currentTagOrder();
                $newOrder = $current_order['tagOrder']+1;
                $tagInfo = array('tagName' => $tagName, 'tagOrder' => $newOrder,'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->setting_model->addNewTag($tagInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Tag created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Tag creation failed');
                }

                redirect('settings');
            }
        }
    }



    /**
     * This function is used to add new Job Type to the system.
     */
    public function addJobType()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('jobType', 'Job Type', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('color', 'Color', 'trim|required|max_length[128]');
              
            if ($this->form_validation->run() == false) {
                $this->addNewJobType();
            } else {
                $job_type = $this->security->xss_clean($this->input->post('jobType'));
                $color = $this->security->xss_clean($this->input->post('color'));
        
                
                $jobTypeInfo = array('jobType' => $job_type, 'color' => $color);

                $result = $this->setting_model->addJobType($jobTypeInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New job type created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Job type creation failed');
                }
                redirect('settings');
            }
        }
    }



    /**
     * This function is used to add new referral to the system.
     */
    public function addRef()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('refName', 'Referral Name', 'trim|required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->addNewRef();
            } else {
                $refName = $this->security->xss_clean($this->input->post('refName'));
                $current_order = $this->setting_model->currentRefOrder();
                $newOrder = $current_order['referralOrder']+1;
                
                $refInfo = array('referralName' => $refName, 'referralOrder' => $newOrder,'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->setting_model->addNewRef($refInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Referral created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Referral creation failed');
                }

                redirect('settings');
            }
        }
    }

    /**
     * This function is used load stage edit information.
     *
     * @param number $stageId : Optional : This is stage id
     */
    public function editOldStage($stageId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($stageId == null) {
                redirect('settings');
            }

            $data['stageInfo'] = $this->setting_model->getStageInfo($stageId);

            $this->global['pageTitle'] = 'Amplify : Edit Stage';
            $this->global['PageEdit'] = $data['stageInfo']->stageName;
            $this->loadViews('settings/edit_stage', $this->global, $data, null);
        }
    }


    /**
     * This function is used load tag edit information.
     *
     * @param number $tagId : Optional : This is tag id
     */
    public function editOldTag($tagId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($tagId == null) {
                redirect('settings');
            }

            $data['tagInfo'] = $this->setting_model->getTagInfo($tagId);

            $this->global['pageTitle'] = 'Amplify : Edit Tag';
            $this->global['PageEdit'] = $data['tagInfo']->tagName;
            $this->loadViews('settings/edit_tag', $this->global, $data, null);
        }
    }

    /**
     * This function is used load Job edit information.
     *
     * @param number $JobtypeId : Optional : This is Job Type id
     */
    public function editJobType($jobTypeId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($jobTypeId == null) {
                redirect('settings');
            }

            $data['jobTypeInfo'] = $this->setting_model->getJobTypeInfo($jobTypeId);

            $this->global['pageTitle'] = 'Amplify : Edit Job Type';
            $this->global['PageEdit'] = $data['jobTypeInfo']->jobType;
            $this->loadViews('settings/edit_jobtype', $this->global, $data, null);
        }
    }


    /**
     * This function is used load Selling edit information.
     *
     * @param number $sellingId : Optional : This is selling id
     */
    public function editOldSelling($sellingId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($sellingId == null) {
                redirect('settings');
            }

            $data['sellingInfo'] = $this->setting_model->getSellingInfo($sellingId);
            
            $this->global['pageTitle'] = 'Amplify : Edit Cross Selling';
            $this->global['PageEdit'] = $data['sellingInfo']->ownership;
            $this->loadViews('settings/edit_selling', $this->global, $data, null);
        }
    }


    /**
     * This function is used load referral edit information.
     *
     * @param number $tagId : Optional : This is ref id
     */
    public function editOldReferral($refId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($refId == null) {
                redirect('settings');
            }

            $data['refInfo'] = $this->setting_model->getRefInfo($refId);

            $this->global['pageTitle'] = 'Amplify : Edit Referral';
            $this->global['PageEdit'] = $data['refInfo']->referralName;
            $this->loadViews('settings/edit_ref', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the stage information.
     */
    public function editStage()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $stageId = $this->input->post('stageId');

            $this->form_validation->set_rules('stage_name', 'Stage Name', 'trim|required|max_length[128]');
            //$this->form_validation->set_rules('color', 'Color Name', 'trim|required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->editOldStage($stageId);
            } else {
                $stage_name = $this->input->post('stage_name');
                //$color = $this->input->post('color');
                
                
                $stageInfo = array('stageName' => $stage_name,  'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->setting_model->editStage($stageInfo, $stageId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Stage updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Stage updation failed');
                }

                redirect('settings');
            }
        }
    }



    /**
     * This function is used to edit the tag information.
     */
    public function editTag()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $tagId = $this->input->post('tagId');

            $this->form_validation->set_rules('tag_name', 'Tag Name', 'trim|required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->editOldTag($tagId);
            } else {
                $tag_name = $this->input->post('tag_name');
                
                
                $tagInfo = array('tagName' => $tag_name,'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->setting_model->editTag($tagInfo, $tagId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Tag updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Tag updation failed');
                }

                redirect('settings');
            }
        }
    }

    /**
     * This function is used to edit the Job Type information.
     */
    public function editSaveJobType()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $jobTypeId = $this->input->post('jobTypeId');
            $this->form_validation->set_rules('jobType', 'Job Type', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('color', 'Color', 'trim|required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->editJobType($jobTypeId);
            } else {
                $job_type = $this->input->post('jobType');
                $color = $this->input->post('color');
                
                
                $jobTypeInfo = array('jobType' => $job_type,'color' => $color);

                $result = $this->setting_model->editSaveJobType($jobTypeInfo, $jobTypeId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Job type updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Job type updation failed');
                }

                redirect('settings');
            }
        }
    }



    /**
     * This function is used to edit the Selling information.
     */
    public function editSelling()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $sellingId = $this->input->post('sellingId');

            $this->form_validation->set_rules('ownership', 'ownership', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('policyExp', 'policyExp', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('businessOwner', 'businessOwner', 'trim|required|max_length[128]');
            
            
            if ($this->form_validation->run() == false) {
                $this->editOldTag($tagId);
            } else {
                $ownership = $this->input->post('ownership');
                $policyExp = $this->input->post('policyExp');
                $businessOwner = $this->input->post('businessOwner');
                
                
                $sellingInfo = array('ownership' => $ownership, 'policyExpiration' => $policyExp, 'businessOwner' => $businessOwner,'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->editSelling($sellingInfo, $sellingId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Selling updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Selling updation failed');
                }

                redirect('settings');
            }
        }
    }


    /**
     * This function is used to edit the ref information.
     */
    public function editReferral()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $refId = $this->input->post('refId');

            $this->form_validation->set_rules('referralName', 'Referral Name', 'trim|required|max_length[128]');
            

            if ($this->form_validation->run() == false) {
                $this->editOldTag($tagId);
            } else {
                $referralName = $this->input->post('referralName');
                
                
                $refInfo = array('referralName' => $referralName,'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->setting_model->editRef($refInfo, $refId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Referral updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Referral updation failed');
                }

                redirect('settings');
            }
        }
    }

    /**
     * This function is used to delete the stage using stageId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteStage()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $stageId = $this->input->post('stageId');
            $stageInfo = array('stageOrder'=>0,'isDeleted' => 1, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->deleteStage($stageId, $stageInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }


    /**
     * This function is used to delete the tag using tagId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteTag()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $tagId = $this->input->post('tagId');
            $tagInfo = array('tagOrder'=>0,'isDeleted' => 1, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->deleteTag($tagId, $tagInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }


    /**
     * This function is used to delete the Job Type using JobTypeId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteJobType()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $jobTypeId = $this->input->post('jobTypeId');
            $jobTypeInfo = array('isDeleted' => 1);
            $result = $this->setting_model->deleteJobType($jobTypeId, $jobTypeInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }



    /**
     * This function is used to delete the selling using sellingId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteSelling()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $sellingId = $this->input->post('sellingId');
            $sellingInfo = array('sellingOrder'=>0,'isDeleted' => 1, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->deleteSelling($sellingId, $sellingInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }


    /**
     * This function is used to delete the ref using refId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteReferral()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $refId = $this->input->post('refId');
            $refInfo = array('referralOrder'=>0,'isDeleted' => 1, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->deleteRef($refId, $refInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }



    /**
     * This function is used to Update the stage using stageId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function upOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $stageId = $this->input->post('stageId');
            $orderId = $this->input->post('orderId');
            if($orderId==1){
                $order =1;
            }else{
                $order = $orderId-1;
                $neworder = $order+1;
                $upstageInfo = array('stageOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupOrder($order, $upstageInfo);
            }             
            $upstageInfo = array('stageOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upOrder($stageId, $upstageInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }


    /**
     * This function is used to Update the tag using tagId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function upTagOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $tagId = $this->input->post('tagId');
            $orderId = $this->input->post('orderId');
            if($orderId==1){
                $order =1;
            }else{
                $order = $orderId-1;
                $neworder = $order+1;
                $upstageInfo = array('tagOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupTagOrder($order, $upstageInfo);
            }              
            $uptagInfo = array('tagOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upTagOrder($tagId, $uptagInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    } 


    /**
     * This function is used to Update the selling using sellingId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function upSellingOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $sellingId = $this->input->post('sellingId');
            $orderId = $this->input->post('orderId');
            if($orderId==1){
                $order =1;
            }else{
                $order = $orderId-1;
                $neworder = $order+1;
                $upsellingInfo = array('sellingOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupSellingOrder($order, $upsellingInfo);
            }            
            $upsellingInfo = array('sellingOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upSellingOrder($sellingId, $upsellingInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    } 



    /**
     * This function is used to Up the ref using refId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function upReferralOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $refId = $this->input->post('refId');
            $orderId = $this->input->post('orderId');
            if($orderId==1){
                $order =1;
            }else{
                $order = $orderId-1;
                $neworder = $order+1;
                $uprefInfo = array('referralOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupReferralOrder($order, $uprefInfo);
            }            
            $uprefInfo = array('referralOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upReferralOrder($refId, $uprefInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    } 


    /**
     * This function is used to Update the stage using stageId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function downOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $stageId = $this->input->post('stageId');
            $orderId = $this->input->post('orderId');
            $count = $this->input->post('count');
            if($orderId<$count){
                $order =$orderId+1;

                $neworder = $order-1;
                $upstageInfo = array('stageOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupOrder($order, $upstageInfo);
            }else{
                $order = $orderId;
            }   
            
            $upstageInfo = array('stageOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upOrder($stageId, $upstageInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    } 


    /**
     * This function is used to Update the tag using tagId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function downTagOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $tagId = $this->input->post('tagId');
            $orderId = $this->input->post('orderId');
            $count = $this->input->post('count');
            if($orderId<$count){
                $order =$orderId+1;

                $neworder = $order-1;
                $uptagInfo = array('tagOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupTagOrder($order, $uptagInfo);
            }else{
                $order = $orderId;
            }  
            $uptagInfo = array('tagOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upTagOrder($tagId, $uptagInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    } 


    /**
     * This function is used to Update the selling using sellingId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function downSellingOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $sellingId = $this->input->post('sellingId');
            $orderId = $this->input->post('orderId');
            $count = $this->input->post('count');
            if($orderId<$count){
                $order =$orderId+1;

                $neworder = $order-1;
                $upsellingInfo = array('sellingOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupSellingOrder($order, $upsellingInfo);
            }else{
                $order = $orderId;
            } 
            $upsellingInfo = array('sellingOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upSellingOrder($sellingId, $upsellingInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    } 


    /**
     * This function is used to down the ref using refId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function downReferralOrder()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $refId = $this->input->post('refId');
            $orderId = $this->input->post('orderId');
            $count = $this->input->post('count');
            if($orderId<$count){
                $order =$orderId+1;

                $neworder = $order-1;
                $uprefInfo = array('referralOrder' => $neworder, 'updatedDtm' => date('Y-m-d H:i:s'));
                $result = $this->setting_model->newupReferralOrder($order, $uprefInfo);               
            }else{
                $order = $orderId;
            }  
            $uprefInfo = array('referralOrder' => $order, 'updatedDtm' => date('Y-m-d H:i:s'));
            $result = $this->setting_model->upReferralOrder($refId, $uprefInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not.
     */
    function checkOrderExists()
    {
        $sellingId = $this->input->post("sellingId");
        $sellingOrder = $this->input->post("sellingOrder");

        if(empty($sellingId)){
            $result = $this->setting_model->checkOrderExists($sellingOrder);
        } else {
            $result = $this->setting_model->checkOrderExists($sellingOrder, $sellingId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    } 

    /**
     * This function is used to show email from gmail account
     */
    function showemail()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            
            $this->global['pageTitle'] = 'Amplify : Dashboard';

            //$data['tagInfo'] = $this->setting_model->getTagInfo($tagId);

            $this->global['pageTitle'] = 'Amplify : Email Inbox';

            //email smtp 
            $this->global['emailProtocol'] = $this->config->item('protocol');
            $this->global['emailSmtpHost'] = $this->config->item('smtp_host');
            $this->global['emailSmtpPort'] = $this->config->item('smtp_port');
            $this->global['emailSmtpUser'] = $this->config->item('smtp_user');
            $this->global['emailSmtpPass'] = $this->config->item('smtp_pass');
            $this->global['emailMailtype'] = $this->config->item('mailtype');
            $this->global['emailCharset']  = $this->config->item('charset');

            $this->loadViews('settings/emailView', $this->global, null, null);
        }
    }    


    function updatePhoneCallAPI() {
        $phoneSystem    = $this->input->post("phoneSystem");
        $phoneSystemkey = $this->input->post("phoneSystemkey");

        //Update key
        $updateInfo = array('phonecall_enable' => $phoneSystem, 'phonecall_key' => $phoneSystemkey);
        $this->db->where('id', 1);
        $this->db->update('amp_setting', $updateInfo);

        echo "1"; die();
    }

    function updateFsUrl() {
        $fs_url = $this->input->post("fs_url");

        //Update key
        $updateInfo = array('filesystem_url' => $fs_url);
        $this->db->where('id', 1);
        $this->db->update('amp_setting', $updateInfo);

        echo "1"; die();
    }

    function saveSMTP() {

      $smtpid = $this->input->post("smtpid");
      $userid = $this->input->post("userid");
      $mail_server = $this->input->post("mail_server");
      $username = $this->input->post("username");
      $password = $this->input->post("password");

      $data = array(
        "userid" => $userid,
        "mail_server" => $mail_server,
        "username" => $username,
        "password" => $password
      );

      if($smtpid == 0){
        $result = $this->setting_model->insertSMTP('amp_smtp',$data);
      }else{
        $this->db->where('id', $smtpid);
        $this->db->where('userid', $userid);
        $result = $this->db->update('amp_smtp', $data);
      }
        echo "1"; die();
    }

    /**
     * This function is used to import project data from XLS file
    */

    public function uploadData(){
        if (!$this->input->is_ajax_request()) {
           exit('No direct script access allowed');
        }
        $userid = $this->session->userdata['userId'];
        if(isset($_FILES["import_data"]["name"])) { 
                $path = 'assets/uploads/';
                
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);  
                $jobTypes = $this->project_model->getJobTypes();
                //echo "<pre>";print_r($jobTypes);die;

                if (!$this->upload->do_upload('import_data')) { 
                    $error = array('error' => $this->upload->display_errors());
                } else { 
                    $data = array('upload_data' => $this->upload->data());
                }
                
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
               
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                   $inserdata = array();

                   $inserCl1data = array();
                   $inserCl2data = array();
                   $inserCl3data = array();
                   $inserCl4data = array();
                   $inserCl5data = array();

                   $inserPCl1data = array();
                   $inserPCl2data = array();
                   $inserPCl3data = array();
                   $inserPCl4data = array();
                   $inserPCl5data = array();

                   $inserCnt1data = array();
                   $inserCnt2data = array();
                   $inserCnt3data = array();
                   $inserCnt4data = array();

                   $inserPCnt1data = array();
                   $inserPCnt2data = array();
                   $inserPCnt3data = array();
                   $inserPCnt4data = array();

                   $temp = 0;

                    foreach ($allDataInSheet as $value) {

                      if($flag){
                        $flag = false;
                        continue;
                      }

                        $adminEmail = $value['L'];
                        if(!empty($adminEmail)){
                            $userResult=$this->setting_model->checkEmailExists($adminEmail);
                            $estimatorId1=$this->setting_model->checkEmailExists($value['M']);


                            $estimatorId2=$this->setting_model->checkEmailExists($value['N']);
                            $salesId=$this->setting_model->checkEmailExists($value['K']);
                             //print_r($estimatorId2);
                            if(!empty($userResult) && (!empty($estimatorId1) || !empty($estimatorId2)) && !empty($salesId)){
                                $userid = $userResult[0]->userid;
                                // if(empty($userResult)){

                                //     $userInfo = array('email' => $adminEmail, 'password' => md5('Test123'), 'roleId' => 4, 'name' => "",
                                //             'mobile' => "",'extension'=>"", 'createdBy' => "", 'createdDtm' => date('Y-m-d H:i:s'), );

                                //     $userid = $this->setting_model->addNewUser($userInfo); 
                                // }else{
                                //     $userid = $userResult[0]->userid;

                                $inserdata[$i]['filesystem_id'] =  $value['B']; //Project Number A
                                $inserdata[$i]['projectName'] = $value['C']; //Project Name B
                                if(strtolower($value['D'])=="contracting" || strtolower($value['D'])=="contractor"){
                                    $inserdata[$i]['company'] = "contractor"; //Project Name B
                                }
                                if(strtolower($value['D'])=="north"){
                                    $inserdata[$i]['company'] = "north"; //Project Name B
                                }
                                foreach ($jobTypes as $key => $jobtypeval) { //echo $jobtypeval->jobType.'->';
                                    if(strtolower($jobtypeval->jobType) == strtolower($value['E']))
                                    {   
                                        $inserdata[$i]['jobtypeid'] = $jobtypeval->id;
                                    }
                                }
                                //$inserdata[$i]['jobtypeid'] = $value['E']; //New ----------------------
                                if(strtolower($value['F'])=="y"){
                                    $inserdata[$i]['is_priority'] = "1"; //Project Name B
                                }
                                $inserdata[$i]['contract'] = $value['G']; //New

                                $budGet = $value['H']; //Budget (Yes,No) E before C
                                if(trim($budGet) == "N" || trim($budGet) == "No"){
                                    $budget = "0";
                                }else{
                                    $budget = "1";
                                }
                                $inserdata[$i]['budget'] = $budget; 

                                $Scope = trim($value['I']); //Scope (A,D,E) BEFORE D
                                if($Scope != "" || $Scope != NULL){
                                    $scope_arr = explode(",",$Scope);

                                    $scope_str = "";
                                    if (in_array("A", $scope_arr)){
                                        if($scope_str == ""){
                                            $scope_str = "abatement";
                                        }else{
                                             $scope_str = $scope_str.","."abatement";
                                        }
                                    }
                                    if (in_array("ID", $scope_arr)){
                                        if($scope_str == ""){
                                            $scope_str = "interior_demolition";
                                        }else{
                                             $scope_str = $scope_str.","."interior_demolition";
                                        }
                                    }
                                    if (in_array("SD", $scope_arr)){
                                        if($scope_str == ""){
                                            $scope_str = "site_demolition";
                                        }else{
                                             $scope_str = $scope_str.","."site_demolition";
                                        }
                                    }
                                    if (in_array("EW", $scope_arr) || in_array("E", $scope_arr)){
                                        if($scope_str == ""){
                                            $scope_str = "earthwork";
                                        }else{
                                             $scope_str = $scope_str.","."earthwork";
                                        }
                                    }
                                    if (in_array("O", $scope_arr) || in_array("OTHER", $scope_arr)){
                                        if($scope_str == ""){
                                            $scope_str = "other";
                                        }else{
                                            $scope_str = $scope_str.","."other";
                                        }
                                    }
                                    $scope = $scope_str;
                                }else{
                                    $scope = "";
                                }
                                $inserdata[$i]['scope'] = $scope;

                                $inserdata[$i]['wages'] = $value['J']; //Wages E
                                $inserdata[$i]['sales'] = $salesId[0]->userid; //Sales
                                $inserdata[$i]['admin'] = $userid;//$value['I']; //Admin
                                $inserdata[$i]['estimator_email'] = $value['M']; //Estimator Email
                                $estimatorIds = "";
                                
                                if(!empty($estimatorId1)){
                                    $estimatorIds .= $estimatorId1[0]->userid.",";
                                }

                                
                                if(!empty($estimatorId2)){
                                    $estimatorIds .= $estimatorId2[0]->userid.",";
                                }

                                $inserdata[$i]['estimator'] = rtrim($estimatorIds, ','); //Estimator DOUBT
                                $inserdata[$i]['address'] = $value['O']; //Address
                                $getLatLong    = $this->setting_model->getLatLong($value['O']);
                                //$getLatLong    = $this->map_model->getLatLong($address);//print_r($getLatLong);
                                $getLatLongArr = explode("@",$getLatLong);
                                $latitude      = $getLatLongArr[0];
                                $longitude     = $getLatLongArr[1];
                                $inserdata[$i]['latitude'] = $latitude;
                                $inserdata[$i]['longitude'] = $longitude;

                                $due_Date = $value['P']; //Due Date
                                if($due_Date != "" || $due_Date != NULL){
                                    $due_Date_timestamp = str_replace('/', '-', $due_Date );
                                    $inserdata[$i]['dueDate'] = date('m/d/Y', strtotime($due_Date_timestamp));
                                }else{
                                    $inserdata[$i]['dueDate'] = "";
                                }
                        

                                $inserdata[$i]['dueTime'] = $value['Q']; //Due Time
                                $inserdata[$i]['jobWalkTime'] = $value['R']; //Job Walk/Time

                                $rfi_Deadline = $value['S']; // RFI Deadline
                                if($rfi_Deadline != "" || $rfi_Deadline != NULL || $rfi_Deadline != "N"){
                                    $rfi_Deadline_timestamp = str_replace('/', '-', $rfi_Deadline );
                                    $inserdata[$i]['rfiDeadline']  = date('m/d/Y', strtotime($rfi_Deadline_timestamp));
                                }else{
                                    $inserdata[$i]['rfiDeadline'] = "";
                                }
                                

                                $bid_Form = $value['T']; // Bid Form (Y/N)
                                if(trim($bid_Form) == "N" || trim($bid_Form) == "No"){
                                    $bidForm = "0";
                                }else{
                                    $bidForm = "1";
                                }
                                $inserdata[$i]['bidForm']  = $bidForm;

                                $bid_price = $value['U']; // Bid Form (Y/N) NEW

                                $inserdata[$i]['bid_price']  =  (int)str_replace( '$', '',str_replace( ',', '', $bid_price));

                                $Reports = $value['V']; // Reports (Y/N)
                                if(trim($Reports) == "N" || trim($Reports) == "No"){
                                    $reports = "0";
                                }else{
                                    $reports = "1";
                                }

                        
                                $inserdata[$i]['reports']  = $reports;

                                $inserdata[$i]['userID']  = $userid; //Need to check for this by admin email

                                //What is Project manager Email from excel
                                $inserdata[$i]['salesRepId']  = $value['W'];

                                $inserdata[$i]['marketType'] = $value['X']; // Notes

                                $inserdata[$i]['buildingType'] = $value['Y']; // Notes

                                $inserdata[$i]['materialNeeds'] = $value['Z']; // Notes Doubt how its value will be 

                                $inserdata[$i]['buildingSf'] = $value['AA']; // Notes Doubt how its value will be 

                                $stageId = $value['A']; //Budget (Yes,No) E before C
                                if(trim($stageId) == "Prospects" || trim($stageId) == "PROSPECTS"){
                                    $stageId = "2";
                                }
                                if(trim($stageId) == "Pending Budgets" || trim($stageId) == "PENDING BUDGETS" || trim($stageId) == "PENDINGBUDGETS"){
                                    $stageId = "1";
                                }
                                if(trim($stageId) == "Pending Bids" || trim($stageId) == "PENDING BIDS" || trim($stageId) == "PENDINGBIDS"){
                                    $stageId = "5";
                                }
                                if(trim($stageId) == "Bid Board" || trim($stageId) == "BID BOARD" || trim($stageId) == "BIDBOARD"){
                                    $stageId = "11";
                                }
                                if(trim($stageId) == "Won" || trim($stageId) == "WON"){
                                    $stageId = "12";
                                }
                                if(trim($stageId) == "Lost" || trim($stageId) == "LOST"){
                                    $stageId = "10";
                                }
                                if(trim($stageId) == "90 Percent" || trim($stageId) == "90 PERCENT" || trim($stageId) == "90PERCENT" || trim($stageId) == "90% List"){
                                    $stageId = "13";
                                }

                        
                               // $inserdata[$i]['budget'] = $budget; 
                                if($stageId != ""){
                                    $inserdata[$i]['stageId'] = $stageId; // Notes
                                }

                        
                                $inserdata[$i]['createdDtm'] = date("Y-m-d"); //Project Create Date
                                $inserdata[$i]['notes'] = $value['AU']; // Notes
                                $result = $this->db->insert('amp_projects', $inserdata[$i]); 
                                $insert_id = $this->db->insert_id();

                                //Import Data in client and contact table
                                if($insert_id){

                                    //Client 1 and his contact
                                    $client1_insert_id = 0;
                                    if($value['AC'] != "" || $value['AC'] != NULL){
                                        $inserCl1data[$i]['userID'] = $userid; //User Id
                                        $inserCl1data[$i]['client_name'] = $value['AC']; //Client Name
                                        $client1_result = $this->db->insert('amp_clients', $inserCl1data[$i]); 
                                        $client1_insert_id = $this->db->insert_id();

                                        $inserPCl1data[$i]['userID'] = $userid; //User Id
                                        $inserPCl1data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCl1data[$i]['clientId'] = $client1_insert_id; //client Id
                                        $inserPCl1data[$i]['clientType'] = 1; //Type
                                        $this->db->insert('amp_project_clients', $inserPCl1data[$i]); 
                                    }

                                    if($value['AH'] != "" || $value['AH'] != NULL){
                                        $inserCnt1data[$i]['contact_name'] = $value['AH'];
                                    }
                                    if($value['AM'] != "" || $value['AM'] != NULL){
                                        $inserCnt1data[$i]['contact_email'] = $value['AM'];
                                    }
                                    if($value['AN'] != "" || $value['AN'] != NULL){
                                        $inserCnt1data[$i]['contact_phone'] = $value['AN'];
                                    }

                                    if(!empty($inserCnt1data[$i])){
                                        $inserCnt1data[$i]['userID'] = $userid; //User Id
                                        $inserCnt1data[$i]['clientId'] = $client1_insert_id; //Client Id
                                        $contact1RandomId = "contact-".rand ( 10000 , 99999 );
                                        $inserCnt1data[$i]['contactRandomId'] = $contact1RandomId; //contactRandomId
                                        $inserCnt1data[$i]['contactType'] = 1; //Type
                                        $contact1_result = $this->db->insert('amp_contact', $inserCnt1data[$i]); 
                                        $contact1_insert_id = $this->db->insert_id();

                                        $inserPCnt1data[$i]['userID'] = $userid; //User Id
                                        $inserPCnt1data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCnt1data[$i]['contactId'] = $contact1_insert_id; //contact Id
                                        $this->db->insert('amp_project_contact', $inserPCnt1data[$i]); 
                                    }



                                    //Client 2 and his contact
                                    $client2_insert_id = 0;
                                    if($value['AD'] != "" || $value['AD'] != NULL){
                                        $inserCl2data[$i]['userID'] = $userid; //User Id
                                        $inserCl2data[$i]['client_name'] = $value['AD']; //Client Name
                                        $client2_result = $this->db->insert('amp_clients', $inserCl2data[$i]); 
                                        $client2_insert_id = $this->db->insert_id();

                                        $inserPCl2data[$i]['userID'] = $userid; //User Id
                                        $inserPCl2data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCl2data[$i]['clientId'] = $client2_insert_id; //client Id
                                        $inserPCl2data[$i]['clientType'] = 1; //Type
                                        $this->db->insert('amp_project_clients', $inserPCl2data[$i]); 
                                    }

                                    if($value['AI'] != "" || $value['AI'] != NULL){
                                        $inserCnt2data[$i]['contact_name'] = $value['AI'];
                                    }

                                    if($value['AO'] != "" || $value['AO'] != NULL){
                                        $inserCnt2data[$i]['contact_email'] = $value['AO'];
                                    }

                                    if($value['AP'] != "" || $value['AP'] != NULL){
                                        $inserCnt2data[$i]['contact_phone'] = $value['AP'];
                                    }

                            

                                    if(!empty($inserCnt2data[$i])){
                                        
                                        $inserCnt2data[$i]['userID'] = $userid; //User Id
                                        $inserCnt2data[$i]['clientId'] = $client2_insert_id; //Client Id
                                        $contact2RandomId = "contact-".rand ( 10000 , 99999 );
                                        $inserCnt2data[$i]['contactRandomId'] = $contact2RandomId; //contactRandomId
                                        $inserCnt2data[$i]['contactType'] = 1; //Type
                                        $contact2_result = $this->db->insert('amp_contact', $inserCnt2data[$i]); 
                                        $contact2_insert_id = $this->db->insert_id();

                                        $inserPCnt2data[$i]['userID'] = $userid; //User Id
                                        $inserPCnt2data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCnt2data[$i]['contactId'] = $contact2_insert_id; //contact Id
                                        $this->db->insert('amp_project_contact', $inserPCnt2data[$i]);
                                    }
                            


                                    //Client 3 and his contact
                                    $client3_insert_id = 0;
                                    if($value['AE'] != "" || $value['AE'] != NULL){
                                        $inserCl3data[$i]['userID'] = $userid; //User Id
                                        $inserCl3data[$i]['client_name'] = $value['AE']; //Client Name
                                        $client3_result = $this->db->insert('amp_clients', $inserCl3data[$i]); 
                                        $client3_insert_id = $this->db->insert_id();

                                        $inserPCl3data[$i]['userID'] = $userid; //User Id
                                        $inserPCl3data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCl3data[$i]['clientId'] = $client3_insert_id; //client Id
                                        $inserPCl3data[$i]['clientType'] = 1; //Type
                                        $this->db->insert('amp_project_clients', $inserPCl3data[$i]); 
                                    }

                                    if($value['AJ'] != "" || $value['AJ'] != NULL){
                                        $inserCnt3data[$i]['contact_name'] = $value['AJ'];
                                    }

                                    if($value['AQ'] != "" || $value['AQ'] != NULL){
                                        $inserCnt3data[$i]['contact_email'] = $value['AQ'];
                                    }

                                    if($value['AR'] != "" || $value['AR'] != NULL){
                                        $inserCnt3data[$i]['contact_phone'] = $value['AR'];
                                    }

                            
                                    if(!empty($inserCnt3data[$i])){
                                        $inserCnt3data[$i]['userID'] = $userid; //User Id
                                        $inserCnt3data[$i]['clientId'] = $client3_insert_id; //Client Id
                                        $contact3RandomId = "contact-".rand ( 10000 , 99999 );
                                        $inserCnt3data[$i]['contactRandomId'] = $contact3RandomId; //contactRandomId
                                        $inserCnt3data[$i]['contactType'] = 1; //Type
                                        $contact3_result = $this->db->insert('amp_contact', $inserCnt3data[$i]); 
                                        $contact3_insert_id = $this->db->insert_id();

                                        $inserPCnt3data[$i]['userID'] = $userid; //User Id
                                        $inserPCnt3data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCnt3data[$i]['contactId'] = $contact3_insert_id; //contact Id
                                        $this->db->insert('amp_project_contact', $inserPCnt3data[$i]);
                                    }




                                    //Client 4 and his contact
                                    $client4_insert_id = 0;
                                    if($value['AF'] != "" || $value['AF'] != NULL){
                                        $inserCl4data[$i]['userID'] = $userid; //User Id
                                        $inserCl4data[$i]['client_name'] = $value['AF']; //Client Name
                                        $client4_result = $this->db->insert('amp_clients', $inserCl4data[$i]); 
                                        $client4_insert_id = $this->db->insert_id();

                                        $inserPCl4data[$i]['userID'] = $userid; //User Id
                                        $inserPCl4data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCl4data[$i]['clientId'] = $client4_insert_id; //client Id
                                        $inserPCl4data[$i]['clientType'] = 1; //Type
                                        $this->db->insert('amp_project_clients', $inserPCl4data[$i]); 
                                    }

                                    if($value['AK'] != "" || $value['AK'] != NULL){
                                        $inserCnt4data[$i]['contact_name'] = $value['AK'];
                                    }

                                    if($value['AS'] != "" || $value['AS'] != NULL){
                                        $inserCnt4data[$i]['contact_email'] = $value['AS'];
                                    }

                                    if($value['AT'] != "" || $value['AT'] != NULL){
                                        $inserCnt4data[$i]['contact_phone'] = $value['AT'];
                                    }
                                    
                                    if(!empty($inserCnt4data[$i])){
                                        $inserCnt4data[$i]['userID'] = $userid; //User Id
                                        $inserCnt4data[$i]['clientId'] = $client4_insert_id; //Client Id
                                        $contact4RandomId = "contact-".rand ( 10000 , 99999 );
                                        $inserCnt4data[$i]['contactRandomId'] = $contact4RandomId; //contactRandomId
                                        $inserCnt4data[$i]['contactType'] = 1; //Type
                                        $contact4_result = $this->db->insert('amp_contact', $inserCnt4data[$i]); 
                                        $contact4_insert_id = $this->db->insert_id();

                                        $inserPCnt4data[$i]['userID'] = $userid; //User Id
                                        $inserPCnt4data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCnt4data[$i]['contactId'] = $contact4_insert_id; //contact Id
                                        //print_r($inserPCnt4data);
                                        $this->db->insert('amp_project_contact', $inserPCnt4data[$i]);
                                    }

                                    //Client 5 and his contact
                                    $client5_insert_id = 0;
                                    if($value['AG'] != "" || $value['AG'] != NULL){
                                        $inserCl5data[$i]['userID'] = $userid; //User Id
                                        $inserCl5data[$i]['client_name'] = $value['AG']; //Client Name
                                        $client5_result = $this->db->insert('amp_clients', $inserCl5data[$i]); 
                                        $client5_insert_id = $this->db->insert_id();

                                        $inserPCl5data[$i]['userID'] = $userid; //User Id
                                        $inserPCl5data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCl5data[$i]['clientId'] = $client5_insert_id; //client Id
                                        $inserPCl5data[$i]['clientType'] = 1; //Type
                                        //print_r($inserPCl5data);
                                        $this->db->insert('amp_project_clients', $inserPCl5data[$i]); 
                                    }

                                    if($value['AL'] != "" || $value['AL'] != NULL){
                                        $inserCnt5data[$i]['contact_name'] = $value['AL'];
                                    }

                                    if(!empty($inserCnt5data[$i])){
                                        $inserCnt5data[$i]['userID'] = $userid; //User Id
                                        $inserCnt5data[$i]['clientId'] = $client5_insert_id; //Client Id
                                        $contact5RandomId = "contact-".rand ( 10000 , 99999 );
                                        $inserCnt5data[$i]['contactRandomId'] = $contact5RandomId; //contactRandomId
                                        $inserCnt5data[$i]['contactType'] = 1; //Type
                                        $contact5_result = $this->db->insert('amp_contact', $inserCnt5data[$i]); 
                                        $contact5_insert_id = $this->db->insert_id();

                                        $inserPCnt5data[$i]['userID'] = $userid; //User Id
                                        $inserPCnt5data[$i]['projectId'] = $insert_id; //Project Id
                                        $inserPCnt5data[$i]['contactId'] = $contact5_insert_id; //contact Id
                                        //print_r($inserPCnt4data);
                                        $this->db->insert('amp_project_contact', $inserPCnt5data[$i]);
                                    }

                                    $temp = 1;
                                }
                                //End Import Data in client and contact table
                                $i++;
                            }
                        }
                    }
                    // if(!empty($inserdata)){
                    //     $result = $this->db->insert_batch('amp_projects', $inserdata); 
                    //     if($result){
                    //         $respnose['status'] = true;
                    //     }else{
                    //         $respnose['status'] = false;
                    //     }
                    // }else{
                    //      $respnose['status'] = false;
                    // }

                    if($temp == 1){
                        $respnose['status'] = true;
                    }else{
                        $respnose['status'] = false;
                    }
                    
                    echo json_encode($respnose);die;    
                }catch (Exception $e) {
                   // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                   //          . '": ' .$e->getMessage());
                    $respnose['status'] = false;
                    echo json_encode($respnose);die;  
                }
              }else{
                $respnose['status'] = false;
                echo json_encode($respnose);die;  
            }
        } 
      }




    function ExcelToPHP($dateValue = 0, $ExcelBaseDate=0) {
        if ($ExcelBaseDate == 0) {
            $myExcelBaseDate = 25569;
            //  Adjust for the spurious 29-Feb-1900 (Day 60)
            if ($dateValue < 60) {
                --$myExcelBaseDate;
            }
        } else {
            $myExcelBaseDate = 24107;
        }

        // Perform conversion
        if ($dateValue >= 1) {
            $utcDays = $dateValue - $myExcelBaseDate;
            $returnValue = round($utcDays * 86400);
            if (($returnValue <= PHP_INT_MAX) && ($returnValue >= -PHP_INT_MAX)) {
                $returnValue = (integer) $returnValue;
            }
        } else {
            $hours = round($dateValue * 24);
            $mins = round($dateValue * 1440) - round($hours * 60);
            $secs = round($dateValue * 86400) - round($hours * 3600) - round($mins * 60);
            $returnValue = (integer) gmmktime($hours, $mins, $secs);
        }

        // Return
        return $returnValue;
    }

}
