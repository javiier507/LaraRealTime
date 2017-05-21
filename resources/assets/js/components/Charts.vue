<template>
	<div v-if="status === true">
		<div>
			<button class="btn btn-info" @click="update()">Update</button>
		</div>
		<div class="row">
			<div class="col-md-6">
				<bar-chart :data="data" :options="{responsive: true, maintainAspectRatio: false}"></bar-chart>
			</div>
			<div class="col-md-6">
				<line-chart :data="data" :options="{responsive: true, maintainAspectRatio: false}"></line-chart>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<pie-chart :data="data" :options="{responsive: true, maintainAspectRatio: false}"></pie-chart>
			</div>
			<div class="col-md-6">
				<radar-chart :data="data" :options="{responsive: true, maintainAspectRatio: false}"></radar-chart>
			</div>
		</div>
	</div>
</template>

<script>
	import BarChart from './charts/BarChart';
	import LineChart from './charts/LineChart';
	import PieChart from './charts/PieChart';
	import RadarChart from './charts/RadarChart';

	import { inter } from './Inter';

  /*import Echo from 'laravel-echo';

  window.Pusher = require('pusher-js')*/
	
	export default {
  	
  		components: { BarChart, LineChart, PieChart, RadarChart },

  		mounted() {
  			//	this.fetchData();
  		},

  		data() {
  			return {
  				status: false,
  				data: {
  					labels: ['a', 'b', 'c'],
	    			datasets: [
	    				{
	    					label: 'GitHub Commits',
	          				backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe'],
	          				data: [40, 20, 52]
	    				}
	    			]
  				}
  			}
  		},

  		methods: {
  			
  			update() {
  				var values = [30, 25, 52];
  				inter.$emit('updateChartEvent', values);
  			},

  			fetchData() {
  				var self = this;

  				console.log(self.data);

  				axios.get('userposts')
  				.then((response) => {
  					
  					var names = response.data.map((item) => {
  						return item.name;
  					});

  					var votes = response.data.map((item) => {
  						return item.votes;
  					});
  					
  					self.data.labels = names;
  					self.data.datasets[0].label = "top users";
  					self.data.datasets[0].backgroundColor = [
  						'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)'
  					];
  					self.data.datasets[0].borderColor = [
                		'rgba(255,99,132,1)',
                		'rgba(54, 162, 235, 1)',
                		'rgba(255, 206, 86, 1)'
            		];
            		self.data.datasets[0].borderWidth = 2;
            		self.data.datasets[0].fill = false;
  					self.data.datasets[0].data = votes;

  					self.status = true;

  				})
  				.catch((response) => {
  					console.log(response);
  				});
  			}
  		},

  		created() {
  			this.fetchData();

        Echo.private('charts')
        .listen('ChartEvent', (e) => {
            console.log(e);

            var votes = e.userPosts.map((item) => {
              return item.votes;
            });

            console.log(votes);

            inter.$emit('updateChartEvent', votes);
        })

    	}
  		
	}
</script>