#!/bin/sh
echo "Creating database socialdb@postgres"
createdb --username=postgres socialdb

echo "[DONE]\nCreating tables..."
psql -U postgres socialdb < sql/setup.sql

echo "[DONE]\n"

exit 0;