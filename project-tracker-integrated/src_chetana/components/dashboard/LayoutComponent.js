import React from 'react';
import DonutChart from '../../containers/StatusChart';

import TrendsChartComponent from "../../containers/TrendsChartContainer.js";

import SkillBasedChartContainer from '../../containers/Dashboard/Skill-based-chart/index.js';

import '../../styles/bootstrap.scss';


class LayoutComponent extends React.Component {

	componentWillMount() {
	}


   render() {

      return (
      	<section className="charts-container">
      	<div>
			<div className="growth-chart col-sm-6">
				<div className="chart-name">GROWTH</div>
				<div className="chart-wrapper">
					<TrendsChartComponent />
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
					<DonutChart />
				</div>
			</div>
			<div className="clear-both"></div>
		</section>
      );
   }
}

export default LayoutComponent;


