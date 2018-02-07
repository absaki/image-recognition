<?php
        // APIキー
        $tempfile = $_FILES['uppic']['tmp_name'];
        $filename = './upload/' . $_FILES['uppic']['name'];
        $apiKey = AIzaSyA0hM6XL_TEZdn4u6exSUe71nEqPlAyVuk;

        // 画像ファイル名
        $imageNm = $_FILES['uppic']['tmp_name'];

        if (is_uploaded_file($tempfile)) {
                        // リクエスト用json作成
                        $json = json_encode(array(
                                "requests" => array(
                                        array(
                                                "image" => array(
                                                        "content" => base64_encode(file_get_contents($tempfile)),
                                                ),
                                                "features" => array(
                                                        array(
                                                                "type" => "LABEL_DETECTION",
                                                                "maxResults" => 1,
                                                        ),
                                                ),
                                        ),
                                ),
                        ));

        // 各種オプションを設定
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $apiKey); // Google Cloud Vision APIのURLを設定
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // curl_execの結果を文字列で取得
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // サーバ証明書の検証を行わない
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); // POSTでリクエストする
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); // 送信するHTTPヘッダーの設定
        curl_setopt($curl, CURLOPT_TIMEOUT, 15); // タイムアウト時間の設定（秒）
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json); // 送信するjsonデータを設定

        // curl実行
        $res = curl_exec($curl);
        $data = json_decode($res, true);
        curl_close($curl);


        // 結果を表示
        print $data["responses"][0]["labelAnnotations"][0]["description"];
        print "\n";
        move_uploaded_file($tempfile , $filename );
     } else {
    echo "ファイルが選択されていません。";
}
?>
~                                                                                                                                                                                                                      
~                                                                                                                                                                                                                      
~                                                                                                                                                                                                                      
~                                                                                                                                                                                                                      
~                                                                                                                                                                                                                      
~                                       
