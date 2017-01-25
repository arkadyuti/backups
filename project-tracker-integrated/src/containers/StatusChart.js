import React, { Component, PropTypes } from 'react'
import EachChart from '../components/Dashboard/donutChartD3/EachChart'
import ReactDOM from 'react-dom';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { fetchStatusData } from '../actions/fetchChartStatusAction'

class DonutChart extends Component {

	constructor(props) {
		super(props);

		this._drawEachChart = this._drawEachChart.bind(this);
	}

	componentWillMount() {
		this.props.fetchStatusData();
	}

   	_drawEachChart(obj,i) {
   		var x = 150,
   		y = 150;

   		return(
   			<EachChart key = {obj} 
   				data = {this.props.data[obj]}
   				type = {obj} 
   				x = {x} 
   				y = {y} />
   			) 
   	}

	render() {

		if(!this.props.data){
			return <div>Loading..</div>
		}
			
		return (
			<div>
			{Object.keys(this.props.data).map(this._drawEachChart)}
			</div>
			)
		}
	}

function mapStateToProps(state) {
	// whatever returned will show up as props inside of 
	// DonutChart. This acts as a psuedo state.
	return{
		data : state.statusChartData
	}
}

function mapDispatchToProps(dispatch) {
	//whenever action is called , the result should be passed
	// to all our reducers
	return bindActionCreators({fetchStatusData},dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(DonutChart);