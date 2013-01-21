#!/bin/sh
echo Inicio programa de registro >> logs/registrar_logs.txt

for i in $(ls parte.*); do
	fecha="$(date +%m%d%y)"
	#echo [ $fecha ]  procesando $i >> logs/registrar_logs.txt
        echo $i | php bridgeSiglo_html.php >> exportado.txt
        mv $i "bk/$i"  &2>>logs/registrar_logs.txt 
        echo "$i"
done
echo fin de programa de registro
