import PieChart from './piechart.jsx';
import BarChart from './barchart.jsx';
import DonutChart from './donut.jsx';

class Layout extends React.Component {
	render() {
		return (
			<section className="charts-container">
				<div className="growth-chart col-sm-6">
					<div className="chart-name">GROWTH</div>
					<div className="chart-wrapper">
						{<BarChart />}
					</div>
				</div>
				<div className="skill-based-chart col-sm-6">
					<div className="chart-name">Skill Based Chart for Projects</div>
					<div className="chart-wrapper">
						{<DonutChart />}
					</div>
				</div>
				<div className="status-chart col-sm-12">
					<div className="chart-name">Status</div>
					<div className="chart-wrapper">
						{<PieChart />}
					</div>
				</div>
				<div className="clear-both"></div>
			</section>
		);
	}
}

export default Layout;