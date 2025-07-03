pipeline {
    agent any
    
    environment {
        DOCKER_COMPOSE_FILE = 'docker-compose.yml'
        BACKUP_DIR = "${WORKSPACE}/backups"
        PROJECT_NAME = 'webapp'
    }
    
    stages {
        stage('Build and Deploy') {
            steps {
                script {
                    // Dừng containers cũ nếu có
                    sh 'docker-compose down || true'
                    
                    // Build và khởi chạy containers
                    sh 'docker-compose up -d --build'
                    
                    // Kiểm tra trạng thái containers
                    sh 'docker-compose ps'
                }
            }
        }
        
        stage('Health Check') {
            steps {
                script {
                    // Đợi web khởi động
                    sleep(time: 30, unit: 'SECONDS')
                    
                    // Kiểm tra web có hoạt động không
                    sh '''
                        curl -f http://localhost:80 || exit 1
                        echo "Web application is running successfully!"
                    '''
                }
            }
        }
        
        stage('Backup') {
            steps {
                script {
                    // Tạo thư mục backup trong workspace
                    sh 'mkdir -p ${BACKUP_DIR}'
                    
                    // Backup source code
                    sh '''
                        DATE=$(date +"%Y%m%d_%H%M%S")
                        echo "Creating backup at ${BACKUP_DIR}/source_backup_${DATE}.tar.gz"
                        tar -czf ${BACKUP_DIR}/source_backup_${DATE}.tar.gz ./Source
                        
                        # Backup database nếu container đang chạy
                        if docker ps | grep -q mysql; then
                            echo "Backing up database..."
                            docker exec $(docker ps -q -f name=mysql) mysqldump -u root -prootpass web3 > ${BACKUP_DIR}/database_${DATE}.sql || echo "Database backup failed"
                        fi
                        
                        # Xóa backup cũ hơn 7 ngày
                        find ${BACKUP_DIR} -type f -name "*backup*" -mtime +7 -delete || echo "No old backups to delete"
                        
                        echo "Backup completed!"
                        ls -la ${BACKUP_DIR}
                    '''
                }
            }
        }
    }
    
    post {
        always {
            // Lưu backup artifacts
            archiveArtifacts artifacts: 'backups/*', allowEmptyArchive: true
            cleanWs()
        }
        failure {
            echo 'Deployment failed!'
        }
        success {
            echo 'Deployment successful!'
        }
    }
}
