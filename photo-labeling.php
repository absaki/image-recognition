<?php
$apiKey = XXXXXXXXXXXXXXXXXXX;
$apiUrl = "https://vision.google.com/v1/images:anotate?key=";
$imageName = argv[0];

if(is_uploaded_file($imageName)){

    $requestsArray = array(
        "requests" =>array(
            array(
                "image" => array(
                    "content" => base64_encode($imageName),
                ),
                "features" => array(
                    array(
                        "type" => "LABEL_DETECTION",
                        "maxResults" => 5,
                    ),
                ),
            ),
        ),
    );
    $requestsJson = json_encode($requestsArray);

    $curl = curl_init();
    curl_setopt($curl,CURLOPT_POSTFIELD,$requestsJson);
    curl_setopt($curl,CURL_OPTURL,$apiUrl.$apiKey);
    curl_setopt($curl,CURL_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type: application/json"));
    curl_setopt($curl,CURLOPT_TIMEOUT,10);

    $responseJson = curl_exec($curl);
    $response = json_decode($responseJson,true);
    
    curl_close($curl);

    echo $response["responses"][0]["labelAnotations"][0]["description"];
    echo "\n";
    
}else{
    echo "引数が正しくありません．";
}


        
