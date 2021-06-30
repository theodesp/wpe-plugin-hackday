#!/bin/bash
set -e
rm -Rf wpe-plugin-hack
cd "/nas/content/live/$1/wp-content/mu-plugins"
rm -f wpe-plugin-hack.php
rm -Rf wpe-plugin-hack
cd -

unzip plugin.zip
mv wpe-plugin-hack/* "/nas/content/live/$1/wp-content/mu-plugins"

echo "!!finished installing on $1!!!"
