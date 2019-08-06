<?php
$composerJson = file_get_contents('drupal/composer.json');
$data = json_decode($composerJson, true);
$data['name'] = "codementality/drupal-project";
$data['description'] = 'Project template for Drupal 8 projects with Composer';
$data['authors'] = [
	[
		"name" => "Lisa Ridley <lisa@codementality.com>",
		"role" => "Sr. Solutions Architect"
	],
];
$data['repositories'][] = [
	'type' => 'composer',
	'url' => 'https://asset-packagist.org',
];
$data['extra']['installer-types'] = [
	"component",
	"bower-asset",
	"npm-asset",
];

// Switch from web/libraries/{$name} to docroot/libraries/{$name}
$data['extra']['installer-paths']['docroot/libraries/{$name}'] = [
	'type:drupal-library',
	'type:component',
	'type:bower-asset',
	'type:npm-asset'
];
unset($data['extra']['installer-paths']['web/libraries/{$name}']);

// Switch from web/profiles/contrib/{$name} to docroot/profiles/contrib/{$name}
$data['extra']['installer-paths']['docroot/profiles/contrib/{$name}'] = $data['extra']['installer-paths']['web/profiles/contrib/{$name}'];
unset( $data['extra']['installer-paths']['web/profiles/contrib/{$name}']);

// Switch from web/modules/contrib/{$name} to docroot/modules/contrib/{$name}
$data['extra']['installer-paths']['docroot/modules/contrib/{$name}'] = $data['extra']['installer-paths']['web/modules/contrib/{$name}'];
unset( $data['extra']['installer-paths']['web/modules/contrib/{$name}']);

// Switch from web/themes/contrib/{$name} to docroot/themes/contrib/{$name}
$data['extra']['installer-paths']['docroot/themes/contrib/{$name}'] = $data['extra']['installer-paths']['web/themes/contrib/{$name}'];
unset( $data['extra']['installer-paths']['web/themes/contrib/{$name}']);

// Switch from web/core to docroot/core
$data['extra']['installer-paths']['docroot/core'] = $data['extra']['installer-paths']['web/core'];
unset( $data['extra']['installer-paths']['web/core']);

// Add config for bin-dir
$data['config']['bin-dir'] = "bin/";

$composerJson = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('drupal/composer.json', $composerJson);
