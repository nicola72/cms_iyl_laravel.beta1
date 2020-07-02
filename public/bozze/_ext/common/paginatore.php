<?php
if ($this->nr_totale_pagine > 1) 
{
	$prev = $this->p - 1;
	$next = $this->p + 1;
	
	parse_str ( $_SERVER ['QUERY_STRING'], $temp );
	$qs = "";
	foreach ( $temp as $key => $val ) 
	{
		if ($key == "p") 
		{
			continue;
		} 
		else 
		{
			$qs .= "&amp;{$key}={$val}";
		}
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="paginator">
			<?php
			if ($this->p >= 1) {
				?>
				<a href="<?php echo $_SERVER['SCRIPT_URI']."?".$qs;?>&amp;p=<?php echo$prev;?>" style="margin-right: 30px;"> &laquo; </a>
			<?php
			}
			
			for($i = 0; $i < $this->nr_totale_pagine; $i ++) {
				$class_a = ($i == $this->p) ? ' class="b"' : "";
				?><a href="<?php echo $_SERVER['SCRIPT_URI']."?".$qs;?>&amp;p=<?php echo $i;?>"	<?php echo $class_a;?>><?php echo $i+1;?></a>&nbsp;&nbsp;
			<?php
			}
			
			if ($this->p < $this->nr_totale_pagine - 1) {
				?>
				<a href="<?php echo $_SERVER['SCRIPT_URI']."?".$qs;?>&amp;p=<?php echo $next;?>" style="margin-left: 30px;"> &raquo; </a>
			<?php
			}
			?>
			</div>
		<?php } ?>
	</div>
</div>
