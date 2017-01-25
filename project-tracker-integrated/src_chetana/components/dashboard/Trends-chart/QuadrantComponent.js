import React from 'react';
import * as d3 from 'd3';


class QuadrantComponent extends React.Component{

	constructor(props){
		super(props);
		this.eachRect = this.eachRect.bind(this);
		this.showToolTip = this.showToolTip.bind(this);
		this.hideToolTip = this.hideToolTip.bind(this);
		this.width = 20;
		
		
	}


	showToolTip(e){
		e.preventDefault();
		console.log(this.props);
		var valuePosX,valuePosY,dvalue,group,fillValue,colorData,barData,monthList,monthToolTip,monthIndex=0;
		group = this.group*50; 
		valuePosX = parseInt(e.target.getAttribute("x"));
		valuePosY = parseInt(e.target.getAttribute("y"));
		dvalue = e.target.getAttribute("d"); 
		fillValue = e.target.getAttribute("fill");
		colorData = this.props.colorData;
		barData = this.props.newData;
		monthList = ['Jan','Feb','March','April','May','June','July','Aug','Sep','Oct','Nov','Dec'];
		monthIndex = this.group*3;
		for(var i=0;i<3;i++){
			if(colorData[i] === fillValue){
				monthIndex = monthIndex+i;
				break
			}
		}
		monthToolTip = monthList[monthIndex];
		console.log(this.i);
		this.props.setHover(valuePosX,valuePosY,dvalue,group,"inline-block",monthToolTip);

	}

	hideToolTip(e){
		e.preventDefault();
		
		this.props.setHover(0,0,0,0,"none",'');
	}

	eachRect(d,i){
		var barHeight=this.props.barHeight;
		var coor = parseInt((this.props.group)*50+50);
		var maxData = d3.max(this.props.newData);

		var height = d/(maxData)*barHeight;
		var y = barHeight - height;
		
	  d3.selectAll('rect')
		 	.data(this.props.newData)
		 	.transition()
        	.delay(function(d,i){
         		 return i*100;
        	});
        let gradient1 = d3.select('svg').append("defs")
					  .append("linearGradient")
					    .attr("id", "gradient1")
					    .attr("x1", "0%")
					    .attr("y1", "100%")
					    .attr("x2", "0%")
					    .attr("y2", "0%");

		gradient1.append("stop")
	    .attr("offset", "0%")
	    .attr("stop-color", "red");

		gradient1.append("stop")
	    .attr("offset", "100%")
	    .attr("stop-color", "yellow");

	    let gradient2 = d3.select('svg').append("defs")
					  .append("linearGradient")
					    .attr("id", "gradient2")
					    .attr("x1", "0%")
					    .attr("y1", "100%")
					    .attr("x2", "0%")
					    .attr("y2", "0%");

		gradient2.append("stop")
	    .attr("offset", "0%")
	    .attr("stop-color", "blue");

		gradient2.append("stop")
	    .attr("offset", "100%")
	    .attr("stop-color", "yellow");
	    let gradient3 = d3.select('svg').append("defs")
					  .append("linearGradient")
					    .attr("id", "gradient3")
					    .attr("x1", "0%")
					    .attr("y1", "100%")
					    .attr("x2", "0%")
					    .attr("y2", "0%");

		gradient3.append("stop")
	    .attr("offset", "0%")
	    .attr("stop-color", "green");

		gradient3.append("stop")
	    .attr("offset", "100%")
	    .attr("stop-color", "yellow");
	
	    var abc = ['url(#gradient3)','url(#gradient2)','url(#gradient1)']

		this.i = i;
		this.group = this.props.group;
		return(
			<rect key={i} x={coor+i*25} width={this.width} fill={abc[i]} y={y} height={height} onMouseOver={this.showToolTip} onMouseOut={this.hideToolTip} d={d}>
			</rect> 
			)
	}



	render(){
	
		var xcoorOfGroup = (this.props.group)*50;
		var grp = this.props.group;
		var xcoorOfTooltip = (this.props.getX)+(this.props.grpPadding);
		var xRect = xcoorOfTooltip+20;
		var yRect = (this.props.getY)+50;
		var points = ""+xRect+" "+yRect+","+(xRect+10)+" "+yRect+","+xRect+" "+(yRect+10)+"";
		var mapping = this.props.qData[grp];

		return(
			<g>
				<g transform={`translate(${xcoorOfGroup},50)`} >
					{mapping.map(this.eachRect)}
					
				</g>
				<g transform={`translate(${xcoorOfTooltip},${this.props.getY})`}>
					<rect  width={30} height={20}  x = {0} y = {30} fill="black" style={{display : this.props.disp}} />
					<text   x = {12} y = {45} fill="red" style={{display : this.props.disp}} alignmentBaseline="middle" textAnchor="middle" >
						<tspan x={2} textAnchor="start" y = {-10} dy="1em" fill="darkgrey" >{(this.props.monthToolTip)+" "+(this.props.currentYear)}</tspan>

						<tspan x={2} textAnchor="start" y = {5} dy="1.2em" fill="black" >Results</tspan>
						<tspan x={11} textAnchor="middle" y = {28} dy="1.2em" fill="white" >{this.props.dValue}</tspan>
					</text>
				</g>
				<polygon points={points} style={{display : this.props.disp}} fill="black" />
			</g>
			)
	}
}


export default QuadrantComponent;
