#!/bin/bash
set -e
## changes ownership of the current directory to the current $USER
if [ -n "$TRAVIS" ]; then 
	sudo chown -R $USER ~/
fi
## Downloads the drupal-composer/drupal-project as a zip file and unzips it.
curl -o drupal.zip https://codeload.github.com/drupal-composer/drupal-project/zip/8.x
unzip drupal.zip
## Deletes the zip file, no longer needed
rm drupal.zip
mv drupal-project-8.x drupal
## Modify original composer.json file from above project.
php build-composer-file.php
## Add packages to composer.json file for this project.
composer require "behat/mink-selenium2-driver" --dev --working-dir=drupal --no-update
composer require "drupal/drupal-extension:^4.0@beta" --dev --working-dir=drupal --no-update
composer require "guzzlehttp/guzzle:^6.0@dev" --dev --working-dir=drupal --no-update
composer require "phpunit/phpunit:>=4.8.24" --dev --working-dir=drupal --no-update
composer require "roave/security-advisories:dev-master" --dev --working-dir=drupal --no-update
composer require "vanare/behat-cucumber-json-formatter:~1.1.1" --dev --working-dir=drupal --no-update
composer require "php:>=7.2" --working-dir=drupal --no-update
composer require "drupal/config_split:^1.4" --working-dir=drupal --no-update
composer require "drupal/ctools:3.x-dev" --working-dir=drupal --no-update
composer require "drupal/devel:~2.0" --working-dir=drupal --no-update
composer require "drupal/diff:^1.0@RC" --working-dir=drupal --no-update
composer require "drupal/environment_indicator:^3.6" --working-dir=drupal --no-update
composer require "drupal/module_filter:^3.1" --working-dir=drupal --no-update
composer require "drupal/paragraphs:^1.5" --working-dir=drupal --no-update
composer require "drupal/pathauto:^1.3" --working-dir=drupal --no-update
composer require "drupal/redirect:^1.3" --working-dir=drupal --no-update
composer require "drupal/styleguide:^1.0@alpha" --working-dir=drupal --no-update
## Copy the README.md to the drupal directory
cp docs/README.md drupal/README.md
## Start creating repo commit
cd drupal
git init
## set user name and email
git config user.email "lisa@codementality.com"
git config user.name "Lisa Ridley"

git add .
git commit -m 'Build Commit from Travis Build'
git checkout -b 8.x
git remote add origin https://github.com/codementality/drupal-project.git
if [ -n "$GITHUB_API_KEY" ] && [ "$TRAVIS_BRANCH" = "develop" ] && [ "$TRAVIS_PULL_REQUEST" = "false" ]; then
	git push -f -q https://$GITHUB_USER:$GITHUB_API_KEY@github.com/codementality/drupal-project 8.x
fi
