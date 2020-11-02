#!/bin/bash
cd rss_feed_app

composer install
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
