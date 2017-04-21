FROM php:7.1-cli
RUN echo "short_open_tag=0" > /usr/local/etc/php/conf.d/disable_short_open_tag.ini

RUN apt-get update
RUN apt-get install -y --force-yes unzip curl git ssl-cert
RUN apt-get clean

RUN curl -Ss https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

RUN echo "export APPLICATION_ENV=development" >> ~/.bashrc

CMD ["tail", "-f", "/etc/debian_version"]
