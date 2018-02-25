<?php
$apiKey ="ｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘｘ";
$apiUrl = "https://vision.googleapis.com/v1/images:annotate?key=";
$imageName = $argv[1];
$resultNum = 5;

$requestsArray = array(
    "requests" =>array(
        array(
            "image" => array(
                "content" => base64_encode(file_get_contents($imageName)),
            ),
            "features" => array(
                array(
                    "type" => "LABEL_DETECTION",
                    "maxResults" => $resultNum,
                ),
            ),
        ),
    ),
);
$requestsJson = json_encode($requestsArray);

$curl = curl_init();
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl,CURLOPT_POSTFIELDS,$requestsJson);
curl_setopt($curl,CURLOPT_URL,$apiUrl.$apiKey);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_HTTPHEADER,array("Content-Type: application/json"));
curl_setopt($curl,CURLOPT_TIMEOUT,10);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);

$responseJson = curl_exec($curl);
$response = json_decode($responseJson,true);

curl_close($curl);

for($i = 0;$i < $resultNum;$i++){
echo $response["responses"][0]["labelAnnotations"][$i]["description"]."\n";
}
        
