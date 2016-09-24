<?php
/*
* YouTube direct URL
 * Tag: <YouTubeURL>docid</YouTubeURL>

 * <YouTubeURL>http://docs.google.com/file/d/0B6yjbA3TP1ZfNU1pa2J4NVgyd3c/edit</YouTubeURL>
 * <YouTubeURL>https://drive.google.com/a/crossknowledge.com/file/d/0B6yjbA3TP1ZfNU1pa2J4NVgyd3c/view</YouTubeURL>
 * <YouTubeURL>0B6yjbA3TP1ZfNU1pa2J4NVgyd3c</YouTubeURL>



 * @author Kwiki
 * 
 */

$wgExtensionFunctions[] = 'wfYTU';
$wgExtensionCredits['parserhook'][] = array(
        'name' => 'YouTube URL',
        'version' => '0.1.0',
        'description' => 'embed youtube video from url',
        'author' => 'Kwiki. based on [[mw:Extension:GoogleImage|GoogleImage]] by Bertrand Gorge',
        'url' => 'http://www.kwiki.co.il'
);

function wfYTU()
{
	global $wgParser;

	$wgParser->setHook('YouTubeURL', 'renderYouTube');
}

# The callback function for converting the input text to HTML output
function renderYouTube($input)
{
	if (empty($input))
		return '';




	$matches = array();
	if (preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $input, $matches))
		$fileId = $matches[1];
	else
		$fileId = $input;

	$output = '<div class="videoWrapper"><iframe src="https://www.youtube.com/embed/'.htmlspecialchars($fileId).'" frameborder="0" allowfullscreen></iframe></div>';

    return $output;
}
