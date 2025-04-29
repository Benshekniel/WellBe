<?php

class Contact extends Controller
{
   public function index()
   {
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         $phone = $_POST['phone'];
         $email = $_POST['email'];
         $text = $_POST['text'];
         $ContactModel = new ContactModel();

         $data = [
            'phone' => $phone,
            'email' => $email,
            'text' => $text
         ];
         $contact = $ContactModel->add($data);
         if ($contact) {
            echo "<script>alert('successfuly inserted!')</script>";
         } else {
            echo "<script>alert('un-successfuly inserted!')</script>";
         }

         redirect('landing');
      }


      $this->view('contact');
   }
}
