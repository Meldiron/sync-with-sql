<?php

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/utils.php');

use Appwrite\Client;
use Appwrite\Query;
use Appwrite\Services\Databases;

return function ($context) {
    throw_if_missing($_ENV, [
        'APPWRITE_API_KEY',
        'PDO_CONNECTION_STRING'
    ]);

    if ($context->req->method !== 'POST') {
        return $context->res->send('Not found', 404);
    }

    $client = new Client();
    $client
        ->setEndpoint('https://cloud.appwrite.io/v1')
        ->setProject($_ENV['APPWRITE_PROJECT_ID'])
        ->setKey($_ENV['APPWRITE_API_KEY']);

    $databases = new Databases($client);
    
    $databasesResponse = $databases->list([
        Query::limit(1000)
    ]);
    
    $context->log('Found databases: ' . \count($databasesResponse['databases']));
    
    foreach($databasesResponse['databases'] as $db) {
        $collectionsResponse = $databases->listCollections($db['$id'], [
            Query::limit(1000)
        ]);
        
        $context->log('Found collections: ' . \count($collectionsResponse['collections']));
        
        foreach($collectionsResponse['collections'] as $collection) {
            // TODO: Create if missing

            $documentsResponse = $databases->listDocuments($db['$id'], $collection['$id'], [
                Query::limit(1000000)
            ]);
            
            $context->log('Found documents: ' . \count($documentsResponse['documents']));
            
            foreach($documentsResponse['documents'] as $document) {
                // TODO: Insert
            }
            
            $context->log('Collection complete: ' . $collection['$id']);
        }
        
        $context->log('Database complete: ' . $db['$id']);
    }

    $context->log('Sync complete');

    return $context->res->send('Sync complete', 200);
};
