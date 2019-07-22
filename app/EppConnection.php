<?php

namespace App;

use AfriCC\EPP\Client as EPPClient;
use File;
use App\EppSetting;
use App\Zone;

class EppConnection{

    public function __construct()
    {   
        
    }

    public function loginEpp($zone = null,$is_epp_setting = false){
        $conn = new eppConnection();
        if($is_epp_setting == true){
            $epp_setting = EppSetting::where('target',$zone)->first();
        }else{
            $zone_db = Zone::with('epp')->where('zone',$zone)->first();
            if(!$zone_db){
                return response()->json([
                    'code' => 404,
                    'message' => 'EPP Connection Zone Not Found!'
                ]);
            }
            $epp_setting = $zone_db->epp;    
        }
        if(!$epp_setting){
            Abort(404);
        }
        $cert_path = public_path().'/storage/'.$epp_setting->ssl_key; // documents/uploads/pem-certificate/1562308029-ironman.pem
        if(!File::exists($cert_path)) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        $epp_client = new EPPClient([
            'host' => $epp_setting->host_name, // epp-dev.pandi.id
            'port' => $epp_setting->port, // 700
            'username' => $epp_setting->username, // ironman
            'password' => $epp_setting->password, // rahasia
            'services' => [
                'urn:ietf:params:xml:ns:domain-1.0',
                'urn:ietf:params:xml:ns:contact-1.0',
                'urn:ietf:params:xml:ns:host-1.0',
                'urn:ietf:params:xml:ns:epp-1.0'
            ],
            'local_cert' => $cert_path,
            'pass_phrase' => '',
            'ssl' => $epp_setting->ssl_active == 1 ? true : false,
            'debug' => false,
        ]);
        try {
            $epp_client->connect();
            return $epp_client;
        } catch(Exception $e) {
            dd($e);
        }
    }
    
    public function logoutEpp($epp_client){
        $epp_client->close();
    }
}