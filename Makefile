DOCKER = docker
CONTAINER = php-json-response-helper

ifndef TESTMETHOD
FILTERARGS=
else
FILTERARGS=--filter $(TESTMETHOD)
endif

.PHONY: all test destroy

all: destroy build run

destroy:
	-$(DOCKER) rm -f $(CONTAINER)

build:
	$(DOCKER) build --no-cache -t $(CONTAINER) .

run:
	$(DOCKER) run -d -v "$$PWD":/$(CONTAINER)/ --rm --name=$(CONTAINER) -h $(CONTAINER).ett.local $(CONTAINER)

stop:
	$(DOCKER) stop $(CONTAINER)

restart: stop run

ssh: sh
sh:
	$(DOCKER) exec -i -t $(CONTAINER) /bin/bash

test: phpunit

phpunit:
	$(DOCKER) exec $(CONTAINER) bash -c "cd /$(CONTAINER) && vendor/bin/phpunit -c test/phpunit.xml $(FILTERARGS) $(TESTFILE)"

packages:
	    $(DOCKER) exec -i -t $(CONTAINER) /bin/bash -l -c "cd /$(CONTAINER) && composer install 2>&1"

pu: packages-update
	packages-update:
	$(DOCKER) exec -i -t $(CONTAINER) /bin/bash -l -c "cd /$(CONTAINER) && composer update 2>&1"

logs:
	$(DOCKER) logs --follow $(CONTAINER)
