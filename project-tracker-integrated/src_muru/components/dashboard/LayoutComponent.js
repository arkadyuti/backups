import React from 'react';
import StatusChart from '../../containers/Dashboard/Status-chart/Root/index';

import TrendsChartComponent from "../../containers/Dashboard/Trends-chart/TrendsChartContainer.js";
import TrendsChartMobileComponent from "../../containers/Dashboard/Trends-chart/TrendsChartMobileContainer.js";
import SkillBasedChartContainer from '../../containers/SkillBasedChartContainer.js';

import '../../styles/bootstrap.scss';

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
			<div className="growth-chart col-sm-6">
				<div className="chart-name">GROWTH</div>
				<div className="chart-wrapper">
					{this.state.view === 'desktop'? <TrendsChartComponent />: <TrendsChartMobileComponent/>}
				</div>
			</div>
			<div className="skill-based-chart col-sm-6">
				<div className="chart-name">Skill Based Chart for Projects</div>
				<div className="chart-wrapper">
					<SkillBasedChartContainer />
				</div>
			</div>
			</div>
			<div className="status-chart col-sm-12">
				<div className="chart-name">Status</div>
				<div className="chart-wrapper">
					<StatusChart />
				</div>
			</div>
			<div className="clear-both"></div>
		</section>
      );
   }
}

export default LayoutComponent;


