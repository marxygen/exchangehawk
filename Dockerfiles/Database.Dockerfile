FROM library/postgres
COPY ./sql/init.sql /docker-entrypoint-initdb.d/