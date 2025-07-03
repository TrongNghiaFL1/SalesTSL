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
        
        