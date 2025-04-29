<?php


class export extends Controller
{

	public function index()
	{

		$color = $_POST['selectedColor'];
		echo $color;
		$str = "1234512345a";

		if (preg_match('/[a-zA-Z]/', $str)) {
			echo "contains a alphabet";
		} else {
			echo "does not contain any alphabet";
		}

		$var=substr($str,0,4);
		$str = "2345262345234523";
		echo ("<br>".substr($str, 0 , 4));
		$date=date("Y");
		$example = new exportModel();

		$id = $_POST['id']; 

		$year = $example->exper($id); 
		$joinDate = $year[0]['join_date']; 

		$currentDate = date('Y-m-d'); 

		$date1 = new DateTime($currentDate);
		$date2 = new DateTime($joinDate);

		$difference = $date1->diff($date2);

		$data['exper'] = [
			'year' => $difference->y 
		];

		$this->view('Pharmacy/example');

		$requests = $example->getAll();
		  $progress = array_filter($requests, function ($request) {
		      return $request['state'] == 'progress';
		  });

		  $data = [
		      'progress' => array_values($progress)
		  ];

		$name = "2345346234a";
		if(strpos($name, 'a')){
			echo"there";
		}else {
			echo "not there";
		}

		$state = $_POST['state'];
		$example->upchange($state);

		
		$str = "Benshekneil";
		echo str_contains($str, 'e');
		
		echo substr($str, 0, 4);
		strtolower($str);
		echo strlen($str);
		
		echo trim("Benshekneil99");
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$ageChecked = isset($_POST['age']) ? 1 : 0;
			$nameChecked = isset($_POST['name']) ? 1 : 0;
			$addressChecked = isset($_POST['address']) ? 1 : 0;
		
			// Now you can use these variables
			echo "Age selected: " . $ageChecked . "<br>";
			echo "Name selected: " . $nameChecked . "<br>";
			echo "Address selected: " . $addressChecked . "<br>";
		}
		$this->view('Pharmacy/example');
	}
}
