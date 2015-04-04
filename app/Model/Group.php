<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property Notebook $Notebook
 */
class Group extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Notebook' => array(
			'className' => 'Notebook',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function getGroups() {
		//$this->loadModel('Group');
		//return $this->Group->findAllByActive('1');
	}

	public function getNotebooksByGroup($groupid) {

	}

	public function getMainView($currentNotebook) {

	}

	public function getNotes($currentNotebook) {

	}



}
