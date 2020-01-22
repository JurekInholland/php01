# Docker commands

- stop stack  
`docker-compose down`

- start stack  
`docker-compose up --build`

- run composer update in docker container:  
`docker run --rm --interactive --tty --volume ${PWD}:/app composer update --ignore-platform-reqs`

- initial database setup:  
`docker-compose exec mysql sh -c "mysql -uroot -prootpw projectdb < ./sql/setup.sql"`

