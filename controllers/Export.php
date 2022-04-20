<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Export Controller
 *
 * @author Saurabh Kadam
 *
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH.'/libraries/BaseController.php';

class Export extends BaseController {

    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Export_model', 'export');
    }

     public function exportData() {


        // create file name
        $filename = 'data-'.time().'.xls';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Project list');
        // set Header
        $this->excel->getActiveSheet()->SetCellValue('A1', 'ProjectID');

        $this->excel->getActiveSheet()->SetCellValue('B1', 'Project Name');
        $this->excel->getActiveSheet()->SetCellValue('C1', 'Job #');
        $this->excel->getActiveSheet()->SetCellValue('D1', 'Company');

        $this->excel->getActiveSheet()->SetCellValue('E1', 'Bid Date');
        $this->excel->getActiveSheet()->SetCellValue('F1', 'Job Walk');
        $this->excel->getActiveSheet()->SetCellValue('G1', 'Bid Price');
        $this->excel->getActiveSheet()->SetCellValue('H1', 'Scope');
        $this->excel->getActiveSheet()->SetCellValue('I1', 'Date Added');
        $this->excel->getActiveSheet()->SetCellValue('J1', 'Rep');
        $this->excel->getActiveSheet()->SetCellValue('K1', 'Stage');
        $this->excel->getActiveSheet()->SetCellValue('L1', 'Phone No');
        $this->excel->getActiveSheet()->SetCellValue('M1', 'Email');

        $this->excel->getActiveSheet()->SetCellValue('N1', 'Address');

        $this->excel->getActiveSheet()->SetCellValue('O1', 'Notes');

        $this->excel->getActiveSheet()->SetCellValue('P1', 'Owenership');
        $this->excel->getActiveSheet()->SetCellValue('Q1', 'Business Owner');
        $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

        $this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

         $this->excel->getActiveSheet()->getStyle('C1:D1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('C1:D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1:D1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('C1:D1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('E1:F1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('E1:F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1:F1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('E1:F1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('G1:H1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('G1:H1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G1:H1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('G1:H1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('I1:J1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('I1:J1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('I1:J1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('I1:J1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('K1:L1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('K1:L1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('K1:L1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('K1:L1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('M1:N1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('M1:N1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('M1:N1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('M1:N1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('O1:P1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('O1:P1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('O1:P1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('O1:P1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('Q1:S1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('Q1:S1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('Q1:S1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('Q1:S1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));
        // set Row

        if(isset($this->session->userdata['getsheetInfo']) && !empty($this->session->userdata['getsheetInfo'])){
            $rowCount = 2;
            foreach ($this->session->userdata['getsheetInfo'] as $element) {

                $this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['projectId']);

                $this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['projectName']);

                $this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['filesystem_id']);

                $this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['company']);

                //$this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['contract']);

                $this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['dueDate']);

                $this->excel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['jobWalkTime']);

                $this->excel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['bid_price']);

                $this->excel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['scope']);
                $this->excel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['createdDtm']);
                $this->excel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['name']);
                $this->excel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['stageName']);
                $this->excel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['phoneNo1']);
                $this->excel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['email']);

                $this->excel->getActiveSheet()->SetCellValue('N' . $rowCount, $element['address']);

                $this->excel->getActiveSheet()->SetCellValue('O' . $rowCount, $element['notes']);

                $this->excel->getActiveSheet()->SetCellValue('P' . $rowCount, $element['ownership']);
                $this->excel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element['businessOwner']);


                $rowCount++;
            }
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
       }
       else{



                $empInfos = $this->export->projectList();
                $rowCount = 2;
                foreach ($empInfos as $element) {
                    $this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $element->projectId);

                    $this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->projectName);

                    $this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->filesystem_id);

                    $this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->company);



                    $this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->dueDate);

                    $this->excel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->jobWalkTime);

                    $this->excel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->bid_price);

                    $this->excel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->scope);
                    $this->excel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->createdDtm);
                    $this->excel->getActiveSheet()->SetCellValue('J' . $rowCount, $element->name);
                    $this->excel->getActiveSheet()->SetCellValue('K' . $rowCount, $element->stageName);
                    $this->excel->getActiveSheet()->SetCellValue('L' . $rowCount, $element->contact_phone);
                    $this->excel->getActiveSheet()->SetCellValue('M' . $rowCount, $element->contact_email);

                    $this->excel->getActiveSheet()->SetCellValue('N' . $rowCount, $element->address);

                    $this->excel->getActiveSheet()->SetCellValue('O' . $rowCount, $element->notes);

                    $this->excel->getActiveSheet()->SetCellValue('P' . $rowCount, $element->ownership);
                    $this->excel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element->businessOwner);
                    $rowCount++;
                }
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        }


            //force user to download the Excel file without writing it to server's HD
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            $objWriter->save('php://output');
            $this->session->unset_userdata('getsheetInfo');
            //$objWriter->save(FCPATH."assets/uploads/".$filename);
            redirect('projectListing');
    }

     // exportData
    public function exportCommunication() {

        // create file name
        $filename = 'data-'.time().'.xls';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Communication list');
        // set Header
        $this->excel->getActiveSheet()->SetCellValue('A1', 'ID');
        $this->excel->getActiveSheet()->SetCellValue('B1', 'Date/Time');
        $this->excel->getActiveSheet()->SetCellValue('C1', 'Type');
        $this->excel->getActiveSheet()->SetCellValue('D1', 'From');
        $this->excel->getActiveSheet()->SetCellValue('E1', 'To');
        $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

        $this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:B1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

         $this->excel->getActiveSheet()->getStyle('C1:D1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('C1:D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1:D1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('C1:D1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));

        $this->excel->getActiveSheet()->getStyle('E1:F1')->applyFromArray($styleArray);
        $this->excel->getActiveSheet()->getStyle('E1:F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1:F1')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('E1:F1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFF99'))));
        // set Row

        if(isset($this->session->userdata['getexcelsheetInfo']) && !empty($this->session->userdata['getexcelsheetInfo'])){
            $rowCount = 2;
            foreach ($this->session->userdata['getexcelsheetInfo'] as $element) {
                if($element['type']=='0'){
                    $type = 'Sms';
                }
                if($element['type']=='1'){
                    $type = 'Call';
                }
                if($element['type']=='2'){
                    $type = 'Email';
                }
                $this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['communicationId']);
                $this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['createdDtm']);
                $this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $type);
                $this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['froms']);
                $this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['to']);
                $rowCount++;
            }
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
       }
       else{

                $empInfos = $this->export->communicationList();
                $rowCount = 2;
                foreach ($empInfos as $element) {
                    if($element->type=='0'){
                        $type = 'Sms';
                    }
                    if($element->type=='1'){
                        $type = 'Call';
                    }
                    if($element->type=='2'){
                        $type = 'Email';
                    }
                    $this->excel->getActiveSheet()->SetCellValue('A' . $rowCount, $element->communicationId);
                    $this->excel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->createdDtm);
                    $this->excel->getActiveSheet()->SetCellValue('C' . $rowCount, $type);
                    $this->excel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->froms);
                    $this->excel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->to);
                    $rowCount++;
                }
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        }




            //force user to download the Excel file without writing it to server's HD
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            $objWriter->save('php://output');
            $this->session->unset_userdata('getexcelsheetInfo');
            //$objWriter->save(FCPATH."assets/uploads/".$filename);
            redirect('projectListing');
    }

}
?>