# Roadsurfer test case
### Install
1. Create `mysql` directory in root
2. Run `docker-compose up -d` (that command should not return any error)
3. Connect to MySQL server in your MySQL client by root user (password is `secret`). Host: `localhost`, port: `4306`
4. Create two dbs `symfony_docker` and `symfony_docker_test` (Collation utf8mb4_bin and character set utf8mb4).
5. Grant privileges for two dbs: `GRANT ALL PRIVILEGES ON symfony_docker_test.* TO 'symfony'@'%';` and `GRANT ALL PRIVILEGES ON symfony_docker.* TO 'symfony'@'%';`
6. Connect to docker container by `docker exec -it api_php /bin/bash`
7. Please execute `composer install` in root directory
8. Execute migrations `php bin/console doctrine:migration:migrate`
9. To populate db please execute `php bin/console doctrine:fixtures:load --group=demo`.
### Test
1. Connect to docker container by `docker exec -it api_php /bin/bash`
2. Please execute `composer test` in root directory
### Usage
2 equipments available, because order `33b5688a-0674-4716-aa5a-2bfe0760ea0d` is finished
```bash
curl --request GET \
  --url 'http://127.0.0.1:8989/api/v1/equipment-demand-timeline?station=fe1e6d7f-9caa-4aee-9f4a-e7c0a622236f&date=2022-02-02'
  ```

1 equipment available, because order is not finished yet
```bash
curl --request GET \
  --url 'http://127.0.0.1:8989/api/v1/equipment-demand-timeline?station=fe1e6d7f-9caa-4aee-9f4a-e7c0a622236f&date=2022-02-01'
  ```
