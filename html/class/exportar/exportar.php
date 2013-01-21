<?php
class classExportar {
    
    public $xml;
    public $conn;
    public $status;
    public $export;
    public $separador;
    public $paginador;
    
    function __construct(){
        $this->separador='"~"';
        $this->paginador='#@#';
        try{
            $this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->status=true;
        }catch (PDOException $e){
            echo $e->getMessage();
            echo "\nERROR DE CARGA [".__LINE__."]: no detabase connect";
            sleep(60);
            exit(0);
        }
        
        $param = $this->getInput();
        
        if($param){
           switch($param){
               case 'siglo':{
                   echo "\nExportar a siglo [".__LINE__."]\n";
                   $titulos = $this->getTitulos();
                   foreach($titulos as $row){
                       $this->storeTitulosforSiglo($row['xml']);
                   }
                   
                   
               }
           } 
           echo "\nProceso finalizado\n\n";
           return (0);
           
        }else{
            echo "\nERROR DE CARGA [".__LINE__."]: no param";
            sleep(60);
             exit(0);
        }
        
        
        
        $this->procesarXml();
         exit(0);
        
    }
    
    function getInput() {
        $fr = fopen("php://stdin", "r");
        $input = '';
        while (!feof ($fr)) {
            $input .= fgets($fr);
        }
        fclose($fr);
        $input = trim($input);
        return (sizeof($input)>0)?$input:false;
    }
    
    
    function getTitulos(){
        try{
            $estado ='activo';
            $query = "select t.id_titulos, ta.valor as xml from titulos as t
                        inner join titulos_atributos as ta on ta.id_titulos=t.id_titulos and ta.llave='xml' 
                        where t.estado=:estado ";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':estado',$estado,PDO::PARAM_STR);
            
            $conn_prepare->execute();
            
            $titulos = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
            
            return $titulos;
            
        }  catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
        
    }

