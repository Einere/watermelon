<?php 

// $total_count 게시물 수 
// $page list.php?page=1 
// $limit 한 화면에 뿌려질 글 수
// $link [1] [2] [3] [4]... 
function pageList($total_count=0, $page=1, $limit=10, $link=10)
{
   $total_page = @ceil( $total_count / $limit );
   if($page <= 1)
   {
       $page = 1;
   }
   else if($total_page < $page)
   {
       $page = $total_page;
   }

   $start_limit = ($page-1) * $limit;

   if($total_count < $limit)
   {
       $end_limit = $total_count;
   }
   elseif($page === $total_page)
   {
       $end_limit = $total_count - ($limit * ($total_page - 1) );
   }
   else
   {
       $end_limit = $limit;
   }

   $prev = $page - 1;
   $next = $page + 1;

   if($total_count <= 0)
   {
       $prev = 0;
       $next = 0;
   }

   $start = ((@ceil($page/$link)-1) * $link) + 1;
   $end = $start + $link -1;
   if($end > $total_page)
   {
       $end = $total_page;
   }

   foreach(range($start, $end) as $val)
   {
       $row[] = $val; 
   }
   return array(
       'total_page' => $total_page,
       'page' => $page,
       'prev' => $prev,
       'next' => $next,
       'list' => $row
   );
}


// example.
$total = 1223457890; 
$list = pageList( $total, $_GET['page'] );
foreach($list['list'] as $w)
{
   echo "<a href='list.php?page=".$w."'>".$w."</a> ";
}
?>
<br/>
<form method="get">
<a href="list.php?page=<?php echo $list['prev']; ?>">prev</a>
<input type='number' name='page' 
value="<?php echo $list['page'] ?>" size="4" onclick="this.select()"/>/
<input value="<?php echo $list['total_page']; ?>" size="4" disabled/>
<input type="submit" value="GO"/>
<a href="list.php?page=<?php echo $list['next']; ?>">next</a>
</form>