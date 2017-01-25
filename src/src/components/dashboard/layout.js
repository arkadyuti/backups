import React from 'react';
import StatusChart from '../../containers/Dashboard/StatusChart/root/index'
import SkillBasedChartContainer from '../../containers/Dashboard/SkillBasedChart/index.js';
import TrendsChartComponent from "../../containers/Dashboard/TrendsChart/index.js";
import TrendsChartMobileComponent from "../../containers/Dashboard/TrendsChart/index-mobile.js";

import './dashboard.scss';


class LayoutComponent extends React.Component {

	constructor(props) {
		super(props);
		this.state = {
			view:'desktop'
		}
		this.handleView = this.handleView.bind(this);/*TODO:es6 way of binding*/
	}

	componentWillMount() {
		window.addEventListener('resize',this.handleView);
		this.handleView();
	}

	handleView() {
		if(window.innerWidth < 768)
		{
			this.setState({
				view:'mobile'
			})
		}
		else
		{
			this.setState({
				view:'desktop'
			})
		}
	}

   render() {
	return (
      	<section className="charts-container">
      	<div>
			<div className="growth-chart col-xs-12 col-sm-6 col-md-6">
				<div className="chart-name">GROWTH</div>
				<div className="chart-wrapper">
					{this.state.view === 'desktop'? <TrendsChartComponent />: <TrendsChartMobileComponent/>}
				</div>
			</div>
			
			<div className="skill-based-chart col-xs-12 col-sm-6 col-md-6">
				<div className="chart-name">Skill Based Chart for Projects</div>
				<div className="chart-wrapper">
					<SkillBasedChartContainer />
				</div>
			</div>
		</div>
		<div>
			<div className="status-chart col-xs-12 col-sm-12 col-md-12">
				<div className="chart-name">Status</div>
				<div className="chart-wrapper status-wrapper">
					<StatusChart />
				</div>
			</div>
		</div>
			<div className="clear-both"></div>
		</section>
      );
   }
}

export default LayoutComponent;
					