    function storeTitulosforSiglo($data){
                unset($this->xml);
                try{
                    $this->xml = new SimpleXMLElement($data);
                }  catch(Exception $e){
                    return 0;
                }
                
                
                $this->export=$this->paginador;
                
                $this->export.=$this->separador;
		$this->export.= trim(strip_tags($this->xml->Product->RecordReference));
                $this->export.=$this->separador;
		
		$this->export.= trim($this->xml->Product->NotificationType); 
		$this->export.=$this->separador;

		$this->export.= trim($this->xml->Product->ProductIdentifier);
		$this->export.=$this->separador;
				
		$this->export.= trim($this->xml->Product->ProductIdentifier->ProductIDType);
		$this->export.=$this->separador;

		$this->export.= trim(strip_tags($this->xml->Product->ProductIdentifier->IDValue));
		$this->export.=$this->separador;

		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->ProductForm));
		$this->export.=$this->separador;

		$this->export.= "XXX"; //EpubType
		$this->export.=$this->separador;
		
		$this->export.= "XXX"; //EpubFormat
		$this->export.=$this->separador;

		$this->export.= "XXX"; //EpubFormatDescription
		$this->export.=$this->separador;

		$this->export.= "XXX"; //TITLE
		$this->export.=$this->separador;

		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->TitleDetail->TitleType));
		$this->export.=$this->separador;
		 
		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->TitleDetail->TitleElement->TitleText));
		$this->export.=$this->separador;	 	
		
		$this->export.= "XXX"; //Subtitle
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->DescriptiveDetail->Contributor);
		$this->export.=$this->separador;	 	
		
		$this->export.= trim($this->xml->Product->DescriptiveDetail->Contributor->ContributorRole);
		$this->export.=$this->separador;

		
		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->Contributor->PersonName));
		$this->export.=$this->separador;

		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->Contributor->BiographicalNote));
		$this->export.=$this->separador;

		$this->export.= "XXX"; //Language
		$this->export.=$this->separador;

		$this->export.= trim($this->xml->Product->DescriptiveDetail->Language->LanguageRole);
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->DescriptiveDetail->Language->LanguageCode);
		$this->export.=$this->separador;

		$this->export.= trim($this->xml->Product->ContentDetail->ContentItem->TextItem->NumberOfPages);
		$this->export.=$this->separador;

		$this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->MainSubject);
		$this->export.=$this->separador;
		
		$this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->SubjectSchemeIdentifier);
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->SubjectCode);
		$this->export.=$this->separador;


		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->Subject->SubjectHeadingText));
		$this->export.=$this->separador;


		$this->export.= "XXX"; //MEDIAFILE
		$this->export.=$this->separador;
		
		$this->export.= "XXX"; //MediaFileTypeCode
		$this->export.=$this->separador;

		$this->export.= "XXX"; //MediaFileFormatCode
		$this->export.=$this->separador;


		$this->export.= "XXX"; //MediaFileLinkTypeCode
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->CollateralDetail->SupportingResource->ResourceVersion->ResourceLink);
		$this->export.=$this->separador;


		$this->export.= "XXX"; //PUBLISHER
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->PublishingDetail->Publisher->PublishingRole);
		$this->export.=$this->separador;

		$this->export.= trim(strip_tags($this->xml->Product->PublishingDetail->Publisher->PublisherName));
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->PublishingDetail->CountryOfPublication);
		$this->export.=$this->separador;

		$this->export.= trim($this->xml->Product->PublishingDetail->PublishingStatus);
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->PublishingDetail->PublishingDate->Date);
		$this->export.=$this->separador;

		$this->export.= "XXX"; //EXTENT
		$this->export.=$this->separador;
                
                $this->export.= trim($this->xml->Product->DescriptiveDetail->Extent->ExtentType);
		$this->export.=$this->separador;

                $this->export.= trim($this->xml->Product->DescriptiveDetail->Extent->ExtentValue);
		$this->export.=$this->separador;
                
                $this->export.= trim($this->xml->Product->DescriptiveDetail->Extent->ExtentUnit);
		$this->export.=$this->separador;
                
                
                $this->export.= "XXX"; //SALESRESTRICTION
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //SalesRestrictionType
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //SalesRestrictionDetail
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //SERIES
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //TitleOfSeries
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //SERIESIDENTIFIER
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //SeriesIDType
		$this->export.=$this->separador;
                
                
                $this->export.= "XXX"; //SeriesIDValue
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //OTHERTEXT
		$this->export.=$this->separador;
                
                
                $this->export.= trim($this->xml->Product->CollateralDetail->TextContent->TextType);
		$this->export.=$this->separador;
              
                $this->export.= "XXX"; //TextFormat
		$this->export.=$this->separador;   
                
                $this->export.= trim($this->xml->Product->CollateralDetail->TextContent->Text);
		$this->export.=$this->separador;   
                
                $this->export.= "XXX"; //SUPPLYDETAIL
		$this->export.=$this->separador;   
                
                $this->export.= trim($this->xml->Product->ProductSupply->SupplyDetail->Supplier->SupplierName);
		$this->export.=$this->separador;
                
                $this->export.= trim($this->xml->Product->ProductSupply->SupplyDetail->ProductAvailability);
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //PRICE
		$this->export.=$this->separador;   
                
                $this->export.= trim($this->xml->Product->ProductSupply->SupplyDetail->Price->PriceType);
		$this->export.=$this->separador;
                
                
                $this->export.= number_format(trim($this->xml->Product->ProductSupply->SupplyDetail->Price->PriceAmount) * 1814.83);
		$this->export.=$this->separador;
                
                $this->export.= trim($this->xml->Product->PublishingDetail->CountryOfPublication);
		$this->export.=$this->separador;   
                
                $this->export.= trim($this->xml->Product->ProductSupply->SupplyDetail->Price->CurrencyCode);
		$this->export.=$this->separador;
                
                $this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->SubjectHeadingText);
		$this->export.=$this->separador;   
                
                $this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->SubjectSchemeIdentifier);
		$this->export.=$this->separador;
                
                
                $this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->SubjectCode);
		$this->export.=$this->separador;
                
                $this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->SubjectHeadingText);
		$this->export.=$this->separador;
                
                $this->export.= "XXX"; //IDTypeName
		$this->export.=$this->separador;
                
                //////politicas de proteccion y derechos de uso
                $this->export.= trim($this->xml->Product->DescriptiveDetail->EpubTechnicalProtection);
		$this->export.=$this->separador;
                
                $politica_uso ="";
                foreach($this->xml->Product->DescriptiveDetail->EpubUsageConstrain as $constaint){
                    $politica_uso .= $constaint->EpubUsageType .'-'. $constaint->EpubUsageStatus .'-'. $constaint->EpubUsageLimit->Quantity.'-'.$constaint->EpubUsageLimit->EpubUsageUnit.'*';
                }
                
                $this->export.= trim($this->xml->Product->DescriptiveDetail->EpubTechnicalProtection,'*');
		$this->export.=$this->separador;
                
                
                $this->export.=$this->paginador;
                
		echo $this->export;
        
    }
    
   
    
     
}
?>
