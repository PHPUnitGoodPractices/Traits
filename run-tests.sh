#!/usr/bin/env bash
set -e

PHPUNIT=$1
INSTALLED=0

if [ -z "${PHPUNIT}" ]
then
    echo -e "\e[101mNo PHPUnit version provided.\e[0m"
    exit 1
fi

echo -e "\e[46m§ Trying to execute tests under PHPUnit ${PHPUNIT}.\e[0m"

rm -f composer.lock

echo -e "\n\e[46m§ Installing deps...\e[0m"
composer require -q --dev --no-update phpunit/phpunit:${PHPUNIT}
composer update -q $DEFAULT_COMPOSER_FLAGS && INSTALLED=1 || INSTALLED=0

if [ $INSTALLED == 0 ]
then
    echo -e "\n\e[45mPHPUnit ${PHPUNIT}: Is not compatible with $(php -v | head -1).\e[0m"
else
    echo -e "\n\e[46m§ Installed:\e[0m"
    composer info -D | sort

    echo -e "\n\e[46m§ Running tests...\e[0m"
    vendor/bin/phpunit -v || (echo -e "\n\e[41mPHPUnit ${PHPUNIT}: Error while testing.\e[0m" && exit 2)

    echo -e "\n\e[42mPHPUnit ${PHPUNIT}: Success.\e[0m"
fi
