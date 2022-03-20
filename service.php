<?php
/**
 * Copyright 2018 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// [START tts_quickstart]
// includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

// Imports the Cloud Client Library
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

// instantiates a client
$client = new TextToSpeechClient();

// sets text to be synthesised
$synthesisInputText = (new SynthesisInput())
    ->setText('Ciao alessandro, che ne dici di questo audio? Nel nuovo programma, imposti il testo, spingi un tasto e poi ti genera un mp3. Ti piace?');

// build the voice request, select the language code ("en-US") and the ssml
// voice gender
$voice = (new VoiceSelectionParams())
    ->setLanguageCode('it-IT');
    ->setSsmlGender(SsmlVoiceGender::FEMALE);

// Effects profile
$effectsProfileId = 'telephony-class-application';

// select the type of audio file you want returned
$audioConfig = (new AudioConfig())
    ->setAudioEncoding(AudioEncoding::MP3)
    ->setEffectsProfileId(array($effectsProfileId));

// perform text-to-speech request on the text input with selected voice
// parameters and audio file type
$response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
$audioContent = $response->getAudioContent();

// the response's audioContent is binary
file_put_contents('output.mp3', $audioContent);

# [END tts_quickstart]
return $audioContent;
