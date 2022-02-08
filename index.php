<?php
$content = file_get_contents('C:/Users/Downloads/Coverage-20220209T004226.json');
$json = json_decode($content, true);
#$file_name = 'style.min.css';
foreach ($json as $files) {
	$ext = pathinfo($files['url'], PATHINFO_EXTENSION);
	$sText = $files['text'];
	$sOut = "";
	foreach ($files['ranges'] as $iPos => $oR) {
		$sOut .= substr($sText, $oR['start'], ($oR['end']-$oR['start']))." \n";
	}

	echo '<!-- '. $files['url'] .' -->'."\n";

	if($ext == 'css') {
		echo '<style rel="stylesheet" type="text/css">' . $sOut . '</style>';
	} else if($ext == 'js') {
		echo '<script>' . $sOut . '</script>';
	} else {
		echo '<unknown>' . $sOut . '</unknown>';		
	}
	echo "\n\n";
	$sOut = '';
}
