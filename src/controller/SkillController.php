<?php

namespace Birdy\Controller;

use Birdy\Model\Entity\Skill;
use Birdy\Model\Manager\SkillManager;
use Etsik\Core\Controller;

class SkillController extends Controller
{

    private $skillManager;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->skillManager = new SkillManager();
    }

    
    public function create() {

        $skillName = $this->request->get('skillName');
        $sessionId = $this->request->get('sessionId');
        $skill = new Skill();
        $skill->setSessionId($sessionId);
        $skill->setName($skillName);

        $skill = $skill->save();

        return $this->renderJson($skill->toArray());
    } 

    public function delete() {

        $id = $this->request->get('skillId');
        $skill = $this->skillManager->find($id);
        $skill->delete();
        return $this->renderJson($id);
    }

    public function addCriteria() {
        $skill = $this->skillManager->find($this->request->get('currentSkillId'));
        $skill->setCriteriasId($this->request->get('currentCriteriaId'));
        $skill = $skill->save();
        return $this->renderJson($skill->toArray());

    }
}