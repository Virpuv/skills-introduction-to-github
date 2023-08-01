<?php

    $start = microtime(true);
    $curl = curl_init('https://student.bntu.by/api/getfaculty?faculty=МИДО');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($response);

    $counter = 0;
    $students = array();
    foreach ($json as &$value) {
        if ($value->study_status == 'Учится' and $value->study_course == '1') {
            $students[$counter] = new Student($value->group_number, $value->zachet_number, 
                                            $value->lastname, $value->firstname, $value->patronymic, $value->starosta, $value->phones, $value->email);
            $counter++;  
        }
    }

    class Student {

        public $group_number, $zachet_number, $lastname, $firstname, $patronymic, $starosta, $phones, $email;

        function __construct($group_number, $zachet_number, $lastname, $firstname, $patronymic, $starosta, $phones, $email) {
            $this->group_number = $group_number;
            $this->zachet_number = $zachet_number;
            $this->lastname = $lastname;
            $this->firstname = $firstname;
            $this->patronymic = $patronymic;
            $this->starosta = $starosta;
            $this->phones = $phones;
            $this->email = $email;
        }
    } 

    echo '<p>Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.</p>';

?>