import React from 'react';

import BarsComponent from '../../../containers/BarsContainer.js';
import LegendComponent from '../../../containers/LegendContainer.js';
import YAxisComponent from '../../../containers/YAxisContainer.js';
import XAxisComponent from '../../../containers/XAxisContainer.js';



class TrendsChartComponent extends React.Component {
	
	constructor(props){
		super(props);
		this.prevYearData = ::this.prevYearData;
		this.nextYearData = ::this.nextYearData;
	}


	componentWillMount() {
		
	}
		

	componentDidMount() {
		let year = new Date().getFullYear();
		//make the axios call
		this.props.getInitialData(year);
		
		}	
	


	prevYearData(e){
		e.preventDefault();
		let year = (this.props.currentYear) - 1;

		this.props.getInitialData(year);

	}
	
	nextYearData(e){
		e.preventDefault();
		let year = (this.props.currentYear) + 1;

		this.props.getInitialData(year);

	}
	
	
	render() {
		
		if((this.props.qData.length===0 || this.props.qData[0].length===0) && (this.props.fetching)==false){
			return <h2 className="loader error">Sorry! Unable to fetch data :(</h2>
		}

		if(this.props.qData.length===0 || this.props.qData[0].length===0){
			return <h1 className="loader loading">Loading...</h1>
		}


		let prevBtnDisplay = {
			visibility : (this.props.currentYear>2014)?"visible":"hidden"
		};
		let nextBtnDisplay = {
			visibility : (this.props.currentYear<2016)?"visible":"hidden"
		};
		return (
			 <div id="bar-chart" className="bar-chart">
			 	<div className="upper-display-chart">
				 	<input type="button" style = {prevBtnDisplay} className="year-btn btn" value="<" onClick={this.prevYearData} />
					<span className="year-display">{this.props.currentYear}</span>
					<input type="button" style = {nextBtnDisplay} className="year-btn btn" value=">" onClick={this.nextYearData} />
				 	
			 	</div>
			 	<div className="legend-wrapper">
			 		<LegendComponent />
			 	</div>
				 <svg height="100%" width="100%" viewBox="0 0 440 375" preserveAspectRatio="none" >
				 <BarsComponent />
				 
				 <YAxisComponent />

				 <XAxisComponent />
				 
				 </svg>
			</div>
			);

	}
}

export default TrendsChartComponent;
