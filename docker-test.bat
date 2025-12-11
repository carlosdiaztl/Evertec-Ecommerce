@echo off

REM Eliminar todas las imágenes de Docker
REM docker rmi -f $(docker images -q)
for /f "tokens=*" %%i in ('docker images -q') do docker rmi -f %%i

REM Levantar los servicios de Docker
@REM docker-compose up

docker-compose up --build