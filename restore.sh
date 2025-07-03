#!/bin/bash
# Đặt timestamp từ tham số đầu vào
TIMESTAMP=$1

# Kiểm tra nếu không có tham số timestamp
if [ -z "$TIMESTAMP" ]; then
  echo "Please provide the timestamp for the backup (e.g., 2025-06-18_21-09-08)."
  exit 1
fi

# Restore Docker image (nginx và php)
docker load -i ~/backups/my-backup-nginx-$TIMESTAMP.tar
docker load -i ~/backups/my-backup-php-$TIMESTAMP.tar

# Kiểm tra nếu container MySQL chưa tồn tại, tạo lại container salestsl-db-1
if ! docker ps -a --format '{{.Names}}' | grep -q "salestsl-db-1"; then
  echo "Container salestsl-db-1 không tồn tại, tạo lại container MySQL..."
  docker run -d --name salestsl-db-1 \
    -e MYSQL_ROOT_PASSWORD=rootpass \
    -e MYSQL_DATABASE=web3 \
    -e MYSQL_USER=webuser \
    -e MYSQL_PASSWORD=webpass \
    -p 3306:3306 mysql:5.7
else
  echo "Container salestsl-db-1 đã tồn tại."
fi

# Đợi cho MySQL container khởi động hoàn toàn (có thể mất vài giây)
echo "Đang đợi MySQL khởi động..."
until docker exec salestsl-db-1 mysql -u webuser -pwebpass -h 127.0.0.1 -P 3306 -e "SHOW DATABASES;" > /dev/null 2>&1; do
  echo "Chờ MySQL khởi động..."
  sleep 5
done
echo "MySQL đã sẵn sàng!"

# Chạy lại container từ image đã restore
docker run -d -p 8085:80 --name SalesTSL-nginx-1 my-backup-nginx:$TIMESTAMP
docker run -d -p 9001:9000 --name SalesTSL-php-1 my-backup-php:$TIMESTAMP

# Restore MySQL Database từ file backup
docker exec -i salestsl-db-1 mysql -u webuser -pwebpass -h 127.0.0.1 -P 3306 web3 < ~/backups/db-backup-$TIMESTAMP.sql

echo "Restore completed from backup $TIMESTAMP"
