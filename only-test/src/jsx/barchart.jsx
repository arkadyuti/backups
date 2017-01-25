import axios from 'axios';
import '../js/chart.js'
class BarChart extends React.Component {
	constructor(props) {
		super(props);
	}
	componentDidMount(){
		axios.get('http://localhost:3000/trends')
			.then(function (response) {
				trendsChartCallBack(response.data[2016]);
			})
			.catch(function (error) {
				console.log(error);
			});
		

		
	}

	
	_handleClick(event) {
		event.preventDefault()		
		axios.get('http://localhost:3000/trends')
			.then(function (response) {
				document.getElementById("bar-chart").innerHTML= "";
				document.getElementById("trends-year").innerHTML= "2015";
				trendsChartCallBack(response.data[2015]);
				document.getElementById('trends-year').removeAttribute("onClick");
			})
			.catch(function (error) {
				console.log(error);
			});
	}

	render() {
		return (
			<div>
				<div className="trends-year" id="trends-year" onClick={this._handleClick.bind(this)}>2016</div>
				<div id="bar-chart"></div>
			</div>
		);
	}
}
export default BarChart;
