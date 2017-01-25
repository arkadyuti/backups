class Middle extends React.Component {
   render() {
      return (
         <div className="main-container">
         	{<PieChart />}
         	{<PieChart />}
			<div className="clear-both"></div>
			<div className="bargraph-container">
				<div id="barchart_material" className="barchart_material"></div>
			</div>
         </div>
      );
   }
}
class PieChart extends React.Component {
   render() {
      return (
        	<div className="piecharts-container">
        		<div className="chart-head">SKILLS BASED CHARTS FOR PROJECTS</div>
        		<div className="piechart" id="piechart"></div>
        	</div>
      );
   }
}
export default Middle;