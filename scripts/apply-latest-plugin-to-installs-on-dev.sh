#!/bin/bash
set -e
echo
echo '!!This script will apply the contents of this plugin repo to the mu plugin directory of the WordPress installs you specifiy in the wpengine.com or wpenginedev.com environment!!'
echo
echo Enter ldap pswd
read -s t_password

echo "Are these installs dev (wpenginedev.com) environments? (y/n)"
read dev

if [[ $dev == "y" ]]; then
    suffix="wpenginedev.com"
else
    suffix="wpengine.com"
fi

IFS=' '
echo "Enter name(s) of install(s) separated by a space and press return to begin deployment to $suffix"
read installnames

read -a strarr <<< "$installnames"

rm -f ./plugin.zip
zip -r plugin.zip wpe-plugin-hack 

for installname in "${strarr[@]}";
do
echo "connecting to $installname..."
rsync ./plugin.zip "$installname.$suffix:~"
rsync ./scripts/script-to-run-on-install.sh "$installname.$suffix:~"
ssh -t "$installname.$suffix"  "echo '$t_password' | sudo -S ./script-to-run-on-install.sh $installname"
done
