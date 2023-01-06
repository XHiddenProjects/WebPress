<?php defined('WEBPRESS') or die('WebPress community');
class Paginate{
	protected function __construct()
    {
        // Nothing here
    }
	public static function pageLink($p, $total, $loc)
	{
		$start = ($p-4) >= 1? $p-4 : 1;
		$end = ($p+4) <= $total? $p+4 : $total;
		$out = ' 		
			<nav aria-label="pagination">
			  <ul class="pagination justify-content-center mt-3">'.
			    ($p > 1? '<li class="page-item page-prev"><a class="page-link" href="' .$loc. 'p='.($p-1). '">&larr;</a></li>' : '<li class="page-item disabled"><a class="page-link" href="' .$loc . 'p=' .($p-1). '" tabindex="-1">&larr;</a></li>').
				($start === 1? '' : '<li class="page-item"><a class="page-link" href="' .$loc. 'p=' .($start-1). '">…</a></li>');
				for($i=$start; $i<=$end; $i++)
				{
					if($p === $i)
						$out .= '<li class="page-item active"><span class="page-link">' .$i. '</span></li>';
					else
						$out .= '<li class="page-item"><a class="page-link" href="' .$loc . 'p=' .$i. '">' .$i. '</a></li>';	
				}
				$out .= ($end === $total? '' : '<li class="page-item"><a class="page-link" href="' .$loc. 'p=' .($end+1). '">…</a></li>').
				($p < $total? '<li id="next" class="page-item"><a class="page-link" href="' .$loc . 'p='.($p+1). '">&rarr;</a></li>' : '<li class="page-item disabled"><a class="page-link" href="' .$loc.  'p='  .($p+1). '" tabindex="-1">&rarr;</a></li>');
		$out.= '</ul>
          </nav>';
        # Return all links of Pagination  
		return $out;
	}
		public static function countPage($items, $nb)
	{
		$itemNum = count($items);
		if($itemNum === 0)
			return 1;
		else
		
			return (int) ceil($itemNum / $nb);
	}
	
	public static function viewPage($items, $p, $nb)
	{
		return array_slice($items, $nb*($p-1), $nb);
	}
	
	public static function pid($total)
	{
		if(!isset($_GET['p']))
			return 1;
		$p = (int) $_GET['p'];
	
		if($p >= 1 && $p <= $total)
			return $p;
		else
			return 1;
	}
}
?>