# Example of how to remove unused css using google chrome:
## Get unused css using google chrome
Google chrome can show the fraction of css that is not use by a web page. For that go to:

1. `View -> Developer -> Developer Tools`
2. then go to `coverage` section and click on `reload` and start capturing the coverage 
3. Chrome will then display the fraction of unused css (for example with bootstrap.min.css if the website uses bootstrap). 
4. You can then download a chrome file by clicking on the 'Export...' button

> Important note: Since `javascript can change the css used`, try to click on different elements in the  web page (for example a dropdown menu in the navbar). The fraction of css unused can then decrease a little bit.

you should get a json file named for example "Coverage-20210220T191402.json" (Note that 20210220T191402 should be different for you)`

This file gives information about  the fraction of code that is used by the web page.

# Create a PHP script that Extract CSS And Js From Chrome Coverage File

You can then create a simple php script based on the chrome coverage json file to  Extract CSS And Js:

Note: to run the script you need:
- Coverage---------.json
- PHP

in the same directory.

```php
<?php
$content = file_get_contents('C:/xampp/htdocs/Coverage-20220209T004226.json');
$json = json_decode($content, true);
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
```
