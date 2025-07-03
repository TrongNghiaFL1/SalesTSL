#!/bin/bash

# Cấu hình
BACKUP_DIR="/var/backups/webapp"
PROJECT_NAME="webapp"

# Kiểm tra tham số
if [ -z "$1" ]; then
    echo "Usage: $0 <backup_date>"
    echo "Example: $0 20231215_143000"
    echo "Available backups:"
    ls -la ${BACKUP_DIR}/ | grep -E "(database|app_data|docker_images)_[0-9]{8}_[0-9]{6}"
    exit 1
fi

BACKUP_DATE=$1

echo "Starting restore process for backup: ${BACKUP_DATE}"

# Dừng containers hiện tại
echo "Stopping current containers..."
docker-compose down

# Restore Docker images
if [ -f "${BACKUP_DIR}/docker_images_${BACKUP_DATE}.tar.gz" ]; then
    echo "Restoring Docker images..."
    gunzip -c ${BACKUP_DIR}/docker_images_${BACKUP_DATE}.tar.gz | docker load
fi

# Restore application data
if [ -f "${BACKUP_DIR}/app_data_${BACKUP_DATE}.tar.gz" ]; then
    echo "Restoring application data..."
    tar -xzf ${BACKUP_DIR}/app_data_${BACKUP_DATE}.tar.gz
fi

# Khởi động containers
echo "Starting containers..."
docker-compose up -d

# Đợi database khởi động
echo "Waiting for database to start..."
sleep 30

# Restore database
if [ -f "${BACKUP_DIR}/database_${BACKUP_DATE}.sql" ]; then
    echo "Restoring database..."
    docker exec -i ${PROJECT_NAME}_db_1 mysql -u root -prootpass web3 < ${BACKUP_DIR}/database_${BACKUP_DATE}.sql
fi

echo "Restore completed!"
echo "Checking application status..."
docker-compose ps