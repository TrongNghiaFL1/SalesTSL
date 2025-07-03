#!/bin/bash

# Kiểm tra trạng thái containers
echo "=== Container Status ==="
docker-compose ps

echo "=== Resource Usage ==="
docker stats --no-stream

echo "=== Nginx Logs ==="
docker-compose logs --tail=50 nginx

echo "=== PHP-FPM Logs ==="
docker-compose logs --tail=50 php

echo "=== Database Logs ==="
docker-compose logs --tail=50 db

# Kiểm tra disk space
echo "=== Disk Usage ==="
df -h

# Kiểm tra backup files
echo "=== Backup Files ==="
ls -la /var/backups/webapp/