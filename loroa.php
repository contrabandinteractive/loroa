<?php

require_once "vendor/autoload.php";
require_once "Mobile_Detect.php";
$detect = new Mobile_Detect;
use Aws\Polly\PollyClient;
use Aws\Translate\TranslateClient;
use Aws\Exception\AwsException;

//Create a Translate Client
$client = new Aws\Translate\TranslateClient([
    'region' => 'us-east-2',
    'version' => 'latest',
    'credentials' => [
        'key' => 'YOUR KEY',
        'secret' => 'YOUR SECRET',
        ]
]);

$loroa_currentLanguage = $_POST['sourceLang'];
$loroa_numberOfLangs = 0;
if(isset($_POST['targetLang1'])){
  $loroa_targetLanguage1 = $_POST['targetLang1'];
  $loroa_numberOfLangs++;
}

if(isset($_POST['targetLang2'])){
  $loroa_targetLanguage2 = $_POST['targetLang2'];
  $loroa_numberOfLangs++;
}

if(isset($_POST['targetLang3'])){
  $loroa_targetLanguage3 = $_POST['targetLang3'];
  $loroa_numberOfLangs++;
}

$loroa_targetLanguage1Voice;
$loroa_targetLanguage2Voice;
$loroa_targetLanguage3Voice;
$loroa_gender = $_POST['gender'];
$loroa_sourceText = $_POST['text'];
$loroa_finalText1;
$loroa_finalText2;
$loroa_finalText3;

