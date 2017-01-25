import React from 'react';
import * as d3 from 'd3';

import ToolTipMobileComponent from '../../../containers/Dashboard/TrendsChart/tooltip-mobile.js';

class QuadrantMobileComponent extends React.Component{

	constructor(props){
		super(props);
        this.eachRect = ::this.eachRect;
        this.getGradient = ::this.getGradient;
        this.showToolTip = ::this.showToolTip;
        this.hideToolTip = ::this.hideToolTip;
		this.width = 40;
	}

	showToolTip(e,index){
		e.preventDefault();
		let valuePosX,valuePosY,dvalue,group,monthList,monthToolTip,monthIndex;
		group = this.group*50; 
		valuePosX = parseInt(e.target.getAttribute("x"));
		valuePosY = parseInt(e.target.getAttribute("y"));
		dvalue = e.target.getAttribute("d");
		monthList = ['Jan','Feb','March','April','May','June','July','Aug','Sep','Oct','Nov','Dec'];
		monthIndex = this.group*3;
		for(let i=0;i<3;i++){
			if(i === index){
				monthIndex = monthIndex+i;
				break
			}
		}
		monthToolTip = monthList[monthIndex];

		e.target.setAttribute("opacity",0.7);

		this.props.setHover(valuePosX,valuePosY,dvalue,group,"inline-block",monthToolTip);

	}

	hideToolTip(e){
		e.preventDefault();
		e.target.setAttribute("opacity",1);
		this.props.setHover(0,0,0,0,"none",'');
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

        let gradients = ['url(#gradient0)','url(#gradient1)','url(#gradient2)'];

        for(let i=0;i<gradients.length;i++){
            if(i===index){
                return gradients[i];
            }
        }
    }

	eachRect(d,i){
		let barHeight=this.props.barHeight;
		let coor = 45;
		let maxData = d3.max(this.props.responseData);

		let height = d/(maxData)*barHeight;
		let y = barHeight - height;

		this.i = i;
		this.group = this.props.group;
		return(
			<rect key={i} x={coor+i*55} fill={this.getGradient(i)} y={y} height={height} onMouseOver={(e) => this.showToolTip(e,i)} onMouseOut={this.hideToolTip} d={d}>
			</rect> 
			)
	}

	render(){
	
		let grp = this.props.group;
		let points1= ""+110+" "+226+","+120+" "+220+","+130+" "+226+"";
		let mapping = this.props.quarterData[grp];
		if("Q"+(this.props.activeQuarter) == this.props.q){
		return(
			<g>
				<g transform={`translate(2,50)`} id="bars"  >
					{mapping.map(this.eachRect)}
					<polygon points={points1} fill="white" />
				</g>
				<ToolTipMobileComponent/>
			</g>
			)
		}
		return null
	}
}


export default QuadrantMobileComponent;
