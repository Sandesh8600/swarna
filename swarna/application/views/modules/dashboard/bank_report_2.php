
<style>
.col_half { width: 49%; }
.col_third { width: 32%; }
.col_fourth { width: 23.5%; }
.col_fifth { width: 18.4%; }
.col_sixth { width: 15%; }
.col_three_fourth { width: 74.5%;}
.col_twothird{ width: 66%;}
.col_half,
.col_third,
.col_twothird,
.col_fourth,
.col_three_fourth,
.col_fifth{
	position: relative;
	display:inline;
	display: inline-block;
	float: left;
	margin-right: 2%;
	margin-bottom: 20px;
}
.end { margin-right: 0 !important; }
/* Column Grids End */

.wrapper {margin: 30px auto; position: relative;}
.counter {
    background-color: #d9e2e6;
    padding: 11px 0;
    border-radius: 5px;
    /* border-top-right-radius: 7px; */
     width: 14%;
    border: 1px solid #ccc;
}
.count-title { font-size: 22px; font-weight: bold;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.count-text { font-size: 13px; font-weight: normal;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.fa-2x { margin: 0 auto; float: none; display: table; color: #4ad1e5; }
.ot-blk{
    background: #f7f7f7;
	display:inline-grid;
    width: 100%;
    padding: 20px 10px 20px 10px;
    border-radius:5px;	
}
</style>

<div class="box-width">

	<div class="wrapper">
		<div class="ot-blk">
			<label class='lbl-hd'>Overall</label>
			<div class="row" style="margin-top:17px;">
				<div class="counter col_fourth">
				  <?php $cnt = isset($report_arr['overall']['correct']['per'])?$report_arr['overall']['correct']['per']:0;?>
				  <h2 class="timer count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				  <?php echo $cnt;?>
				  </h2>
				   <p class="count-text ">% Correct</p>
				</div>

				<div class="counter col_fourth">
				  <?php $cnt = isset($report_arr['overall']['correct']['count'])?$report_arr['overall']['correct']['count']:0;?>
				  <h2 class="timer count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">No.Of Correct</p>
				</div>

				<div class="counter col_fourth">		 
				  <?php $cnt = isset($report_arr['overall']['total_questions_attempted'])?$report_arr['overall']['total_questions_attempted']:0;?>
				  <h2 class="timer count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">Attempted Questions</p>
				</div>
				
				<div class="counter col_fourth">
				  <?php $cnt = isset($report_arr['overall']['total_time'])?$report_arr['overall']['total_time']:0;?>
				  <h2 class="count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">Total time</p>
				</div>

				<div class="counter col_fourth">		 
				  <?php $cnt = isset($report_arr['overall']['avg_time'])?$report_arr['overall']['avg_time']:0;?>
				  <h2 class="count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">Avg Time</p>
				</div>		
			</div>
		</div>
	</div>

<?php if(isset($subject_arr)){
	foreach($subject_arr as $s){ ?>
	<div class="wrapper">
		<div class="ot-blk">
			<label class="lbl-hdl">&nbsp;<?php echo $s->subject;?></label>
			<div class="row" style="margin-top:17px;">
				<div class="counter col_fourth">
				  <?php $cnt = isset($report_arr[$s->id]['correct']['per'])?$report_arr[$s->id]['correct']['per']:0;?>
				  <h2 class="timer count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				  <?php echo $cnt;?>
				  </h2>
				   <p class="count-text ">% Correct</p>
				</div>

				<div class="counter col_fourth">
				  <?php $cnt = isset($report_arr[$s->id]['correct']['count'])?$report_arr[$s->id]['correct']['count']:0;?>
				  <h2 class="timer count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">No.Of Correct</p>
				</div>

				<div class="counter col_fourth">		 
				  <?php $cnt = isset($report_arr[$s->id]['total_questions_attempted'])?$report_arr[$s->id]['total_questions_attempted']:0;?>
				  <h2 class="timer count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">Attempted Questions</p>
				</div>
				
				<div class="counter col_fourth">
				  <?php $cnt = isset($report_arr[$s->id]['total_time'])?$report_arr[$s->id]['total_time']:0;?>
				  <h2 class="count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">Total time</p>
				</div>

				<div class="counter col_fourth">		 
				  <?php $cnt = isset($report_arr[$s->id]['avg_time'])?$report_arr[$s->id]['avg_time']:0;?>
				  <h2 class="count-title count-number" data-to="<?php echo $cnt;?>" data-speed="1500">
				   <?php echo $cnt;?>
				  </h2>
				  <p class="count-text ">Avg Time</p>
				</div>		
			</div>
		</div>
	</div>
<?php } }?>

	<div class="" style="background:white">
		<div class="ot-blk">	
	<label class='lbl-hd'>Overall</label>
			<div style="width:65%;">
				<canvas id="canvas"></canvas>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('js/Chart.min.js');?>"></script>	
<script src="<?php echo base_url('js/utils.js');?>"></script>	
<script>
(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});





	var MONTHS = [<?php echo $report_arr['last_7']['month_str']?>];
		var config = {
			type: 'line',
			data: {
				labels: [<?php echo $report_arr['last_7']['month_str']?>],
				datasets: [{
					label: 'No.Of Correct',
					backgroundColor: 'green',
					borderColor: 'green',
					data: [
						<?php if(isset($report_arr['last_7']['overall']['correct']['str_cnt']))
						{
							echo $report_arr['last_7']['overall']['correct']['str_cnt'];
						}else{
							echo "0,0,0,0,0,0,0,0,0,0,0,0,0";
						}
						?>
					],
					fill: false,
				}, {
					label: 'Questions Attempted',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
						<?php if(isset($report_arr['last_7']['overall']['total_questions_attempted']['str']))
						{
							echo$report_arr['last_7']['overall']['total_questions_attempted']['str'];
						}else{
							echo "0,0,0,0,0,0,0,0,0,0,0,0,0";
						}
						?>
					],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					x: {
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					},
					y: {
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

</script>