$PollyConfig = [
    'version' => 'latest',
    'region' => 'us-east-2',
    'credentials' => [
        'key' => 'YOUR KEY HERE',
        'secret' => 'YOUR SECRET HERE',
        ]
    ];

    // Determine language and gender for language 1
    switch($loroa_targetLanguage1){
      case "en":
        if($loroa_gender=="m"){
          //Male
          $loroa_targetLanguage1Voice = "Matthew";
        }else{
          //Female
          $loroa_targetLanguage1Voice = "Joanna";
        }
      break;

      case "es":
        if($loroa_gender=="m"){
          //Male
          $loroa_targetLanguage1Voice = "Miguel";
        }else{
          //Female
          $loroa_targetLanguage1Voice = "Lupe";
        }
      break;

      case "ar":
        $loroa_targetLanguage1Voice = "Zeina";
      break;

      case "de":
        if($loroa_gender=="m"){
          //Male
          $loroa_targetLanguage1Voice = "Hans";
        }else{
          //Female
          $loroa_targetLanguage1Voice = "Marlene";
        }
      break;

      case "fr":
        if($loroa_gender=="m"){
          //Male
          $loroa_targetLanguage1Voice = "Mathieu";
        }else{
          //Female
          $loroa_targetLanguage1Voice = "Celine";
        }
      break;

      case "pt":
        if($loroa_gender=="m"){
          //Male
          $loroa_targetLanguage1Voice = "Ricardo";
        }else{
          //Female
          $loroa_targetLanguage1Voice = "Camila";
        }
      break;

      case "zh":
        $loroa_targetLanguage1Voice = "Zhiyu";
      break;
    }

    // Determine language and gender for language 2
        switch($loroa_targetLanguage2){
          case "en":
            if($loroa_gender=="m"){
              //Male
              $loroa_targetLanguage2Voice = "Matthew";
            }else{
              //Female
              $loroa_targetLanguage2Voice = "Joanna";
            }
          break;

          case "es":
            if($loroa_gender=="m"){
              //Male
              $loroa_targetLanguage2Voice = "Miguel";
            }else{
              //Female
              $loroa_targetLanguage2Voice = "Lupe";
            }
          break;

          case "ar":
            $loroa_targetLanguage2Voice = "Zeina";
          break;

          case "de":
            if($loroa_gender=="m"){
              //Male
              $loroa_targetLanguage2Voice = "Hans";
            }else{
              //Female
              $loroa_targetLanguage2Voice = "Marlene";
            }
          break;

          case "fr":
            if($loroa_gender=="m"){
              //Male
              $loroa_targetLanguage2Voice = "Mathieu";
            }else{
              //Female
              $loroa_targetLanguage2Voice = "Celine";
            }
          break;

          case "pt":
            if($loroa_gender=="m"){
              //Male
              $loroa_targetLanguage2Voice = "Ricardo";
            }else{
              //Female
              $loroa_targetLanguage2Voice = "Camila";
            }
          break;

          case "zh":
            $loroa_targetLanguage2Voice = "Zhiyu";
          break;
        }

        // Determine language and gender for language 3
            switch($loroa_targetLanguage3){
              case "en":
                if($loroa_gender=="m"){
                  //Male
                  $loroa_targetLanguage3Voice = "Matthew";
                }else{
                  //Female
                  $loroa_targetLanguage3Voice = "Joanna";
                }
              break;

              case "es":
                if($loroa_gender=="m"){
                  //Male
                  $loroa_targetLanguage3Voice = "Miguel";
                }else{
                  //Female
                  $loroa_targetLanguage3Voice = "Lupe";
                }
              break;

              case "ar":
                $loroa_targetLanguage3Voice = "Zeina";
              break;

              case "de":
                if($loroa_gender=="m"){
                  //Male
                  $loroa_targetLanguage3Voice = "Hans";
                }else{
                  //Female
                  $loroa_targetLanguage3Voice = "Marlene";
                }
              break;

              case "fr":
                if($loroa_gender=="m"){
                  //Male
                  $loroa_targetLanguage3Voice = "Mathieu";
                }else{
                  //Female
                  $loroa_targetLanguage3Voice = "Celine";
                }
              break;

              case "pt":
                if($loroa_gender=="m"){
                  //Male
                  $loroa_targetLanguage3Voice = "Ricardo";
                }else{
                  //Female
                  $loroa_targetLanguage3Voice = "Camila";
                }
              break;

              case "zh":
                $loroa_targetLanguage3Voice = "Zhiyu";
              break;
            }

    switch($loroa_numberOfLangs){
      case 3:

        try {
          $result = $client->translateText([
              'SourceLanguageCode' => $loroa_currentLanguage,
              'TargetLanguageCode' => $loroa_targetLanguage3,
              'Text' => $loroa_sourceText,
          ]);
          //var_dump($result);
          $loroa_finalText3 = $result['TranslatedText'];
        }catch (AwsException $e) {
          // output error message if fails
          echo $e->getMessage();
          //$textToTranslate = $e->getMessage();
          echo "\n";
        }

        try {
          $result = $client->translateText([
              'SourceLanguageCode' => $loroa_currentLanguage,
              'TargetLanguageCode' => $loroa_targetLanguage2,
              'Text' => $loroa_sourceText,
          ]);
          //var_dump($result);
          $loroa_finalText2 = $result['TranslatedText'];
        }catch (AwsException $e) {
          // output error message if fails
          echo $e->getMessage();
          //$textToTranslate = $e->getMessage();
          echo "\n";
        }

        try {
          $result = $client->translateText([
              'SourceLanguageCode' => $loroa_currentLanguage,
              'TargetLanguageCode' => $loroa_targetLanguage1,
              'Text' => $loroa_sourceText,
          ]);
          //var_dump($result);
          $loroa_finalText1 = $result['TranslatedText'];
        }catch (AwsException $e) {
          // output error message if fails
          echo $e->getMessage();
          //$textToTranslate = $e->getMessage();
          echo "\n";
        }

        // Generate speech from texts 1, 2 and 3
        try {
            $config = $PollyConfig;
            $client = new PollyClient($config);
            $args = [
                'OutputFormat' => 'mp3',
                'Text' => '<speak>' . $loroa_finalText3 . '</speak>',
                'TextType' => 'ssml',
                'VoiceId' => $loroa_targetLanguage3Voice, //pass preferred voice id here
            ];
            $result = $client->synthesizeSpeech($args);
            $resultData = $result->get('AudioStream')->getContents();
            $final_file3 = "outputfolder/output-" . strval(rand(1, 999999)) . strval(rand(1, 9999)) . ".mp3";
            file_put_contents($final_file3, $resultData);

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        try {
            $config = $PollyConfig;
            $client = new PollyClient($config);
            $args = [
                'OutputFormat' => 'mp3',
                'Text' => '<speak>' . $loroa_finalText2 . '</speak>',
                'TextType' => 'ssml',
                'VoiceId' => $loroa_targetLanguage2Voice, //pass preferred voice id here
            ];
            $result = $client->synthesizeSpeech($args);
            $resultData = $result->get('AudioStream')->getContents();
            $final_file2 = "outputfolder/output-" . strval(rand(1, 999999)) . strval(rand(1, 9999)) . ".mp3";
            file_put_contents($final_file2, $resultData);

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        try {
            $config = $PollyConfig;
            $client = new PollyClient($config);
            $args = [
                'OutputFormat' => 'mp3',
                'Text' => '<speak>' . $loroa_finalText1 . '</speak>',
                'TextType' => 'ssml',
                'VoiceId' => $loroa_targetLanguage1Voice, //pass preferred voice id here
            ];
            $result = $client->synthesizeSpeech($args);
            $resultData = $result->get('AudioStream')->getContents();
            $final_file1 = "outputfolder/output-" . strval(rand(1, 999999)) . strval(rand(1, 9999)) . ".mp3";
            file_put_contents($final_file1, $resultData);

        } catch(Exception $e) {
            echo $e->getMessage();
        }


        // Zip files
        $zip = new ZipArchive;
        $file = Array();
        $zipFileName = 'outputfolder/output-' . strval(rand(1, 999999)) . strval(rand(1, 9999)) . '.zip';
        $zip->open($zipFileName,  ZipArchive::CREATE);
        $zip->addFile($final_file1, 'translation_' . $loroa_targetLanguage1 . '.mp3');
        $zip->addFile($final_file2, 'translation_' . $loroa_targetLanguage2 . '.mp3');
        $zip->addFile($final_file3, 'translation_' . $loroa_targetLanguage3 . '.mp3');
        $zip->close();
        echo 'http://52.15.100.90/loroa/' . $zipFileName;



      break;

      case 2:

        try {
          $result = $client->translateText([
              'SourceLanguageCode' => $loroa_currentLanguage,
              'TargetLanguageCode' => $loroa_targetLanguage2,
              'Text' => $loroa_sourceText,
          ]);
          //var_dump($result);
          $loroa_finalText2 = $result['TranslatedText'];
        }catch (AwsException $e) {
          // output error message if fails
          echo $e->getMessage();
          //$textToTranslate = $e->getMessage();
          echo "\n";
        }

        try {
          $result = $client->translateText([
              'SourceLanguageCode' => $loroa_currentLanguage,
              'TargetLanguageCode' => $loroa_targetLanguage1,
              'Text' => $loroa_sourceText,
          ]);
          //var_dump($result);
          $loroa_finalText1 = $result['TranslatedText'];
        }catch (AwsException $e) {
          // output error message if fails
          echo $e->getMessage();
          //$textToTranslate = $e->getMessage();
          echo "\n";
        }

        // Generate speech from texts 1 and 2
        try {
            $config = $PollyConfig;
            $client = new PollyClient($config);
            $args = [
                'OutputFormat' => 'mp3',
                'Text' => '<speak>' . $loroa_finalText2 . '</speak>',
                'TextType' => 'ssml',
                'VoiceId' => $loroa_targetLanguage2Voice, //pass preferred voice id here
            ];
            $result = $client->synthesizeSpeech($args);
            $resultData = $result->get('AudioStream')->getContents();
            $final_file2 = "outputfolder/output-" . strval(rand(1, 999999)) . strval(rand(1, 9999)) . ".mp3";
            file_put_contents($final_file2, $resultData);

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        try {
            $config = $PollyConfig;
            $client = new PollyClient($config);
            $args = [
                'OutputFormat' => 'mp3',
                'Text' => '<speak>' . $loroa_finalText1 . '</speak>',
                'TextType' => 'ssml',
                'VoiceId' => $loroa_targetLanguage1Voice, //pass preferred voice id here
            ];
            $result = $client->synthesizeSpeech($args);
            $resultData = $result->get('AudioStream')->getContents();
            $final_file1 = "outputfolder/output-" . strval(rand(1, 999999)) . strval(rand(1, 9999)) . ".mp3";
            file_put_contents($final_file1, $resultData);

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        // Zip files
        $zip = new ZipArchive;
        $file = Array();
        $zipFileName = 'outputfolder/output-' . strval(rand(1, 999999)) . strval(rand(1, 9999)) . '.zip';
        $zip->open($zipFileName,  ZipArchive::CREATE);
        $zip->addFile($final_file1, 'translation_' . $loroa_targetLanguage1 . '.mp3');
        $zip->addFile($final_file2, 'translation_' . $loroa_targetLanguage2 . '.mp3');
        $zip->close();
        echo 'http://52.15.100.90/loroa/' . $zipFileName;

      break;

      default:

        // Translate text
        try {
          $result = $client->translateText([
              'SourceLanguageCode' => $loroa_currentLanguage,
              'TargetLanguageCode' => $loroa_targetLanguage1,
              'Text' => $loroa_sourceText,
          ]);
          //var_dump($result);
          $loroa_finalText1 = $result['TranslatedText'];
        }catch (AwsException $e) {
          // output error message if fails
          echo $e->getMessage();
          //$textToTranslate = $e->getMessage();
          echo "\n";
        }

        // Generate speech from text 1
        try {
            $config = $PollyConfig;
            $client = new PollyClient($config);
            $args = [
                'OutputFormat' => 'mp3',
                'Text' => '<speak>' . $loroa_finalText1 . '</speak>',
                'TextType' => 'ssml',
                'VoiceId' => $loroa_targetLanguage1Voice, //pass preferred voice id here
            ];
            $result = $client->synthesizeSpeech($args);
            $resultData = $result->get('AudioStream')->getContents();
            $final_file = "outputfolder/output-" . strval(rand(1, 999999)) . strval(rand(1, 9999)) . ".mp3";
            file_put_contents($final_file, $resultData);


            if(isset($_POST['frontend'])){
              // If on mobile, play mp3 file in browser.
              if ( $detect->isMobile() ) {
                echo '<script>window.location.href = "http://52.15.100.90/loroa/' . $final_file . '";</script>';
              }else{
                header('Content-length: ' . strlen($resultData));
                header('Content-Disposition: attachment; filename="translation_' . $loroa_targetLanguage1 . '.mp3"');
                header('X-Pad: avoid browser bug');
                header('Cache-Control: no-cache');
                echo $resultData;
              }
            }else{
              echo 'http://52.15.100.90/loroa/' . $final_file;
            }


        } catch(Exception $e) {
            echo $e->getMessage();
        }

      break;
    }


?>
