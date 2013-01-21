<?php

define('_CABECERAONIX','﻿<?xml version="1.0" encoding="utf-8"?>
<ONIXMessage release="3.0" xmlns="http://www.editeur.org/onix/3.0/reference">
  <Header>
    <Sender>
      <SenderName>PUBLIDISA</SenderName>
    </Sender>
    <Addressee>
      <AddresseeName>Publidisa.com</AddresseeName>
    </Addressee>
    <SentDateTime>20110602</SentDateTime>
  </Header>');

define ('_PIEONIX','</ONIXMessage>');

class classOnixV3 {
    
    public $xml;
    public $separador;
    public $paginador;
    public $export;
    function __construct(){
        $param = $this->getInput();
        if($param){
            $file = $this->fileRequest($param);
            if(!$file){exit(1);}
            $this->xml = simplexml_load_string ($file);
        }else{ exit(0);}
        
        
        
	//$this->separador='"~"';
        //$this->paginador='#@#';
        
        $this->separador='<td>';
        $this->paginador='</tr><tr>';
        
	$this->generarEntrada();

	//	var_dump($this->xml);
	return;
    }
    
    function generarEntrada(){

                $this->export=$this->paginador;
                
                $this->export.=$this->separador;
		$this->export.= trim(strip_tags($this->xml->Product->RecordReference));
                $this->export.=$this->separador;
		
/*		$this->export.= trim($this->xml->Product->NotificationType); 
		$this->export.=$this->separador;

		$this->export.= trim($this->xml->Product->ProductIdentifier);
		$this->export.=$this->separador;
				
		$this->export.= trim($this->xml->Product->ProductIdentifier->ProductIDType);
		$this->export.=$this->separador;
*/
		$this->export.= trim(strip_tags($this->xml->Product->ProductIdentifier->IDValue));
		$this->export.=$this->separador;

//		$this->export.= trim($this->xml->Product->DescriptiveDetail->ProductForm);
//		$this->export.=$this->separador;

//		$this->export.= "XXX"; //EpubType
//		$this->export.=$this->separador;
		
//		$this->export.= "XXX"; //EpubFormat
//		$this->export.=$this->separador;

//		$this->export.= "XXX"; //EpubFormatDescription
//		$this->export.=$this->separador;

//		$this->export.= "XXX"; //TITLE
//		$this->export.=$this->separador;

//		$this->export.= trim($this->xml->Product->DescriptiveDetail->TitleDetail->TitleType);
//		$this->export.=$this->separador;
		 
		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->TitleDetail->TitleElement->TitleText));
		$this->export.=$this->separador;	 	
		
/*		$this->export.= "XXX"; //Subtitle
		$this->export.=$this->separador;


		$this->export.= trim($this->xml->Product->DescriptiveDetail->Contributor);
		$this->export.=$this->separador;	 	
		
		$this->export.= trim($this->xml->Product->DescriptiveDetail->Contributor->ContributorRole);
		$this->export.=$this->separador;
*/
		
		$this->export.= trim(strip_tags($this->xml->Product->DescriptiveDetail->Contributor->PersonName));
		$this->export.=$this->separador;

/*		$this->export.= trim($this->xml->Product->DescriptiveDetail->Contributor->BiographicalNote);
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


		$this->export.= trim($this->xml->Product->DescriptiveDetail->Subject->SubjectHeadingText);
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
*/
		$this->export.= trim(strip_tags($this->xml->Product->PublishingDetail->Publisher->PublisherName));
		$this->export.=$this->separador;
/*

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
  */              
                
                $this->export.= number_format(trim($this->xml->Product->ProductSupply->SupplyDetail->Price->PriceAmount) * 1814.83);
		//$this->export.=$this->separador;
                
    /*            $this->export.= trim($this->xml->Product->PublishingDetail->CountryOfPublication);
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
                
      */          $this->export.=$this->paginador;
                
		echo $this->export;

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
    
    function fileRequest($file){
        $f = false;
        try{
            $f = file_get_contents($file);
            if(!$f){
                echo "archivo no encontrado";
            }else{
                $f = rtrim($f,_PIEONIX);
                $f = _CABECERAONIX.$f._PIEONIX;
            }
            
        }catch (Exception $e){
            echo $e->getMessage();
        }
        return $f;
    }
   
}

$onix = new classOnixV3();
?>
