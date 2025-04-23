echo "Deploying Application to Service"
rsync -avz ./auto-guru.co.uk agwebsite-dev:dev_services/company_website/auto-guru.co.uk
rsync -avz ./docker/ agwebsite-dev:dev_services/company_website/docker
rsync -avz ./docker-compose.yml agwebsite-dev:dev_services/company_website/docker-compose.yml
