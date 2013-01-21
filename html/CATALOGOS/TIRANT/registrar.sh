#!/bin/sh
echo Inicio programa de registro >> logs/registrar_logs.txt

for i in $(ls parte.*); do
	fecha="$(date +%m%d%y)"
	echo [ $fecha ]  procesando $i >> logs/registrar_logs.txt
	more parte.*.01 > temp.txt
	more $i >>temp.txt
	rm $i
	mv temp.txt $i
        echo $i | php ../../procesarCatalogoTirant.php
        mv $i "bk/$i"  &2>>logs/registrar_logs.txt 
done
echo fin de programa de registro
