#!/bin/sh
export backup_name=$(date +%Y%m%d%H%M)-dump-$USER.sql
mysqldump -usevenboom -psevenboom sevenboom --opt > $backup_name
bzip2 -9 $backup_name

