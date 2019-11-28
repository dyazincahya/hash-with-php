<?php 
    function _ch($hash, $message){
        switch (strtoupper($hash)) {
            case 'MD5':
                return hash('md5', $message);
                break;
            
            case 'SHA1':
                return hash('sha1', $message);
                break;
            
            case 'SHA224':
                return hash('sha224', $message);
                break;
            
            case 'SHA256':
                return hash('sha256', $message);
                break;
            
            case 'SHA512':
                return hash('sha512', $message);
                break;
            
            default:
                return hash('md5', $message);
                break;
        }
    }
?>