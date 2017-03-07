FROM ubuntu:trusty
RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install -y software-properties-common python-software-properties
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update

RUN apt-get purge php5-common -y
RUN apt-get --purge autoremove -y
RUN apt-get install -y --force-yes curl php7.1-cli php7.1-xml php7.1-mbstring php7.1-zip git
RUN curl -Ss https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

RUN apt-get clean

RUN mkdir /php-json-response-helper

COPY composer.json /php-json-response-helper
RUN cd /php-json-response-helper && composer install

CMD ["tail", "-f", "/etc/debian_version"]
