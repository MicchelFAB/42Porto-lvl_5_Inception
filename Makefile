NAME=inception
D_COMPOSE=docker-compose
DOCKER_PATH=/usr/bin/docker-compose
DOCKER_YML = srcs/docker-compose.yml

all: $(NAME)

$(NAME): build
		@make run
host:
	sudo sed -i 's|localhost|mamaral-.42.fr|g' /etc/hosts

install:
	sudo curl -L "https://github.com/docker/compose/releases/download/v2.29.2/docker-compose-$$(uname -s)-$$(uname -m)" -o $(DOCKER_PATH)
	sudo chown $(USER) $(DOCKER_PATH)
	sudo chmod 777 $(DOCKER_PATH)

build:
	@mkdir -p ${HOME}/data/wordpress
	@mkdir -p ${HOME}/data/mariadb
	$(D_COMPOSE) -f $(DOCKER_YML) build

run:
	$(D_COMPOSE) -f $(DOCKER_YML) up -d 

stop:
	$(D_COMPOSE) -f $(DOCKER_YML) down

re: 
	@make stop 
	@make fclean 
	@make all

list-images:
	$(D_COMPOSE) -f $(DOCKER_YML) images

list-containers:
	$(D_COMPOSE) -f $(DOCKER_YML) ps -a

remove-image:
	$(D_COMPOSE) -f $(DOCKER_YML) down --rmi all

log: 
	$(D_COMPOSE) -f $(DOCKER_YML) logs

fclean: 
		@make remove-image
		@sudo rm -rf $(HOME)/data

.PHONY: all host install build \
		run stop re list-images \
		list-containers remove-image \
		fclean
