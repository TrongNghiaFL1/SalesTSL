pipeline {
    agent any

    environment {
        DOCKER_IMAGE = 'salestsl-php-1'  // Tên Docker image của bạn
        BACKUP_DIR = '/home/jenkins/backups'  // Đường dẫn thư mục backup
    }

    stages {
        // Stage 1: Build Web Tĩnh
        stage('Build Static Web') {
            steps {
                script {
                    echo 'Building static website...'
                    // Đảm bảo rằng thư mục ./static-website chứa các file HTML/CSS của web tĩnh
                    sh 'docker build -t $DOCKER_IMAGE-static ./static-website'
                }
            }
        }

        // Stage 2: Build Web Động (Dynamic Web)
        stage('Build Dynamic Web') {
            steps {
                script {
                    echo 'Building dynamic website...'
                    sh 'docker build -t $DOCKER_IMAGE-dynamic ./dynamic-website'
                }
            }
        }

        // Stage 3: Deploy Web Tĩnh
        stage('Deploy Static Web') {
            steps {
                script {
                    echo 'Deploying static website...'
                    // Triển khai web tĩnh lên container Docker
                    sh 'docker run -d -p 80:80 $DOCKER_IMAGE-static'
                }
            }
        }

        // Stage 4: Deploy Web Động
        stage('Deploy Dynamic Web') {
            steps {
                script {
                    echo 'Deploying dynamic website...'
                    sh 'docker run -d -p 3000:3000 $DOCKER_IMAGE-dynamic'
                }
            }
        }

        // Stage 5: Backup Website
        stage('Backup') {
            steps {
                script {
                    echo 'Creating backup...'
                    sh './backup.sh'  // Chạy script backup.sh đã có sẵn trong repo
                }
            }
        }

        // Stage 6: Clean up Old Backups
        stage('Clean up Old Backups') {
            steps {
                script {
                    echo 'Cleaning up old backups...'
                    sh 'find $BACKUP_DIR -type f -mtime +7 -exec rm {} \;'  // Xóa các backup cũ hơn 7 ngày
                }
            }
        }
    }

    post {
        always {
            echo 'Cleaning up Docker resources'
            sh 'docker system prune -f'  // Dọn dẹp các resources không sử dụng trong Docker
        }
    }
}
