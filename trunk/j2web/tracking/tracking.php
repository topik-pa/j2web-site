<?php

//$eventCategory = '_trackEvent'; //required
$eventAction = $_GET['eventAction']; //required
$eventLabel = $_GET['eventLabel']; //optional
//$eventValue = $_GET['eventValue']; //optional

use UnitedPrototype\GoogleAnalytics;

require_once 'autoload.php';

// Initilize GA Tracker
$tracker = new GoogleAnalytics\Tracker('UA-45395985-1', 'j2webstudio.it');


// Assemble Visitor information
// (could also get unserialized from database)
$visitor = new GoogleAnalytics\Visitor();
$visitor->setIpAddress($_SERVER['REMOTE_ADDR']);
$visitor->setUserAgent($_SERVER['HTTP_USER_AGENT']);

// Assemble Session information
// (could also get unserialized from PHP session)
$session = new GoogleAnalytics\Session();

// Assemble Page information
$page = new GoogleAnalytics\Page('/tracking.php');
$page->setTitle('J2Web - User tracking');

// Track page view
$tracker->trackPageview($page, $session, $visitor);

//event
$event = new GoogleAnalytics\Event();
$event->setCategory('J2Web - user tracking');	//string, required
$event->setAction($eventAction);		//string, required
$event->setLabel($eventLabel);			//string, not required
$event->setValue(1);				//integer, not required
$event->setNoninteraction('true');
//track event
$tracker->trackEvent($event,$session,$visitor);

?>