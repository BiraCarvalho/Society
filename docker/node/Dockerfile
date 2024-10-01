FROM node:lts

ENV WORKDIR_PATH /usr/src/app
ENV HOST_DIR ./app/angular

WORKDIR ${WORKDIR_PATH}

COPY ${HOST_DIR}/package.json /usr/src/app

RUN npm install && npm install -g @angular/cli

EXPOSE 4200

CMD ["ng", "serve", "--host", "0.0.0.0"]
# CMD ["tail", "-f", "/dev/null"]