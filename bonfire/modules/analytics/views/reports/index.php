	<!-- Analytics Editor -->
	<div id="content" style="padding:20px">
	    <div class="selects">

        <?php echo form_dropdown('dashboard_profile_id',  array('' => 'loading'), ' id="dashboard_profile_id"'); ?>
	        <select name="months" id="months">

			<?php foreach(range(1, 12) as $month) :

					echo '<option ' . ($month == date('n') ? 'selected="selected" ' : '') . 'value="' . $month . '">' . date('F', mktime(0, 0, 0, $month, 1, date('Y'))) . '</option>';

				endforeach; ?>
			</select>

			<select name="year" id="year">
			<?php foreach(range(date('Y')-2, date('Y')) as $year) :
				echo '<option ' . ($year == date('Y') ? 'selected="selected" ' : '') . 'value="' . $year . '">' . $year . '</option>';
			endforeach; ?>
			</select>

	    </div>

		<div id="linechart" ></div>
	    <div id="dashboard" class="dashboard"></div>

	</div>	<!-- /content -->
