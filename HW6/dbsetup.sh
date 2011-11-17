#!/bin/sh
echo "Creating database socialdb@postgres"
createdb --username=abcd socialdb

echo "[DONE]\nCreating tables..."
psql -U abcd socialdb < sql/setup.sql

echo "[DONE]\nUser 'abc' created with password '123'\n"
echo "User 'def' created with password '123'\n"
echo "User 'ghi' created with password '123'\n"

exit 0;