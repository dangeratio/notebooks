<?php
App::uses('AppController', 'Controller');
/**
 * Notebooks Controller
 *
 * @property Notebook $Notebook
 * @property PaginatorComponent $Paginator
 */
class NotebooksController extends AppController {

	var $helper=array('Javascript','Html','Form','TinyMCE' /*...etc...*/);

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	// public active variables

	public $activeNotebook = '';
	public $activeNote = '';

	var $name = 'Notebooks';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Notebook->recursive = 0;
		$this->set('notebooks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notebook->exists($id)) {
			throw new NotFoundException(__('Invalid notebook'));
		}
		$options = array('conditions' => array('Notebook.' . $this->Notebook->primaryKey => $id));
		$this->set('notebook', $this->Notebook->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Notebook->create();
			if ($this->Notebook->save($this->request->data)) {
				$this->Session->setFlash(__('The notebook has been saved.'));
				return $this->redirect(array('controller'=>'notebooks', 'action' => 'dashboard'));
			} else {
				$this->Session->setFlash(__('The notebook could not be saved. Please, try again.'));
			}
		}
		$groups = $this->Notebook->Group->find('list');
		$this->set(compact('groups'));

		// clear selected note
		$this->Session->write('Active.NoteId', '');

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Notebook->exists($id)) {
			throw new NotFoundException(__('Invalid notebook'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Notebook->save($this->request->data)) {
				$this->Session->setFlash(__('The notebook has been saved.'));
				return $this->redirect(array('controler' => 'notebooks', 'action' => 'dashboard'));
			} else {
				$this->Session->setFlash(__('The notebook could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notebook.' . $this->Notebook->primaryKey => $id));
			$this->request->data = $this->Notebook->find('first', $options);
		}
		$groups = $this->Notebook->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Notebook->id = $id;
		if (!$this->Notebook->exists()) {
			throw new NotFoundException(__('Invalid notebook'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Notebook->delete()) {
			$this->Session->setFlash(__('The notebook has been deleted.'));
		} else {
			$this->Session->setFlash(__('The notebook could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	/**
	*
	* Dashboard
	*
	**/


	public function dashboard($activeGroupId = '', $activeNotebookId = '') {

		//$this->layout = 'ajax';

		if ( $this->Session->read('Active.GroupId') == '' ) {
			$this->Session->write('Active.GroupId', 0);
		}

		// groups
		$this->loadModel('Group');
		$this->set('_groups', $this->Group->query("SELECT id, title FROM `groups` WHERE 1;"));

		//var_dump($groups);

		// notebooks
		$this->loadModel('Notebook');
		$this->set('_notebooks', $this->Notebook->query("SELECT * FROM `notebooks` WHERE 1;"));

		// notes
		$this->loadModel('Note');
		$this->set('_notes', $this->Note->query("SELECT * FROM `notes` WHERE 1;"));

		// for adding notes drop down menu
		$notebooks = $this->Note->Notebook->find('list');
		$this->set(compact('notebooks'));

		// for editing notes
		if ( $this->Session->read('Active.NoteId') != '' ) {
			$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $this->Session->read('Active.NoteId') ));
			$this->request->data = $this->Note->find('first', $options);
		}

	}

	public function getNotebooksByGroupId($groupid) {

		$this->loadModel('Notebook');
		if ($groupid = '') {
			return $this->Notebook->findAllByGroupId(0);
		} else {
			return $this->Notebook->findAllByGroupId($groupid);
		}

	}

	public function selectBoth($groupid, $notebookid) {
		$this->Session->write('Active.GroupId', $groupid);
		$this->Session->write('Active.NotebookId', $notebookid);
		return $this->redirect(array('action' => 'dashboard'));
	}

	public function selectGroup($groupid) {
		$this->Session->write('Active.GroupId', $groupid);
		return $this->redirect(array('action' => 'dashboard'));
	}

	public function selectNotebook($notebookid) {
		$this->Session->write('Active.NotebookId', $notebookid);
		$this->Session->write('Active.NoteId', '');
		return $this->redirect(array('action' => 'dashboard'));
	}

	public function selectNote($noteid) {
		$this->Session->write('Active.NoteId', $noteid);
		$this->Session->write('Active.noteFlag', 'edit');
		return $this->redirect(array('action' => 'dashboard'));
	}

	public function newNote() {
		$this->Session->write('Active.NoteId', '');
		$this->Session->write('Active.noteFlag', 'add');
		return $this->redirect(array('action' => 'dashboard'));
	}

	public function editNote($noteid) {
		$this->Session->write('Active.noteFlag', 'edit');
		$this->Session->write('Active.NoteId', $noteid);
		return $this->redirect(array('action' => 'dashboard'));
	}


}
