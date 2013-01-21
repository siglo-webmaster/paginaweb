#!/bin/sh
echo Inicio programa de registro >> logs/registrar_logs.txt
rm *.00 &2>>logs/registrar_logs.txt
for i in $(ls *.txt); do
	fecha="$(date +%m%d%y)"
	echo [ $fecha ]  procesando $i >> logs/registrar_logs.txt
        echo $i | php ../../procesarCatalogoSHE2.php
       # mv $i "bk/$i"  &2>>logs/registrar_logs.txt 
done
echo fin de programa de registro
