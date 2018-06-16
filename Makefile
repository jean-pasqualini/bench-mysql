export DBC = mysql -h 127.0.0.1 -u root -proot demo
export DBD = mysqldump -h 127.0.0.1 -u root -proot demo

db:
	$(DBC) < init.sql

# Very long time (for 150 000 lines)
demo-one-sql-per-line: db
	php generate-sql.php
	mv test.sql /tmp/in.sql
	pv /tmp/in.sql | $(DBC)

# 5 seconds (for 150 000 lines)
demo-multiple-sql-per-line: db
	php generate-extended-sql.php
	mv extended-insert.sql /tmp/in.sql
	pv /tmp/in.sql | $(DBC)

# 1 seconde for 150 000 lines
demo-mysql-import: db
	php generate-csv.php
	mv test.csv /tmp/Product.csv
	mysqlimport -h 127.0.0.1 --local --columns="ean" -u root -proot demo /tmp/Product.csv

show-count:
	$(DBC) -e "SELECT COUNT(id) FROM Product;"

dump:
	$(DBD) > backup.sql

restore:
	pv backup.sql | $(DBC)