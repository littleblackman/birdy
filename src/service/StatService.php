<?php

namespace Etsik\Service;

use Birdy\Model\Manager\SessionManager;

class StatService{

    private $sessionManager;

    public function __construct() {
        $this->sessionManager = new SessionManager();
    }

    public function getStudentPresenceList($classrommId) {

        if(!$presencesCheckPoints = $this->sessionManager->getPresencesCheckPoints($classrommId)) return null;

        foreach($presencesCheckPoints as $checkpoint) {

            $student = ['id' => $checkpoint['user_id'], 'firstname' => $checkpoint['firstname'], 'lastname' => $checkpoint['lastname']];
            $studentLists[$checkpoint['session_id']][$checkpoint['status']][] = $student;
            $studentLists[$checkpoint['session_id']]['sessionInfo'] = ['session_id' => $checkpoint['session_id'], 'date' => $checkpoint['date'], 'start' => $checkpoint['start']];
        }

        foreach($studentLists as $key => $elements) {
            ksort($elements);
            $arr[$key] = $elements;
        }

        return $arr;

    }

}