#!/bin/bash

mysqldump --default-character-set=binary --no-data -u root -p eight > datas/table.sql 

mysqldump --default-character-set=binary --xml -t -u root -p eight > data/data.xml


