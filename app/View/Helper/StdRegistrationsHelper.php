<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StdRegistrations
 *
 * @author vijay
 */
class StdRegistrationsHelper extends AppHelper {

    //put your code here

    public $uses = array('StudentRegistration', 'StudentAlotment', 'University', 'Country', 'State', 'City', 'StudentGrade', 'StudentSubjects', 'StudentPreferedCollege', 'StudentAmendment');
    public $components = array('Email');

    function initialize(&$controller) {
        //load required for component models
        if ($this->uses !== false) {

            foreach ($this->uses as $modelClass) {

                $controller->loadModel($modelClass);

                $this->$modelClass = $controller->$modelClass;
            }
        }
    }

    function getuniversity($university_id) {

        $Universitydetails = ClassRegistry::init('University');
        $universityname = $Universitydetails->find('first', array(
            'fields' => array('name'), 'conditions' => array('University.id' => $university_id)
        ));

        return $universityname['University']['name'];
    }

    function getlastadmper($college_id, $allocyear) {

        $StudentAlotment = array();
        $studentRegistrationID = '';
        $Studentdetails = array();
        $Studentperce = array();

        $StudentAlotmentdetailss = ClassRegistry::init('StudentAlotment');
        $StudentAlotment = $StudentAlotmentdetailss->find('first', array(
            'fields' => array('student_registration_id'), 'conditions' => array('StudentAlotment.college_id' => $college_id, 'StudentAlotment.allocation_year' => $allocyear), 'order' => array('StudentAlotment.grade DESC'), 'limit' => 1
        ));

        if (!empty($StudentAlotment['StudentAlotment']['student_registration_id'])) {
            $studentRegistrationID = $StudentAlotment['StudentAlotment']['student_registration_id'];

            $Studentdetails = ClassRegistry::init('StudentRegistration');
            $Studentperce = $Studentdetails->find('first', array(
                'fields' => array('total_percentage'), 'conditions' => array('StudentRegistration.id' => $studentRegistrationID)
            ));
        }
        if (!empty($Studentperce)) {

            return $Studentperce['StudentRegistration']['total_percentage'];
        }
        unset($studentRegistrationID);
    }

    function isallotted($regid) {


        $StudentAlotments = ClassRegistry::init('StudentAlotment');
        $StudentAlotment = $StudentAlotments->find('first', array(
            'fields' => array('student_registration_id'), 'conditions' => array('StudentAlotment.student_registration_id' => $regid)
        ));
        if (isset($StudentAlotment['StudentAlotment']['student_registration_id'])) {
            return true;
        } else {
            return false;
        }
    }

    function getpercentage($grades = null) {

        $AdminPreference = ClassRegistry::init('AdminPreference');
        $markslimit = 0;
        $markslimit = $AdminPreference->find('all', array('fields' => array('markslimit'), 'conditions' => array('year' => date('Y'))));
        if (!empty($markslimit)) {
            $markslimit = $markslimit[0]['AdminPreference']['markslimit'];
        }
        $lowerlimit = 0;
        //$this->loadModel('Gradepoint');
        $Gradepoint = ClassRegistry::init('Gradepoint');
        $gradeval = $Gradepoint->find('all', array('conditions' => array('year' => date('Y'))));

        $listgrade = array();

        foreach ($gradeval as $grade) {
            $listgrade[] = $grade['Gradepoint']['gradepoints'];
        }
        $marksfromgrade = array();
        $markspercentage = 0;

        if (in_array($grades, $listgrade)) {

            $marksfromgrade = $Gradepoint->find('first', array('fields' => array('lowerlimit'), 'conditions' => array('gradepoints' => $grades, 'year' => '2014')));

            if (!empty($marksfromgrade)) {
                $lowerlimit = $marksfromgrade['Gradepoint']['lowerlimit'];
            }


            $markspercentage = ($lowerlimit * $markslimit) / 100;
            $markspercentage = $markspercentage + $lowerlimit;

            return $markspercentage;
        } else {

            return false;
        }
    }

  /*  function getsummationspecialized($college_id, $allocyear) {

        $StudentAlotment = array();
        $studentRegistrationID = '';
        $Studentdata = array();
        $Studentpercentage = array();


        $StudentAlotmentdetails = ClassRegistry::init('StudentAlotment');
        $StudentAlotment = $StudentAlotmentdetails->find('first', array(
            'fields' => array('student_registration_id'), 'conditions' => array('StudentAlotment.college_id' => $college_id, 'StudentAlotment.allocation_year' => $allocyear), 'order' => array('StudentAlotment.grade DESC'), 'limit' => 1
        ));

        if (!empty($StudentAlotment['StudentAlotment']['student_registration_id'])) {
            $studentRegistrationID = $StudentAlotment['StudentAlotment']['student_registration_id'];

            $Studentdata = ClassRegistry::init('StudentRegistration');
            $Studentpercentage = $Studentdata->find('all', array(
                'fields' => array('total_percentage'), 'conditions' => array('StudentRegistration.id' => $studentRegistrationID)
            ));
        }//pr($Studentpercentage);die;
    }*/
    
    function getsummationspecialized($college_id, $allocyear){
        $StudentAlotmentdetails = ClassRegistry::init('StudentAlotment');
        $Studentpercentage = $StudentAlotmentdetails->query("SELECT SUM(MARKS) as totalsummarks FROM `student_subjects` WHERE subject_id IN ('1','10','15','16','6') and student_registration_id IN ( 
        SELECT c.id from student_registrations c where c.total_percentage IN (
        SELECT b.total_percentage from student_registrations as b where b.id IN (SELECT student_registration_id from student_alotments where college_id = $college_id And allocation_year = $allocyear) group by  b.total_percentage  having count(*)>1));");
    
        if(!empty($Studentpercentage[0][0]['totalsummarks'])){
            $totalmarkslist = $Studentpercentage[0][0]['totalsummarks'];
            
        }else{
            $totalmarkslist = 0;
        }
        return $totalmarkslist;
    }

}

?>