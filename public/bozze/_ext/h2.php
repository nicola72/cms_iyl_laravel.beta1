
<div class="h2-wrapper">
	<h2 class="h2 hidden-xs">
		<?php 
    		if($this->page == 'categoria')
    		{
    		    if($this->lang == 'ita')
    		    {
    		        echo $this->categoria['nome_it'].' online';
    		    }
    		    else{
    		        echo $this->categoria['nome_en'].' online';
    		    }
    		}
    		elseif($this->page == 'scheda_prodotto')
    		{
    			if($this->is_abbinamento == true)
    			{
    				if($this->lang == 'ita')
    				{
    					
    					echo utf8_encode($this->prodotto['titolo'].' online');
    				}
    				else{
    					echo utf8_encode($this->prodotto['titolo_en'].' online');
    				}
    			}
    			else{
    				if($this->lang == 'ita')
    				{
    					
    					echo $this->prodotto['nome_it'].' online';
    				}
    				else{
    					echo $this->prodotto['nome_en'].' online';
    				}
    			}
    		}
    		else
    		{
    		    echo $this->seo[$this->page][$this->lang]['alt'];
    		}
		?>
		
	</h2>
</div>