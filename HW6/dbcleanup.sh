#!/bin/sh
echo "\nRemoving tables..."
psql -U postgres socialdb < sql/destroy.sql

echo "[DONE]\n"

exit 0;