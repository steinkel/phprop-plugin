<?php
class LanguagesphpropsController extends AppController {

	var $name = 'Languagesphprops';
	var $helpers = array('Html', 'Form','Javascript');
	var $languagesfile = null;
	var $uses = array();
	function beforeFilter(){
		$this->languagesfile = TMP . 'languages.json';
		
	}

	function index() 
	{
		$lang = $this->__readLang();
		$this->set('lang', $lang);
		
	}

	function update($id=null,$active=null) {
			$lang = $this->__readLang($id);
			if (!empty ($lang)) {
				// updating the prop
				$lang[$id]['active'] = $active;				
				$lang = $this->__saveLang($lang);

			}
		}
	
	function add() {
		if ($this->data) {
			$id = $this->data['Languagesphprop']['key'];
			$locale = $this->data['Languagesphprop']['locale'];
			$ident= $this->data['Languagesphprop']['key'];
			$hash = $this->data['Languagesphprop']['hash'];
			$text = $this->data['Languagesphprop']['text'];
			$active = $this->data['Languagesphprop']['active'];
			
			$lang = $this->__readLang();
			if (@ !isset ($lang[$id])) {
				// saves the new key
				$this->__saveNewLang($id, $locale, $hash, $text, $ident, $active);
				
				$this->Session->setFlash("Language has been added");
				$this->redirect(array('action'=>'index'));
			} else {
				//key exists, abort
				$this->Session->setFlash("Language is already defined, no language was added. Please type another language.");
				$this->redirect(array('action'=>'index'));
			}

		}

	}
	function off($id){
		$this->update($id,0);
		$this->redirect(array('action'=>'index'));
		
	}
	function on($id){
		$this->update($id,1);
		$this->redirect(array('action'=>'index'));
		
	}
	

	
	function __saveNewLang($id, $locale, $hash, $text, $ident, $active) {
		$lang = $this->__readLang();
		$lang[$id] = array (
			'locale' => $locale,
			'hash' => $hash,
			'text' => $text,
			'ident'=>$ident,
			'active' => $active);		
		$this->__saveLang($lang);
	}

	function __saveLang($lang) {
		$fh = fopen($this->languagesfile, "w");
		fwrite($fh, json_encode($lang));
		fclose($fh);
	}
	
	
	function __readLang($key = null) {
	
			$file = new File($this->languagesfile);
			if (!$file->exists()){
				$file->create();
			}
			$filecontent = file_get_contents($this->languagesfile);
			$lang = json_decode($filecontent, true);
			//debug($props);
			return $lang;
	}

}
?>