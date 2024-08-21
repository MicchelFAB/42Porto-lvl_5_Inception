NAME=inception
D_COMPOSE=docker-compose
DOCKER_PATH=/usr/bin/docker-compose


host:
	sudo sed -i 's|localhost|mamaral-.42.fr|g' /etc/hosts

install:
	curl -L "https://github.com/docker/compose/releases/download/v2.29.2/docker-compose-$(uname -s)-$(uname -m)" -o $(DOCKER_PATH)
	sudo chown $(USER) $(DOCKER_PATH)
	sudo chmod 777 $(DOCKER_PATH)

build:
	$(D_COMPOSE) -f ./srcs/$(D_COMPOSE).yml build

list-images:
	docker image ls -a

list-containers:
	docker container ls -a

run:
	docker run -it nginx

remove-container:
	docker stop $$(docker ps -q) ; \
	docker rm $$(docker ps -aq)    

remove-image:
	docker images -a ; \
	docker rmi $(docker images -q) 


stop:
	docker stop $(SHELL_CONTAINER)
	
.PHONY: build stop remove-image remove-container \
		run list-containers list-images



# docker stop $(docker ps -q)       # Para parar todos os contêineres em execução
# docker rm $(docker ps -aq)         # Para remover todos os contêineres

# docker images -a                   # Lista todas as imagens
# docker rmi $(docker images -q)     # Remove todas as imagens

# docker volume ls                   # Lista todos os volumes
# docker volume rm $(docker volume ls -q)  # Remove todos os volumes

# docker-compose build              # Reconstrua as imagens
# docker-compose up -d              # Crie e inicie os contêineres em segundo plano
