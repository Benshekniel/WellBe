<?php

class exportModel extends Model
{
   public function exper($id)
   {
      $query = "SELECT join_date FROM pharmacist WHERE id = ?";
      $result = $this->read($query, [$id]);
      return $result ? $result : null; // Return null if no record found
   }

   public function getAll()
   {
      return $this->read("SELECT mr.*, d.first_name,d.last_name,t.date as date_t, p.first_name as p_first_name, p.last_name as p_last_name FROM medication_requests mr, timeslot t, doctor d, patient p where mr.date = t.slot_id AND mr.doctor_id = d.id AND p.id = mr.patient_id");
   }
   public function upchange($state)
   {
      return $this->query("update test_request_details set state = ? where id = 101", [$state]);
   }
}
