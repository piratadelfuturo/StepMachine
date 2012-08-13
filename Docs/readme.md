Los pasos para instalar sevenboom son:

1. Hacer pull de git

2. Inicializar los submodulos de git
$ git submodules update --init

3. Configurar el webserver
 - apuntar el host a app.php para produccion
 - apuntar el host a app_dev.php para desarrollo

4. Borrar las carpets de cache y logs (http://symfony.com/doc/current/book/installation.html)
$ rm -rf app/cache/*
$ rm -rf app/logs/*

5. Cambiar los permisos a la carpeta de cache y logs:
$ sudo chmod +a "_www allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
$ sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs

6. Crear la base de datos y usuario que vienen descritos en el archivo
- app/config/parameters.yml 

7. Descargar las dependencias con composer.phar (o cada q se quiera actualizar una de las dependencias), ejecutando:
$ php composer.phar update

8. Instalar los links a los archivos estáticos públicos de cada bundle (composer hace una copia de estos archivos, hay que convertirlos a symlinks y hacerlos relativos para no tener q instalarlos cada vez q se quieran usar)
$ php app/console assets:install --symlink --relative web

9. Generar las tablas en la base de datos desde la linea de comandos
$ php app/console doctrine:schema:update --force
