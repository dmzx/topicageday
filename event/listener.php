<?php
/**
* @package Topic Age Day Extension
* @copyright (c) 2015 dmzx - http://dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

namespace dmzx\topicageday\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{

	static public function getSubscribedEvents()
	{

		return array(
			'core.user_setup' => 'load_language_on_setup',
			'core.viewforum_modify_topicrow' => 'viewforum_modify_topicrow',
		);
	}

	public function viewforum_modify_topicrow($event)
	{
		$topic_row = $event['topic_row'];
		$row	= $event['row'];
		$topic_row ['TOPIC_AGE_DAYS'] = round((time() - $row['topic_time']) / 86400);
		$event['topic_row'] = $topic_row;

	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'dmzx/topicageday',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}
}
