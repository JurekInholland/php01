FROM alpine:3.6

# copy crontabs for root user
COPY crontab /etc/crontabs/root

RUN apk update
RUN apk add curl

# Create the log file to be able to run tail
RUN touch /var/log/cron.log
RUN chmod 644 /var/log/cron.log

# start crond with log level 8 in foreground, output to stderr
CMD ["crond", "-f", "-d", "8"]