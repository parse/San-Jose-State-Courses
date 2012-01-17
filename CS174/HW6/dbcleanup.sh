#!/bin/sh
echo "\nRemoving tables..."
psql -U abcd socialdb < sql/destroy.sql

echo "[DONE]\n"

exit 0;