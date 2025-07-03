#!/bin/bash

# Cấu hình
BACKUP_DIR="/var/backups/webapp"
DATE=$(date +"%Y%m%d_%H%M%S")
PROJECT_NAME="webapp"
RETENTION_DAYS=7

# Tạo thư mục backup
sudo mkdir -p ${BACKUP_DIR}

echo "Starting backup process at $(date)"

# Backup database
echo "Backing up database..."
docker exec ${PROJECT_NAME}_db_1 mysqldump -u root -prootpass web3 > ${BACKUP_DIR}/database_${DATE}.sql

# Backup source code và volumes
echo "Backing up application data..."
sudo tar -czf ${BACKUP_DIR}/app_data_${DATE}.tar.gz ./Source

# Backup Docker images
echo "Backing up Docker images..."
docker save $(docker images --format "{{.Repository}}:{{.Tag}}" | grep -E "(nginx|mysql|${PROJECT_NAME})") | gzip > ${BACKUP_DIR}/docker_images_${DATE}.tar.gz

# Xóa các backup cũ hơn 7 ngày
echo "Cleaning up old backups..."
find ${BACKUP_DIR} -type f -name "*.sql" -mtime +${RETENTION_DAYS} -delete
find ${BACKUP_DIR} -type f -name "*.tar.gz" -mtime +${RETENTION_DAYS} -delete

echo "Backup completed at $(date)"
echo "Backup files stored in: ${BACKUP_DIR}"
ls -la ${BACKUP_DIR}