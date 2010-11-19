<?php
App::import('Sanitize');

class PhpropsController extends PhpropAppController {

	var $name = 'Phprops';
	var $uses = array();
	var $helpers = array (
		'Javascript'
	);
	var $debugProps = false; // use a mock object instead real json encoded data
	var $propsFileName = null;
	var $language=null;
	
	function beforeFilter(){
		$this->propsFileName = TMP . 'properties.json';
		$this->language = TMP . 'languages.json';
		
	}
	function idiomasactivos(){
		$file = new File($this->language);
		$filecontent = file_get_contents($this->language);
		$idiomas= json_decode($filecontent, true);
		foreach ($idiomas as $id=>$lang){
			if ($lang['active']==1){
				$activos[]=$lang;
			}
		}
		return $activos;
	}
	function index() {
		$props = $this->__readProps();
		$this->set('props', $props);
		
	}

	function edit($key = null, $htmlEditor = 0, $translatorEditor = 0) {
		//FIXME: para qu� sirve el id ??
		$this->set('id', '1');
		$prop = $this->__readProps($key);
		$this->set('key', $key);
		$this->set('htmlValue', $htmlEditor);
		$this->set('translatedValue', $translatorEditor);
		$this->set('values', $prop[$key]['values']);
		$idiomas=$this->idiomasactivos();
		$this->set('idiomas',$idiomas);
	}

	/**
	 * Updates existing key
	 */
	function update($key) {
//TODO $key = Sanitize :: clean($key);
		if ($this->params['form']) {
			// form processing (save)
			$prop = $this->__readProps();
			if (!empty ($prop)) {
				// updating the prop
				$prop[$key]['values'] = $this->params['form'];	
						
				$props = $this->__saveProps($prop);

			}
		}
	}

	/**
	 * Adds a new key with config
	 */
var $validate = array(
    'key' => array(
        'rule' => array('custom', '/^[a-z0-9]{3,}$/i'),  
        'message' => 'Sólo letras y enteros, mínimo 3 caracteres'
    )
);
	function add() {
		if ($this->data) {
			
			$newKey = $this->data['Phprop']['key'];
			$isHTML = $this->data['Phprop']['isHTML'];
			$isTranslated = $this->data['Phprop']['isTranslated'];
			$defaultValue = $this->data['Phprop']['defaultValue'];
			
			$prop = $this->__readProps();
			if (@ !isset ($prop[$newKey])) {
				// saves the new key
				$this->__saveNewProp($newKey, $isHTML, $isTranslated, $defaultValue);
				$editURL = Router::url(array('action' => 'edit', $newKey, $isHTML, $isTranslated));
				$this->Session->setFlash("Key '$newKey' added, <a href='" . $editURL . "'> click here to edit the new key</a>");
			} else {
				//key exists, abort
				$this->Session->setFlash("Key '$newKey' is already defined, no key was added. Please type another key.");
			}

		
		}

	}
	function delete($key2=null) {
		$props = $this -> __readProps();
		
		foreach ($props as $key=>$prop){
			if ($key<>$key2){
				$aux[$key]=$prop;
				}
			}
		$this->__saveProps($aux);
		$this->Session->setFlash('Key has been deleted.');
		$this->redirect(array('action'=>'index'));
	}


	
	function __saveNewProp($newKey, $isHTML, $isTranslated, $defaultValue) {
		
		$prop = $this->__readProps();
		$prop[$newKey] = array (
			'isTranslated' => $isTranslated,
			'isHTML' => $isHTML,
			'values' => array ('default' => $defaultValue)
		);
		
		
		if ($isTranslated){
			$idiomas=$this->idiomasactivos();
			foreach ($idiomas as $id => $lang){
					$idioma= $lang['locale'];
					$prop[$newKey]['values'][$idioma]= "";
				
			}

			
		}
		$this->__saveProps($prop);
	}

	function __saveProps($props) {
		$fh = fopen($this->propsFileName, "w");
		fwrite($fh, json_encode($props));
		fclose($fh);
	}
	
	function __readProps($key = null) {
		if ($this->debugProps) {
			if (!$key) {
				return $this->__getMockData();
			} else {
				$allProps = $this->__getMockData();
				if (isset ($allProps[$key])) {
					return array (
						$key => $allProps[$key]
					);
				} else {
					die("Key '$key' is not defined.");
				}
			}

		} else {
			$file = new File($this->propsFileName);
			if (!$file->exists()){
				$file->create();
			}
			$filecontent = file_get_contents($this->propsFileName);
			$props = json_decode($filecontent, true);
			
			
			//debug($props);
			return $props;
		}
	}

	function __getMockData() {
		$props = array (
			'Nombre del Hotel' => array (
				'isTranslated' => 0,
				'isHTML' => 0,
				'values' => array (
					'default' => 'este es el nombre del hotel'
				)
			),
			'Key2' => array (
				'isTranslated' => 1,
				'isHTML' => 1,
				'values' => array (
					'default' => '<h1>Value en HTML</h2>',
					'es_ES' => '<h1>Valor en HTML</h1>',
					'de_DE' => '<h1>gut und g�nstig</h1>',
					'en_UK' => 'in english'
				)
			),
			'Key3' => array (
				'isTranslated' => 1,
				'isHTML' => 0,
				'values' => array (
					'default' => '<h1>Value en HTML</h2>',
					'es_ES' => '<h1>Valor en HTML</h1>',
					'de_DE' => '<h1>gut und g�nstig</h1>',
					'en_UK' => 'in english'
				)
			),
			'Key4' => array (
				'isTranslated' => 0,
				'isHTML' => 1,
				'values' => array (
					'default' => '<h1>Value en HTML</h2>',
					'es_ES' => '<h1>Valor en HTML</h1>',
					'de_DE' => '<h1>gut und g�nstig</h1>',
					'en_UK' => 'in english'
				)
			)
		);
		return $props;
	}

}
?>