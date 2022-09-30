<?php
class BBlight
{
	protected $bbcode_table = array();
    /**
     * Protected constructor since this is a static class.
     *
     * @access  protected
     */
	  public function __construct () {
		  
	    // Replace [code]...[/code] with <pre><code>...</code></pre>
	    $this->bbcode_table["/\[code\](.*?)\[\/code\]/is"] = function ($match) {
		  global $cur;
		  return ($cur=='home') ? '🗒&hellip;' : '<pre class="code viewCode" data-lang="CODE"><code>' .str_replace('<br />', '', $match[1]). '</code></pre>'; 
	    };
	
	    // Replace [quote]2017-03-221103009fd11[/quote] with <blockquote>User</blockquote>
	    $this->bbcode_table["/\[quote\](\d{4}-\d{2}-\d{8}[a-z\d]{5})\[\/quote\]/is"] = function ($match) {
		    $reply = $match[1];
			if(flatDB::isValidEntry('reply', $reply))
			{
			    global $lang;
				$replyEntry = flatDB::readEntry('reply', $reply);
				$topicEntry = flatDB::readEntry('topic', $replyEntry['topic']);
				return '<a class="badge badge-pill badge-info" href="view.php/topic/' .$replyEntry['topic']. '/p/' .Util::onPage($reply, $topicEntry['reply']). '#' .$reply. '" data-toggle="tooltip" data-placement="top" title="' .$lang['quote_by']. ' ' .$replyEntry['trip']. '"><i class="fa fa-quote-left"></i></a>&nbsp;';
			}
			else
			{
				return '<a class="badge badge-pill badge-info">[?]</a>';
			}
	    };

	    // Replace [youtube]...[/youtube] with <iframe src="..."></iframe>
	    $this->bbcode_table["/\[youtube\](.*?)\[\/youtube\]/s"] = function ($match) {
		  global $cur;
		  $url = urldecode(rawurldecode($match[1]));
		  return ($cur=='home') ? '🎬&hellip;' : '<iframe width="560" height="315" src="//www.youtube.com/embed/' .$match[1]. '" frameborder="0" allowfullscreen></iframe>';	  
	    };	
	    
	    // Replace [dailymotion]...[/dailymotion] with <iframe src="..."></iframe>
	    $this->bbcode_table["/\[dailymotion\](.*?)\[\/dailymotion\]/s"] = function ($match) {
		  global $cur;
		  $url = urldecode(rawurldecode($match[1]));
		  return ($cur=='home') ? '🎬&hellip;' : '<iframe src="//www.dailymotion.com/embed/video/' .$match[1]. '" allowfullscreen="" width="480" height="270" frameborder="0"></iframe>';	  
	    };	    
	        	
	  }
	  
	  public function toHTML ($str, $escapeHTML=false, $nr2br=false) {
	    if (!$str) { 
	      return "";
	    }
	    
	    if ($escapeHTML) {
	      $str = htmlspecialchars($str);
	    }
	
	    foreach($this->bbcode_table as $key => $val) {
	      $str = preg_replace_callback($key, $val, $str);
	    }
	
	    if ($nr2br) {
	      $str = preg_replace_callback("/\n\r?/", function ($match) { return "<br/>"; }, $str);
	    }
	       
	    return $str;
	  }	  
}