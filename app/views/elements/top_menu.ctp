<div id="menu">
	<ul>
		<?php
			foreach($items as $tmi):
		?>
		<li class="level-0 closed">
			<?php echo $html->link($tmi['TopMenuItem']['name'], $tmi['TopMenuItem']['link']); 
                        if(!empty($tmi['children'])):
			?>	
                                <ul class="dropdown-menu" style="display: none; ">
				<?php foreach($tmi['children'] as $child): ?>
					<li>
						<?php 
							echo $html->link($child['TopMenuItem']['name'], $child['TopMenuItem']['link']); 
							if(!empty($child['children'])):
						?>
							<ul class="dropdown-menu level-1" style="display: none; ">
							<?php
								foreach($child['children'] as $lvl2):
							?>
								<li>
								<?php 
									echo $html->link($lvl2['TopMenuItem']['name'], $lvl2['TopMenuItem']['link']); 
									if(!empty($lvl2['children'])):
								?>
									<ul class="dropdown-menu level-1" style="display: none; ">
									<?php
										foreach($lvl2['children'] as $lvl3):
									?>
									<li><?php echo $html->link($lvl3['TopMenuItem']['name'], $lvl3['TopMenuItem']['link']);  ?></li>
									<?php
										endforeach; 
										
									?>
									</ul>
                                                                        <?php endif; ?>
								</li>
							<?php
								endforeach; 
							?>
							</ul>
						<?php
							endif; 
						?>
					</li>

				<? endforeach; ?>
				</ul>
			<?php
			  endif; 
			?>
		</li>
			<? endforeach; ?>
        <li class="level-0 closed"></li> 
	</ul>
</div>