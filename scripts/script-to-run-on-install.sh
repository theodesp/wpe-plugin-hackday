#!/bin/bash
set -e
rm -Rf wpe-wp-sign-on-plugin
cd "/nas/content/live/$1/wp-content/mu-plugins"
rm -f wpe-wp-sign-on-plugin.php
rm -Rf wpe-wp-sign-on-plugin
cd -

unzip plugin.zip
mv wpe-wp-sign-on-plugin/* "/nas/content/live/$1/wp-content/mu-plugins"

echo "!!finished installing on $1!!!"
