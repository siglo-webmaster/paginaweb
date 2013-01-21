<?php

/**
 * Description of classsmodelShoppingcar
 *
 * @author oborja
 */
require_once('app/tirant/model/modelSHTirant.php');

class classsmodelShoppingCar extends modelSHTirant{
    
    function getCarTotales($car){
        unset($this->data);
        $impreso=$ebook=$valor=0;
        if(sizeof($car->productos->producto)>0){
            foreach($car->productos->producto as $producto){
                $temp = $this->getdetallesItem($producto->id_titulos);
                if($temp==false)continue;
                $impreso+=$producto->detalle->impreso;
                $ebook+=$producto->detalle->ebook;
                $valor+=($temp[0]['precio']*($producto->detalle->impreso+$producto->detalle->ebook));
            }
        }
        $this->data=array('impreso'=>$impreso,'ebook'=>$ebook,'valor'=>$valor);
    }
    

    function addtoCar($car,$request,$moneda = 1){
        unset($this->data);
        $this->data = $car;
        $temp = explode(';',$request);
        if(!is_array($temp))return false;
        $i=0;
        foreach ($temp as $row){
            if(strlen($row)>0){
                $temp2 = explode(',',$row);
                $titulos[$i]['id_titulos']=$temp2[0];
                $titulos[$i]['id_tipo_formato']=$temp2[1];
                $titulos[$i]['cantidad']=$temp2[2];
                $titulos[$i]['id_proveedor']=$temp2[3];
                $titulos[$i]['id_lista_precios']=$temp2[4];
                $i++;
                unset($temp2);
            }
            
        }
        if(!is_array($titulos))return false;
        
        foreach($titulos as $titulo){
            $issetTitulo=false;
            $issetFormato_proveedor=false;
            if(!sizeof($car->productos->producto)>0){
                $producto = $this->data->productos->addChild("producto");
                $producto->addChild('id_titulos',(int)$titulo['id_titulos']);
                $detalles = $producto->addChild('detalles');
                $this->nuevoNodo($detalles, $titulo);
                $issetTitulo=true;
            }else{
                foreach($this->data->productos->producto as $producto){
                   if(((int)$producto->id_titulos)==((int)$titulo['id_titulos'])){
                       $issetTitulo=true;
                       foreach($producto->detalles->item as $item){
                           if((((int)$item->id_tipo_formato)==((int)$titulo['id_tipo_formato']))&&(((int)$item->id_proveedor)==((int)$titulo['id_proveedor']))){
                               $item->cantidad = (int)$titulo['cantidad'];
                               $issetFormato_proveedor=true;
                           }
                       }
                       if(!$issetFormato_proveedor){
                           $this->nuevoNodo($detalles, $titulo);
                           $issetFormato_proveedor=true;
                       }
                   } 
                }
                if(!$issetTitulo){
                    $producto = $this->data->productos->addChild("producto");
                    $producto->addChild('id_titulos',(int)$titulo['id_titulos']);
                    $detalles = $producto->addChild('detalles');
                    $this->nuevoNodo($detalles, $titulo);
                    $issetTitulo=true;
                }
            }
        }

        return true;
    }
    
    function nuevoNodo($detalles,$titulo){
        $item = $detalles->addChild('item');
        $item->addChild('id_tipo_formato',(int)$titulo['id_tipo_formato']);
        $item->addChild('cantidad',(int)$titulo['cantidad']);
        $item->addChild('id_proveedor',(int)$titulo['id_proveedor']);
        $item->addChild('id_lista_precios',(int)$titulo['id_lista_precios']);
    }
    
    function listCar($car){
        unset($this->data);
        if(sizeof($car->productos->producto) > 0){
            $totalgeneral=$totalitems=$totalimpreso=$totalebook=0;
            $i=0;
            foreach($car->productos->producto as $producto){
                $this->getItems(array('id_titulos'=>$producto->id_titulos,'option'=>'getRegistro'));
                $temp[$i]=$this->data[0];
                foreach($producto->detalles->item as $item){
                     $posicion = (int) $item->id_tipo_formato;
                    if(isset($temp[$i]['tipo_producto'][$posicion]['precio'])){
                        $subtotal = $item->cantidad * $temp[$i]['tipo_producto'][$posicion]['precio'];
                    }else{
                        $subtotal=0;
                    }
                    $item->addChild('subtotal',$subtotal);
                    $item->addChild('moneda',$temp[$i]['tipo_producto'][$posicion]['moneda']);
                    $item->addChild('precio',$temp[$i]['tipo_producto'][$posicion]['precio']);
                    $item->addChild('nombre_formato',$temp[$i]['tipo_producto'][$posicion]['nombre']);
                }
                $temp[$i]['detalles'] = $producto->detalles;
                $i++;
            }
            $this->data = $temp;
            return true;
        }
        $this->data = false;
            return false;
    }
    
    function delfromCar($car,$item){
        unset($this->data);
        $this->data = $car;
        if(sizeof($this->data->productos->producto)>0){
            for($i=0;$i<sizeof($this->data->productos->producto);$i++){
                if((int)$this->data->productos->producto[$i]->id_titulos==(int)$item){
                    unset($this->data->productos->producto[$i]);

                }
            }
        }

    }
    
    
    function getItemfromCarXML($car,$item){
          if(sizeof($car->productos->producto)>0){
            for($i=0;$i<sizeof($car->productos->producto);$i++){
                if($car->productos->producto[$i]->id_titulos==$item){
                    return array('impreso'=>$car->productos->producto[$i]->detalle->impreso, 'ebook'=>$car->productos->producto[$i]->detalle->ebook);

                }
            }
        }
    }
    
    function getItemCar($car, $item){
        require_once("app/tirant/model/modelSHTirant.php");
        $classTirant = new modelSHTirant();
        $classTirant->getdetalleRegistro($item);

        $this->data = array('item'=>$classTirant->data[0],'car'=>$this->getItemfromCarXML($car, $item));
        
        return;
    }
    
    function saveeditItemCar($request,$car){
        $this->data = $car;
        if(sizeof($this->data->productos->producto)>0){
            for($i=0;$i<sizeof($this->data->productos->producto);$i++){
                if($this->data->productos->producto[$i]->id_titulos==$request['iditem']){
                    $this->data->productos->producto[$i]->detalle->impreso = (isset($request['fimpreso']))?$request['imcant']:0;
                    $this->data->productos->producto[$i]->detalle->ebook = (isset($request['felectronico']))?$request['fecant']:0;
                }
            }
        }
    }

}

?>
