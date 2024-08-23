NAME=inception
D_COMPOSE=docker-compose
DOCKER_PATH=/usr/bin/docker-compose
DOCKER_YML = srcs/docker-compose.yml

host:
	sudo sed -i 's|localhost|mamaral-.42.fr|g' /etc/hosts

install:
	curl -L "https://github.com/docker/compose/releases/download/v2.29.2/docker-compose-$(uname -s)-$(uname -m)" -o $(DOCKER_PATH)
	sudo chown $(USER) $(DOCKER_PATH)
	sudo chmod 777 $(DOCKER_PATH)

build:
	$(D_COMPOSE) -f $(DOCKER_YML) build

list-images:
	$(D_COMPOSE) -f $(DOCKER_YML) images

list-containers:
	$(D_COMPOSE) -f $(DOCKER_YML) ps -a

run: build
	$(D_COMPOSE) -f $(DOCKER_YML) up -d 

remove-image:
	$(D_COMPOSE) down --rmi all

fclean: remove-image

stop:
	$(D_COMPOSE) -f $(DOCKER_YML) down

.PHONY: build stop remove-image remove-container \
		run list-containers list-images
