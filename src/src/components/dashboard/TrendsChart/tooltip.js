import React from 'react';

class ToolTipComponent extends React.Component{

    render(){

        let xcoorOfTooltip = (this.props.getX)+(this.props.groupPadding);
        let xRect = xcoorOfTooltip+20;
        let xRectNext = xRect+this.props.tooltipWidth-20;
        let yRect = (this.props.getY)+50;
        let points = ""+xRect+" "+yRect+","+xRectNext+" "+yRect+","+xRect+" "+(yRect+10)+"";

        return(
            <g>
                <g transform={`translate(${xcoorOfTooltip},${this.props.getY})`}>
                    <rect  width={this.props.tooltipWidth} height={20}  x = {0} y = {30} fill="#3a3a3a" style={{display : this.props.tooltipDisplay}} />
                    <text x = {8} y = {30} textAnchor="start"  dy="1.2em" fill="white" >{this.props.tooltipValue}</text>


                    <text   x = {0} y = {45} fill="red" style={{display : this.props.tooltipDisplay}} textAnchor="middle" >
                        <tspan x={0} textAnchor={this.props.textAnchor} y = {-10} dy="1em" fill="darkgrey" >{(this.props.monthToolTip)+" "+(this.props.currentYear)}</tspan>
                        <tspan x={0} textAnchor={this.props.textAnchor} y = {5} dy="1.2em" fill="black" >Results</tspan>
                    </text>
                </g>
                <polygon points={points} style={{display : this.props.tooltipDisplay}} fill="#0a0000" />
            </g>

        )
    }
}

export default ToolTipComponent;