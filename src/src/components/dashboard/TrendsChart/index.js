import React from 'react';
import * as d3 from 'd3';

import BarsComponent from '../../../containers/Dashboard/TrendsChart/bars.js';
import LegendComponent from '../../../containers/Dashboard/TrendsChart/legend.js';
import YAxisComponent from '../../../containers/Dashboard/TrendsChart/y-axis.js';
import XAxisComponent from '../../../containers/Dashboard/TrendsChart/x-axis.js';
import Loader from '../../Loader/index.js';


class TrendsChartComponent extends React.Component {
	
	constructor(props){
		super(props);
		this.prevYearData = ::this.prevYearData;
		this.nextYearData = ::this.nextYearData;
		this.state={
			currentYear : 0
		}
	}

	componentDidMount() {
		let year = new Date().getFullYear();
		this.setState({currentYear:year});
		//make the axios call
		this.props.getInitialData(year);

        }

    componentWillUpdate(){
        d3.selectAll("#bars rect")
            .attr("width", 0);
    }

    componentDidUpdate(){
		d3.selectAll("#bars rect")
			.transition()
            .attr("width", 20)
			.duration(1000);
	}


	prevYearData(e){
		e.preventDefault();
		let year = (this.state.currentYear) - 1;
		this.setState({currentYear:year});
		this.props.getInitialData(year);

	}
	
	nextYearData(e){
		e.preventDefault();
		let year = (this.state.currentYear) + 1;
		this.setState({currentYear:year});
		this.props.getInitialData(year);

	}
	
	
	render() {
		
		if((this.props.quarterData.length===0 || this.props.quarterData[0].length===0) && this.props.error!=null && this.props.fetching==false){
			return <Loader addClass="error">Sorry! Unable to fetch data :(</Loader>
		}

		if(this.props.quarterData.length===0 || this.props.quarterData[0].length===0){
			return <Loader>Loading...</Loader>
		}


		let prevBtnDisplay = {
			visibility : (this.state.currentYear>this.props.leastYear)?"visible":"hidden"
		};
		let nextBtnDisplay = {
			visibility : (this.state.currentYear<2016)?"visible":"hidden"
		};


		const dataDisplay = 
			<div> 
				<div className="legend-wrapper">
				 		<LegendComponent />
				 	</div>
					 <svg height="100%" width="100%" viewBox="0 0 440 375" preserveAspectRatio="none" >
					 <BarsComponent />
					 
					 <YAxisComponent />

					 <XAxisComponent />
					 
					 </svg>
			</div>

		const errorDisplay = <Loader addClass="error">Sorry! Unable to fetch data :(</Loader>;

		const successOrFailure = (this.props.error!=null && this.props.fetching==false)? errorDisplay :dataDisplay;


		return (
			 <div id="bar-chart" className="bar-chart">
			 	<div className="upper-display-chart">
				 	<input type="button" style = {prevBtnDisplay} className="year-btn btn" value="<" onClick={this.prevYearData} />
					<span className="year-display">{this.state.currentYear}</span>
					<input type="button" style = {nextBtnDisplay} className="year-btn btn" value=">" onClick={this.nextYearData} />
				 	
			 	</div>
			 	{successOrFailure}
			</div>
			);

	}
}

export default TrendsChartComponent;
