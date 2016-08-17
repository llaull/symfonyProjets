#!/usr/bin/env bash

git clone https://github.com/llaull/symfonyAlpha.git
cd symfonyAlpha
php composer self-update
cd src
git clone https://github.com/llaull/AppBundleX.git
mv  -v AppBundleX/* AppBundle/
rm -r AppBundleX
cd ../
mysql -e 'create database alpha;'
php bin/composer install
php bin/console doctrine:schema:create
php bin/console fos:user:create test test test --super-admin
