#!/bin/sh

for SRC in `find . -depth`
do
    DST=`dirname "${SRC}"`/`basename "${SRC}" | tr '[A-Z]' '[a-z]'`
    if [ "${SRC}" != "${DST}" ]
    then
        [ ! -e "${DST}" ] && mv -T "${SRC}" "${DST}" || echo "${SRC} was not renamed"
    fi
done

echo Inicio programa de registro >> logs/registrar_logs.txt

for i in $(ls *.txt); do
	fecha="$(date +%Y-%m-%d_%T_)"
	echo [ $fecha ]  procesando $i >> logs/registrar_logs.txt
        echo $i | php ../../actualizarInventario.php
        mv $i "procesados/"$fecha"$i"  &2>>logs/registrar_logs.txt 

done
echo fin de programa de registro
