#!/bin/bash
# Đặt timestamp cho tên file backup
TIMESTAMP=$(date +'%Y-%m-%d_%H-%M-%S')

# Backup Docker container (nginx và php)
docker commit salestsl-nginx-1 my-backup-nginx:$TIMESTAMP
docker save -o ~/backups/my-backup-nginx-$TIMESTAMP.tar my-backup-nginx:$TIMESTAMP

docker commit salestsl-php-1 my-backup-php:$TIMESTAMP
docker save -o ~/backups/my-backup-php-$TIMESTAMP.tar my-backup-php:$TIMESTAMP

# Backup MySQL Database từ container MySQL
docker exec salestsl-db-1 mysqldump -u webuser -pwebpass web3 > ~/backups/db-backup-$TIMESTAMP.sql

# Thông báo hoàn tất backup
echo "Backup completed at $TIMESTAMP"
