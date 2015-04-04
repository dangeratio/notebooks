<?php
App::uses('Notebook', 'Model');

/**
 * Notebook Test Case
 *
 */
class NotebookTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notebook',
		'app.group',
		'app.note'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notebook = ClassRegistry::init('Notebook');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notebook);

		parent::tearDown();
	}

}
