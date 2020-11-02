
# Example Symfony RSS Parser

Docker images used for both `mariadb` and `Symfony` from Bitnami image repository, which can be found [here](https://github.com/bitnami/bitnami-docker-symfony)

A small example project parsing RSS feeds in `Symfony5`

- PHP backend logic can be found in `rss_feed_app/src`
- Templating logic can be found in `rss_feed_app/templates/rss-feed`
- Frontend `JS/CSS` logic can be found in `rss_feed_app/public`

To get this up and running you will need [Docker](https://docs.docker.com/get-docker/) installed. Once that is up and running, instructions to run can be found below.

- Run `docker-compose up` in the root directory

Once both the `mariadb` and `rss_feed_app` containers are both up and running, you will need to run the below command inside the root directory of the project.

```
docker-compose exec rss_feed_app bash -c "cd rss_feed_app && \
composer install && \
php bin/console doctrine:database:create && \
php bin/console doctrine:schema:update --force"
```

This will:
- Install required composer dependencies 
- Create the database/schema
- Populate the database schema with Model definitions found in `rss_feed_app/src/Entity`

Once all of the above has completed navigate to http://localhost:8085/rss/getFeed to view the feed (or any port of your choosing, note you may need to restart the service, and add the `--build` flag to the `docker-compose` command.
