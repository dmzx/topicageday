<?php
/**
* @package Topic Age Day Extension
* @copyright (c) 2015 dmzx - http://dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

namespace dmzx\topicageday\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\user	$user
	*/
	public function __construct(\phpbb\user $user)
	{
		$this->user = $user;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.viewforum_modify_topicrow' => 'viewforum_modify_topicrow',
		);
	}

	public function viewforum_modify_topicrow($event)
	{
		//Add language
		$this->user->add_lang_ext('dmzx/topicageday', 'common');

		$topic_row = $event['topic_row'];
		$row	= $event['row'];
		$topic_row ['TOPIC_AGE_DAYS'] = $this->user->lang('TOPICAGEDAYPOSTED', round((time() - $row['topic_time']) / 86400));
		$event['topic_row'] = $topic_row;
	}
}
