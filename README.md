# Travis Build project for codementality/drupal-project

Build Status:  [![Build Status](https://travis-ci.com/codementality/drupal-project-build.svg?branch=develop)](https://travis-ci.com/codementality/drupal-project-build)

This project builds the project scaffolding template for codementality/drupal-project.  It utilizes Travis CI to clone the repository nightly (using Travis CI's "cron" run capabilities), build the project, and using Github Integration and an authorized API key, pushes the project to github.com/codementality/drupal-project.

This project build starts with the base project [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project), and make the modifications included in the two script files:

* build-project.sh -- a bash script that is kicked off on Travis
* build-composer-file.php -- a php script that modifies the contents of the composer.json file before writing out the modified file

Once built, Travis CI then pushes the project to [codementality/drupal-project](https://github.com/codementality/drupal-project).
