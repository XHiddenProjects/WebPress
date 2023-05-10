<?php defined('WEBPRESS') or die('Webpress community');
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
	
// Replace [quote]2022-10-e84c4c14[/quote] with <blockquote>User</blockquote>
	      $this->bbcode_table["/\[quote\](\d{4}-\d{2}-[a-z\d]+)\[\/quote\]/is"] = function ($match) {
		    $reply = $match[1];
			if(WebDB::DBexists('replys', $reply))
			{
			    global $lang, $BASEPATH;
				$replyEntry = WebDB::getDB('replys', $reply);
				$topicEntry = WebDB::getDB('topics', $replyEntry['topic']);
				return '<div class="col col-lg-6 mb-4 mb-lg-0">
          <a style="text-decoration:none;" href="./view?id='.$replyEntry['topic'].'#'.$replyEntry['id'].'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'.$lang['quote_direct'].'">
		  <figure class="bg-white p-3 rounded mb-0" style="border-left: 0.25rem solid rgb(163, 78, 120);">
            <blockquote class="blockquote pb-2">
			<img class="img-fluid rounded img-thumbnail" src="'.(file_exists(DATA_UPLOADS.'avatars'.DS.$replyEntry['author'].'.png') ? $BASEPATH.DATA_AVATARS.$replyEntry['author'].'.png' : $BASEPATH.DATA_AVATARS.'default.png' ).'"/>
              <p class="text-bg-secondary w-100 rounded-1 text-center">
               '.$replyEntry['msg'].'
              </p>
            </blockquote>
            <figcaption class="blockquote-footer mb-0 font-italic">
              '.$replyEntry['author'].'
            </figcaption>
          </figure></a>
        </div>';
			}
			else
			{
				return '<a class="badge badge-pill text-bg-info">[?]</a>';
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