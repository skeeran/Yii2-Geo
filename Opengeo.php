<?php

/** 
 *		Released for Yii 2.0
 *      Nakkeeran Sathasivam			
 * 		http://www.sathadev.com
 * 		ns@sathadev.com			
 */

namespace skeeran\opengeo;


use yii\base\Component;
use yii\base\InvalidConfigException;


class Opengeo extends Component
{
    public $apiHost;     
    public $apiKey;   


    /**
     * Sets up Geo confiquration from config file
     * @throws \yii\base\InvalidConfigException
     */
    public function init(){
    	
    	foreach (['apiHost','apiKey'] as $attribute) {

    		if($this->$attribute === null){
    			throw new InvalidConfigException(strtr('"{class}::{attribute}" cannot be empty.',[
    				'{class}' => static::className(),
    				'{attribute}' => '$' .$attribute

    			]));
    		}
    	}
    	parent::init();
    }
    

    /**
     * Getgeocode for address
     */

    public function getgeocode($street_nr, $plz, $stadt)
    {

        if($street_nr != '' && $plz != '' && $stadt)
        {
            $adress = 'address='.urlencode($plz.' '.$stadt.' '.$street_nr);
            $request = $this->apiHost.''.$adress;

            $xml = simplexml_load_file($request) or die("url not loading");

            return $xml->result->geometry->location;
        }
    }
}

?>
