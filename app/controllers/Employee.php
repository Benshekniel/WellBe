<?php

class Employee extends Controller
{
   public function index()
   {
      $labTech = new Lab();
      $data['labTechs'] = $labTech->getAllLabTechs(); 
      $this->view('employee', '', $data);
   }

   public function employeeProfile()
   {
      $nic = $_GET['nic'] ?? null; // Fetch NIC from query string

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $action = $_POST['action'] ?? null;

         if ($action === 'delete') {
            // Handle delete action
            if ($nic) {
               $labTech = new Lab();

               if ($labTech->deleteLabTech($nic)) {
                  echo "<script>
                     alert('Lab Technician profile deleted successfully!');
                     window.location.href = '" . ROOT . "/Employee/labTechs';
               </script>";
               } else {
                  echo "<script>
                     alert('Lab Technician profile deleted successfully!');
               </script>";
               }
            }
         } else if ($action === 'update') {
            // Handle update logic
            $labTechData = $_POST;

            // Instantiate the Doctor model
            $labTech = new Lab();

            // Debugging: Check submitted data
            //echo(print_r($doctorData, true));

            // Validate the input data
            if ($labTech->validateLabTech($labTechData)) {
               if ($labTech->updateLabTech($labTechData, $nic)) {
                  echo "<script>
                        alert('Lab Technician Profile Updated Successfully!');
                        window.location.href = '" . ROOT . "/Employee/labTechs';
                  </script>";
               } else {
                  echo "<script>
                        alert('Lab Technician Profile Updated Successfully!');
                  </script>";
               }
            } else {
               // Retrieve validation errors
               $data['errors'] = $labTech->getErrors();
            }

            // Reload doctor profile after submission
            $data['labTechProfile'] = $labTech->getLabTechById($nic);
         }
      } elseif ($nic) {
         // Fetch doctor profile for the given NIC
         $labTech = new Lab();
         $data['labTechProfile'] = $labTech->getLabTechById($nic);

         if (empty($data['labTechProfile'])) {
            $data['error'] = "Lab Technician with NIC $nic not found.";
         }
      } else {
         $data['error'] = "No lab technician NIC provided.";
      }

      $this->view('employeeProfile', 'Lab Technicians', $data); // Pass data to the view
   }

   public function search(){
      $data = [];

		$user = new User;
		$arr = [];
		$arr['find'] = $_GET['find'] ?? null;

		if($arr['find'])
		{
			$arr['find'] = "%".$arr['find']."%";
			$data['rows'] = $user->query("SELECT * FROM lab_technician where first_name like :find", $arr);

		}

      $this->view('search', '', $data); // Pass data to the view
   }

}
