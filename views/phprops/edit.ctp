<?php
$codeBlock = "var data = {id: $id, key: '$key', defaultValue: '${values['default']}', isHtml: $htmlValue, isTranslated: $translatedValue};";
//FIXME: This should be configured


/*@$locales =<<<EOD
			var locales = [
							
			
				{id: 1, locale: 'es_ES', hash: 'español', text: 'Español', value: '${values['es_ES']}'},
				{id: 2, locale: 'de_DE', hash: 'deutsch', text: 'Deutsch', value: '${values['de_DE']}'},
				{id: 3, locale: 'en_UK', hash: 'english', text: 'English', value: '${values['en_UK']}'}
			];
			nano(function() { phprop.editor(data); });
EOD;*/



$cadena="var locales =[";
$aux=null;
foreach($idiomas as $clave => $lang){
$idioma=$lang['locale'];
$aux[].="{id: ".$lang['ident'].", " ;
$aux[].="locale: '".$lang['locale']."', " ;
$aux[].="hash: '".$lang['hash']."', " ;
$aux[].="text: '".$lang['text']."', " ;
$aux[].="value: '${values[$idioma]}'},";
}
foreach($aux as $aux2){
$cadena.=$aux2;	
}
$long=strlen($cadena);
$cadena=substr($cadena,0,$long-1);
$cadena.="];nano(function() { phprop.editor(data); });";
		

@$locales =$cadena;	




$actionURLJS = "phprop.actionURL = '" . $html->url(array('action' => 'update', $key)) . "'";

$javascript->codeBlock($codeBlock, array('inline' => false));
$javascript->codeBlock($locales, array('inline' => false));
$javascript->codeBlock($actionURLJS, array('inline' => false));
?>
<div id="phprop-box">
<div id="phprop-editor">
<div id="phprop-editor-controls">
<label for="key">Key:</label>
<input id="key" type="text" name="key" value="" />
<button id="save">Save &amp; Close</button>
<button id="cancel">Cancel &amp; Close</button>
</div>
<div id="phprop-editor-content"></div>
</div>
</div>
	