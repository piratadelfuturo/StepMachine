#!/bin/sh

basedir="$( cd -P "$( dirname "${BASH_SOURCE[0]}" )" && pwd | sed 's/Tools//g' )"

app="$basedir"Src/symfony/app/

sudo rm -rf "$app"{cache,logs}/*

sudo chmod +a "_www allow delete,write,append,file_inherit,directory_inherit" "$app"{cache,logs}
sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" "$app"{cache,logs}

php "$basedir"Src/symfony/composer.phar update

php "$app"console assets:install --symlink --relative "$basedir"Src/symfony/web

php "$app"console doctrine:schema:update --force
