#!/bin/sh
echo "Populating database socialdb@postgres"

psql -U abcd socialdb < sql/populate.sql

echo "[DONE]\nUser 'abc' created with password '123'\n"
echo "User 'def' created with password '123'\n"
echo "User 'ghi' created with password '123'\n"

exit 0;