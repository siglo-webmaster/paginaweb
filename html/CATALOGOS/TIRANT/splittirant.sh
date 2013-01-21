#!/bin/sh
echo "iniciando programa de corte" >> logs/split_log.txt
echo $1 $prefijo >> logs/split_log.txt
prefijo="parte.$(date +%m%d%y)."
wget http://www.tirant.com/catalogo/catalogo_ebooks.txt
csplit -ksf $prefijo catalogo_ebooks.txt /\\n/ "{*}" &2>logs/split_log.txt
rm "$prefijo.00"
echo "fin programa corte" >>  logs/split_log.txt
