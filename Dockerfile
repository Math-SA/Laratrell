FROM bitnami/laravel:9
RUN rm -rf /opt/bitnami/node
RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh
RUN sudo bash nodesource_setup.sh
RUN sudo apt-get install -y nodejs unzip
RUN rm nodesource_setup.sh
WORKDIR /app
COPY . .
RUN npm install
RUN npm run build
RUN cp ./.env.example ./.env
RUN composer install
RUN php artisan key:generate

EXPOSE 8000