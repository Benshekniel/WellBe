<?php

class LabModel extends Model
{
   protected $table = 'lab_technician';

   protected $allowedColumns = [
      'nic',
      'password',
   ];

   public function validate($data)
   {
      $this->errors = [];

      if (empty($data['nic'])) {
         $this->errors['nic'] = "Username is required";
      }

      if (empty($data['password'])) {
         $this->errors['password'] = "Password is required";
      }

      return empty($this->errors);
   }

   public function getRequestsByDay()
   {
      $query = "
        SELECT 
            DAYNAME(date) as day, 
            COUNT(*) as count
        FROM test_requests
        WHERE date >= NOW() - INTERVAL 7 DAY
        GROUP BY DAYNAME(date)
        ORDER BY FIELD(DAYNAME(date), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
    ";

      $results = $this->read($query);
      $days = ['Monday' => 0, 'Tuesday' => 0, 'Wednesday' => 0, 'Thursday' => 0, 'Friday' => 0, 'Saturday' => 0, 'Sunday' => 0];

      foreach ($results as $row) {
         $days[$row['day']] = (int)$row['count'];
      }

      return array_values($days);
   }

   public function getRequestCounts()
   {
      $query = "
           SELECT state, COUNT(*) as count 
           FROM test_requests 
           WHERE date >= NOW() - INTERVAL 14 DAY
           GROUP BY state
       ";

      $results = $this->read($query);
      $response = [
         'pending' => 0,
         'ongoing' => 0,
         'completed' => 0,
      ];

      foreach ($results as $row) {
         if (isset($response[$row['state']])) {
            $response[$row['state']] = (int)$row['count'];
         }
      }

      return $response;
   }

   public function getTestRequests()
   {
      $query = "SELECT patient_id, state 
                  FROM test_requests 
                  WHERE state IN ('ongoing', 'pending') 
                  ORDER BY FIELD(state, 'ongoing', 'pending') 
                  LIMIT 20";

      return $this->query($query);
   }

   public function fetchNewMessages($sender)
   {
      $receiverQuery = "SELECT id FROM user_profile WHERE role = 3";
      $receivers = $this->query($receiverQuery);

      if (!$receivers) {
         return [];
      }

      $receiverIds = array_map(fn($r) => $r->id, $receivers);

      $placeholders = implode(',', array_fill(0, count($receiverIds), '?'));

      $messageQuery = "
           SELECT 
               a.first_name,
               MAX(m.date) AS last_message_date  
           FROM message m
           JOIN administrative_staff a ON m.sender = a.id
           WHERE m.receiver = ?  
             AND m.sender IN ($placeholders)  
             AND m.seen = 0 
             AND m.received = 1
           GROUP BY m.sender, a.first_name  
           ORDER BY last_message_date DESC
           LIMIT 20";

      $params = array_merge([$sender], $receiverIds);

      $messages = $this->readn($messageQuery, $params);

      return $messages !== false ? $messages : [];
   }
}