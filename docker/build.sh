set -e

sed -i 's/key_buffer/key_buffer_size/g' /etc/mysql/my.cnf 
sed -i 's/myisam-recover/myisam-recover-options/g' /etc/mysql/my.cnf 
chown -R mysql:mysql /var/lib/mysql

mysql_install_db --user mysql > /dev/null

MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD:-"toor1"}
MYSQL_DATABASE=${MYSQL_DATABASE:-"ipexpress"}
MYSQL_USER=${MYSQL_USER:-"ipex"}
MYSQL_PASSWORD=${MYSQL_PASSWORD:-"toor"}

tfile=`mktemp`

if [ ! -f "$tfile" ] ; then
exit 1 
fi

cat << EOF > $tfile
USE mysql; 
FLUSH PRIVILEGES;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;
UPDATE user SET password=PASSWORD("$MYSQL_ROOT_PASSWORD") where user = "root";
EOF

if [ $MYSQL_DATABASE != "" ] ; then
	echo "CREATE DATABASE IF NOT EXISTS \`$MYSQL_DATABASE\` CHARACTER SET utf8 COLLATE utf8_general_ci;" >> $tfile

	if [ $MYSQL_USER != "" ]; then
		echo "GRANT ALL ON \`$MYSQL_DATABASE\`.* to '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';" >> $tfile
	fi
fi


/usr/sbin/mysqld --bootstrap --verbose=0 $MYSQLD_ARGS < $tfile
rm -f $tfile

sed -i 's/--manage-gids/--manage-gids --port 4000/g' /etc/default/nfs-kernel-server
ln -s /opt/IPEXpress/web /var/www/html/IPEXpress
