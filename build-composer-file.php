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
$data['extra']['installer-paths']['web/libraries/{$name}'] = [
	'type:drupal-library',
	'type:component',
	'type:bower-asset',
	'type:npm-asset'
];
$composerJson = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('drupal/composer.json', $composerJson);
