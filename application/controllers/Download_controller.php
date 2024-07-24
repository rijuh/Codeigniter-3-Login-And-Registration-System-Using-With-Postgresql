<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Download_controller extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model("Dashboard_model");
    }

    public function download_pdf($id)
    {
        $data['user_profile'] = $this->Dashboard_model->get_user_by_id($id);
        $data['user_education'] = $this->Dashboard_model->get_education($id);
        $html = $this->load->view('New_pdf_view', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('dashboard.pdf', 'D');
    }
    
    public function download_excel($level)
    {
        // Fetch data for the dashboard
        $data = $this->Dashboard_model->get_userlist_by_level($level);

        // Check if data is fetched correctly
        if (empty($data)) {
            die('No data available to export.'); // For debugging, replace with proper error handling in production
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Merge cells from B1 to J1
        $sheet->mergeCells('B1:J1');

        // Set the value for the merged cell
        $sheet->setCellValue('B1', 'All '.$level.' List');

        // Apply some styling to the merged cell (optional)
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set column headers
        $sheet->setCellValue('B2', 'SL NO');
        $sheet->setCellValue('C2', 'ID');
        $sheet->setCellValue('D2', 'NAME');
        $sheet->setCellValue('E2', 'EMAIL ID');
        $sheet->setCellValue('F2', 'MOBILE NO');
        $sheet->setCellValue('G2', 'DOB');
        $sheet->setCellValue('H2', 'AGE');
        $sheet->setCellValue('I2', 'GENDER');
        $sheet->setCellValue('J2', 'LEVEL');
        // Add more headers as needed

        // Add data to the sheet
        $row = 3;
        foreach ($data as $rowData) {
            $sheet->setCellValue('B' . $row, $row - 2); // SL NO
            $sheet->setCellValue('C' . $row, $rowData['id']); // Ensure these keys exist
            $sheet->setCellValue('D' . $row, $rowData['name']); // Ensure these keys exist
            $sheet->setCellValue('E' . $row, $rowData['emailid']); // Ensure these keys exist
            $sheet->setCellValue('F' . $row, $rowData['mobileno']); // Ensure these keys exist
            $sheet->setCellValue('G' . $row, $rowData['dob']); // Ensure these keys exist
            $sheet->setCellValue('H' . $row, $rowData['age']); // Ensure these keys exist
            $sheet->setCellValue('I' . $row, $rowData['gender']); // Ensure these keys exist
            $sheet->setCellValue('J' . $row, $rowData['level']); // Ensure these keys exist
            // Add more columns as needed
            $row++;
        }

        // Create a Writer instance and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = 'dashboard_data.xlsx';

        // Clean output buffer to prevent unwanted output
        if (ob_get_length()) {
            ob_end_clean();
        }

        // Set headers to prompt download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save the file to output
        $writer->save('php://output');
        exit;
    }
}