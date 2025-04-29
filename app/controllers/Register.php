<?php 

class Register extends Controller{
   public function index()
   {
      $data = [];

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $labTech = new Lab();
         $labTechData = $_POST;

         // Validate step 1 fields
         if ($labTech->formValidate($labTechData)) {
            if ($labTech->addLabTech($labTechData)) {
               echo "<script>
                     alert('Lab Technician Profile Created Successfully!');
                     window.location.href = '" . ROOT . "/Admin/labTechs';
               </script>";
               unset($_SESSION['labTech_data']); 
               exit;
            } else {
               echo "<script>alert('Lab Technician Profile Created Successfully!');</script>";
            }
         } 
         else {
            // Add validation errors to data array
            $data['errors'] = $labTech->getErrors();
            $data['formData'] = $labTechData; // Pass submitted data back to the view
         }
      }

      $this->view('register', '', $data ?? []);
   }
}