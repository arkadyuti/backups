import React from 'react';
import * as d3 from 'd3';

import ToolTipComponent from '../../../containers/Dashboard/TrendsChart/tooltip.js';

class QuadrantComponent extends React.Component{

	constructor(props){
		super(props);
		this.eachRect = ::this.eachRect;
		this.getGradient = ::this.getGradient;
		this.showToolTip = ::this.showToolTip;
		this.hideToolTip = ::this.hideToolTip;
		this.width = 20;
	}
    componentDidMount(){
        d3.selectAll("#bars rect")
            .transition()
            .attr("width", 20)
            .duration(1000);
    }
	showToolTip(e,index){
		e.preventDefault();
		let i,valuePosX,valuePosY,dvalue,group,monthList,monthToolTip,monthIndex,textAnchor;
		group = this.group*50; 
		valuePosX = parseInt(e.target.getAttribute("x"));
		valuePosY = parseInt(e.target.getAttribute("y"));
		dvalue = e.target.getAttribute("d");
		monthList = ['Jan','Feb','March','April','May','June','July','Aug','Sep','Oct','Nov','Dec'];
		monthIndex = this.group*3;
		for(i=0;i<3;i++){
			if(i === index){
				monthIndex = monthIndex+i;
				break;
			}
		}
		monthToolTip = monthList[monthIndex];
		let cnt = 0,ttWidth,testValue=dvalue;
		while(testValue>0){
			testValue = parseInt(testValue/10);
			cnt=cnt+1;
		}

			ttWidth = (cnt+1)*10;

		
		e.target.setAttribute("opacity",0.7);
        if(this.group===3 && i>1){
            textAnchor = "middle"
        }
        else{
            textAnchor = "start"
		}


		this.props.setHover(valuePosX,valuePosY,dvalue,group,"inline-block",monthToolTip,ttWidth,textAnchor);

	}

	hideToolTip(e){
		e.preventDefault();
		let textAnchor;
        if(this.group===3 && this.props.textAnchor==="middle"){
                textAnchor = "start";
        }
		e.target.setAttribute("opacity",1);
		this.props.setHover(0,0,0,0,"none",'',30,textAnchor);
	}
	
	getGradient(index){

        let gradient0 = d3.select("svg")
            .append("linearGradient")
            .attr("y1", "100%")
            .attr("y2", "0%")
            .attr("x1", "0")
            .attr("x2", "0")
            .attr("id", "gradient0");
        gradient0
            .append("stop")
            .attr("offset", "0%")
            .attr("stop-color", "#f5b13d");

        gradient0
            .append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "#e8413b");

        let gradient1 = d3.select("svg")
            .append("linearGradient")
            .attr("y1", "100%")
            .attr("y2", "0%")
            .attr("x1", "0")
            .attr("x2", "0")
            .attr("id", "gradient1");
        gradient1
            .append("stop")
            .attr("offset", "0%")
            .attr("stop-color", "#74d3f1");

        gradient1
            .append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "#34b6da");

        let gradient2 = d3.select("svg")
            .append("linearGradient")
            .attr("y1", "100%")
            .attr("y2", "0%")
            .attr("x1", "0")
            .attr("x2", "0")
            .attr("id", "gradient2");
        gradient2
            .append("stop")
            .attr("offset", "0%")
            .attr("stop-color", "#8c71d4");

        gradient2
            .append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "#5b40b1");

            	{
        let gradients = ['url(#gradient0)', 'url(#gradient1)', 'url(#gradient2)'];
        for (let i = 0; i < gradients.length; i++) {
            if (i === index) {
                return gradients[i];
            }
        }
    }


}



	eachRect(d,i){
		let barHeight=this.props.barHeight;
		let coor = parseInt((this.props.group)*50+50);
		let maxData = d3.max(this.props.responseData);
		let height = d/(maxData)*barHeight;
		let y = barHeight - height;
		this.group = this.props.group;
		return(
			<rect key={i} x={coor+i*25} fill={ this.getGradient(i)} y={y} height={height} onMouseOver={(e)=> this.showToolTip(e,i)} onMouseOut={this.hideToolTip} d={d}>
			</rect> 
			)
	}



	render(){
	
		let xcoorOfGroup = (this.props.group)*50;
		let grp = this.props.group;
		let mapping = this.props.quarterData[grp];
		return(
			<g>
				<g transform={`translate(${xcoorOfGroup},50)`} id="bars" >
					{mapping.map(this.eachRect)}
				</g>
				<ToolTipComponent />
			</g>
			)
	}
}


export default QuadrantComponent;
