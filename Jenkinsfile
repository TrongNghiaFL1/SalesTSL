pipeline {
    agent any
    
    environment {
        DOCKER_COMPOSE_FILE = 'docker-compose.yml'
        BACKUP_DIR = '/var/backups/webapp'
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
                    // Tạo thư mục backup nếu chưa có
                    sh 'sudo mkdir -p ${BACKUP_DIR}'
                    
                    // Chạy script backup nếu có
                    sh '''
                        if [ -f backup_script.sh ]; then
                            chmod +x backup_script.sh
                            ./backup_script.sh
                        else
                            echo "No backup script found, skipping backup"
                        fi
                    '''
                }
            }
        }
    }
    
    post {
        always {
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
