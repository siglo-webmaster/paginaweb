#!/bin/sh
echo "iniciando programa de corte" >> logs/split_log.txt
echo $1 $prefijo >> logs/split_log.txt
prefijo="parte.$(date +%m%d%y)."
csplit -ksf $prefijo $1 /\<Product\>/ "{*}" &2>logs/split_log.txt
echo "fin programa corte" >>  logs/split_log.txt
rm *.00
