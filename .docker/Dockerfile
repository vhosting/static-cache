FROM chialab/php-dev:8.5-apache

ARG USERNAME=app
ARG USER_UID=1000
ARG USER_GID=$USER_UID
ARG NODE_VERSION=22

ENV APACHE_RUN_USER="www-data"
ENV COMPOSER_CACHE_DIR=/home/$USERNAME/.composer
ENV NPM_CONFIG_CACHE=/home/$USERNAME/.npm

# install core dependencies
RUN apt update && apt install -y sudo curl nano htop bind9-host traceroute

# configure user
RUN groupadd --gid $USER_GID $USERNAME
RUN useradd --uid $USER_UID --gid $USER_GID -m $USERNAME
RUN echo "$USERNAME ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/$USERNAME
RUN chmod 0440 /etc/sudoers.d/$USERNAME
RUN usermod -a -G www-data $USERNAME

# set composer cache dir
RUN mkdir -p /home/$USERNAME/.composer
RUN chown -R $USERNAME:$USERNAME /home/$USERNAME/.composer
RUN chmod -R 775 /home/$USERNAME/.composer

# set npm cache dir
RUN mkdir -p /home/$USERNAME/.npm
RUN chown -R $USERNAME:$USERNAME /home/$USERNAME/.npm
RUN chmod -R 775 /home/$USERNAME/.npm

# install nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash -
RUN apt install -y nodejs

# install pcntl
RUN install-php-extensions pcntl

# set aliases
RUN echo "alias ll='ls -la'" >> /home/$USERNAME/.bashrc
RUN echo "alias a='php /var/www/html/artisan'" >> /home/$USERNAME/.bashrc

# set user
USER $USERNAME
