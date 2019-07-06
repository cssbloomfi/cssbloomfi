mysqldump -h$1 -u$2 -p$3 --skip-extended-insert $4 > backup/$5.sql
