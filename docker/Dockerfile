FROM ubuntu:14.04
MAINTAINER Geoffre Glangine <geoffrey.glangine@gmail.com>

# Keep upstart from complaining
RUN dpkg-divert --local --rename --add /sbin/initctl
RUN ln -sf /bin/true /sbin/initctl

# Update
RUN apt-get update
RUN apt-get -y upgrade

# Basic Requirements
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install git apache2 mysql-server php5 php5-mysql nfs-kernel-server wget apache2-utils 

#Mysqlconfig
#ADD my.cnf /etc/mysql/conf.d/my.cnf
#RUN chmod 664 /etc/mysql/my.cnf.bak

# apache config
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
RUN chown -R www-data:www-data /var/www/

# Initialization Startup Script
ADD ./db.sql /db.sql
ADD ./distrib.sh /distrib.sh
RUN chmod 755 /distrib.sh

ADD ./build.sh /build.sh
RUN chmod 755 /build.sh

ADD ./start.sh /start.sh
RUN chmod 755 /start.sh

RUN bash /build.sh
RUN cd /opt
RUN git clone https://github.com/S3LLL/IPEXpress /opt/IPEXpress
RUN cd /opt/IPEXpress/
RUN mkdir /etc/apache2/conf.d/
RUN python /opt/IPEXpress/install.py
RUN mkdir /opt/IPEXpress/distrib/ubuntu
RUN wget  -O /opt/IPEXpress/distrib/ubuntu/ubuntu-14.04.2-desktop-amd64.iso http://mirror.clibre.uqam.ca/ubuntu-releases/14.04.2/ubuntu-14.04.2-desktop-amd64.iso 

#RUN /distrib.sh

CMD ["/bin/bash","/start.sh"]
