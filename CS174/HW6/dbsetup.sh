#!/bin/sh
echo "Creating database socialdb@postgres"
createdb --username=abcd socialdb

echo "[DONE]\nCreating tables..."
psql -U abcd socialdb < sql/setup.sql

exit 0;