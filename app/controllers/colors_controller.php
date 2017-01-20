<?php
class ColorsController extends AppController {

	var $name = 'Colors';
	
	function index() {
		$this->set('colors', $this->Color->ColorGroup->find('all'));
	}
	
	function view($id) {
		
	}
	
	function admin_index() {
		$this->Color->recursive = 0;
		$this->set('colors', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid color', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('color', $this->Color->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Color->create();
			
			if(!empty($this->data['Color']['new_swatch'])) {
				$path = 'img/products/swatches/' .$this->data['Color']['new_swatch']['name'];
				if(!file_exists($path))	move_uploaded_file($this->data['Color']['new_swatch']['tmp_name'], $path );
				$this->data['Color']['swatch'] = $path;
			}
			if ($this->Color->save($this->data)) {
				$this->Session->setFlash(__('The color has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The color could not be saved. Please, try again.', true));
			}
		}
		
		$colorGroups = array('0' => '-') + $this->Color->ColorGroup->find('list');
		// array_unshift($colorGroups, array('0' => '-'));
		$this->set(compact('colorGroups'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid color', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if(!empty($this->data['Color']['new_swatch'])) {
				$path = 'img/products/swatches/' .$this->data['Color']['new_swatch']['name'];
				if(!file_exists($path))	move_uploaded_file($this->data['Color']['new_swatch']['tmp_name'], $path );
				$this->data['Color']['swatch'] = $path;
			}
			if ($this->Color->save($this->data)) {
				$this->Session->setFlash(__('The color has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The color could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $color = $this->Color->read(null, $id);
			$this->set('color', $color);
			
		}
		$colorGroups = array('0' => '-') + $this->Color->ColorGroup->find('list');

		$this->set(compact('colorGroups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for color', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Color->delete($id)) {
			$this->Session->setFlash(__('Color deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Color was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
