#!/bin/sh
echo Inicio programa de registro >> logs/registrar_logs.txt
#rm *.00 &2>>logs/registrar_logs.txt
for i in $(ls parte.*); do
	fecha="$(date +%m%d%y)"
	#echo [ $fecha ]  procesando $i >> logs/registrar_logs.txt
       
        echo $i | php ../../procesarCatalogoOnix.php
        mv $i "bk/$i"  &2>>logs/registrar_logs.txt 
done
echo "\n\n fin de programa de registro\n\n"
