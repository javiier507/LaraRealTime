<script>
    import { Radar } from 'vue-chartjs';

    import { inter } from '../Inter';

    export default Radar.extend({
    	
    	props: ['data', 'options'],

    	mounted() {
    		this.renderChart(this.data, this.options)
    	},

    	methods: {
    		updateChart(values) {
    			this.data.datasets[0].data = values;
                this._chart.update();
    		}
    	},

    	created() {
    		inter.$on('updateChartEvent', this.updateChart);
    	}
    })
</script>