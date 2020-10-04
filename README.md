# docker-laravel-handson

- https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4

# 手順
```bash:
$ docker -v
Docker version 18.09.2, build 6247962

$ docker-compose -v
docker-compose version 1.23.2, build 1110ad01

$ git clone https://github.com/ckjets/docker-laravel-handson.git

# 起動
$ cd ~/docker-laravel-handson
$ docker-compose up -d --build

# 停止
$ docker-compose down

# ステータス確認
$ docker-compose ps

# コンテナにはいる
$ docker-compose exec app ash
```