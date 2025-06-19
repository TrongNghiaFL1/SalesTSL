pipeline {
    agent any

    environment {
        // Cấu hình GitHub token nếu cần (nếu bạn sử dụng GitHub)
        GITHUB_TOKEN = credentials('github-token')
    }

    stages {
        // Lấy mã nguồn từ GitHub
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/TrongNghiaFL1/SalesTSL.git', credentialsId: 'github-token'
            }
        }

        // Build Docker image từ Dockerfile
        stage('Build Docker Image') {
            steps {
                script {
                    // Build Docker image từ Dockerfile
                    sh 'docker-compose build'
                }
            }
        }

        // Khởi động container từ các image vừa build
        stage('Deploy Containers') {
            steps {
                script {
                    // Khởi động các container từ docker-compose
                    sh 'docker-compose up -d'
                }
            }
        }

        // Kiểm tra xem các container đã chạy chưa
        stage('Verify Deployment') {
            steps {
                script {
                    // Kiểm tra trạng thái container
                    sh 'docker ps'
                }
            }
        }
    }
}
