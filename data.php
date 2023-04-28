<?php
error_reporting(E_ALL);
$curl = curl_init();
$orginal_rss = $_REQUEST['rss'];
$url = "http://mtaedu.in/rss_abp.php?orginal_rss=" . $orginal_rss;

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    )
);

$response = curl_exec($curl);


curl_close($curl);
$xmlDoc = new DOMDocument();
$xmlDoc->load($response);
$searchNode = $xmlDoc->getElementsByTagName("item");

$response = str_replace("media:thumbnail", "thumbnail", $response);
$xmlData = simplexml_load_string($response);

$namespace = "http://search.yahoo.com/mrss/";
foreach ($xmlData->channel->item as $item) {

    ?>

    <div class="">
        <div class="col-sm-3">


            <div class="thumbnail">
                <img src="<?php echo $item->thumbnail['url']; ?>" alt="image1">
                <p class="movie" style="text-align: center;">
                    <?php echo $item->title ?>
                </p>
            </div>


        </div>
    </div>

    <?php
}
?>
