import React, { Component, PropTypes } from 'react'
import ReactDOM from 'react-dom';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import EachChart from '../../../../components/Dashboard/Status-chart/EachChart/index'
import { fetchStatusData } from '../../../../actions/Dashboard/Status-chart/fetchChartStatusAction';

import '../../../../styles/Dashboard/Status-chart/Status-chart.scss';

class DonutChart extends Component {

	constructor(props) {
		super(props);

		this._drawEachChart = this._drawEachChart.bind(this);
	}

	componentWillMount() {
		this.props.fetchStatusData();
	}

   	_drawEachChart(obj,i) {

   		return(
   			<EachChart key = {obj} 
   				uniqueId={i} 
   				data = {this.props.data[obj]}
   				type = {obj} />
   			) // this unique id is passed on as props to pie component
   			// to give specific classname for all svg's. eg-svg0,svg1 etc 
   	}

	render() {
		console.log("avinash",this.props.data)
		if(!this.props.data){
			return <div>Loading..</div>
		} // if data not recieved due to ajax call.
			
		return (
			<div className="status-chart-svg">		
			{Object.keys(this.props.data).map(this._drawEachChart)}
			</div>
			)
		}
	}

function mapStateToProps(state) {
	// whatever returned will show up as props inside of 
	// DonutChart. This acts as a psuedo state.
	return {
		data : state.statusChartData
	}
}

function mapDispatchToProps(dispatch) {
	//whenever action is called , the result should be passed
	// to all our reducers
	return bindActionCreators({fetchStatusData},dispatch)
}

export default connect(mapStateToProps,mapDispatchToProps)(DonutChart);