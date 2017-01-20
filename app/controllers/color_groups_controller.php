<?php
class ColorGroupsController extends AppController {

	var $name = 'ColorGroups';

	function admin_index() {
		$this->ColorGroup->recursive = 0;
		$this->set('colorGroups', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid color group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('colorGroup', $this->ColorGroup->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ColorGroup->create();
			if ($this->ColorGroup->save($this->data)) {
				$this->Session->setFlash(__('The color group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The color group could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid color group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ColorGroup->save($this->data)) {
				$this->Session->setFlash(__('The color group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The color group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ColorGroup->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for color group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ColorGroup->delete($id)) {
			$this->Session->setFlash(__('Color group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Color group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
