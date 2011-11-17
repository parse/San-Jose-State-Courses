#!/bin/sh
echo "Creating database socialdb@postgres"
createdb --username=abcd socialdb

echo "[DONE]\nCreating tables..."
psql -U postgres abcd < sql/setup.sql

echo "[DONE]\n"

exit 0;