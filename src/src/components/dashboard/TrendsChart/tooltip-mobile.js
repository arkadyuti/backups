
import React from 'react';

class ToolTipMobileComponent extends React.Component{

    render(){

        let xcoorOfTooltip = (this.props.getX);
        let xRect = xcoorOfTooltip+40;
        let yRect = (this.props.getY)+50;
        let points = ""+xRect+" "+yRect+","+(xRect+10)+" "+yRect+","+xRect+" "+(yRect+10)+"";

        return(
            <g transform = {`translate(2,0)`}>
                <g transform={`translate(${xcoorOfTooltip},${this.props.getY})`}>
                    <rect width={50} height={20}  x = {0} y = {30} fill="#3a3a3a" style={{display : this.props.tooltipDisplay}} />
                    <text x = {12} y = {45} fill="red" style={{display : this.props.tooltipDisplay}} alignmentBaseline="middle" textAnchor="middle" >
                        <tspan x={2} textAnchor="start" y = {-10} dy="1em" fill="darkgrey" >{(this.props.monthToolTip)+" "+(this.props.currentYear)}</tspan>

                        <tspan x={2} textAnchor="start" y = {5} dy="1.2em" fill="black" >Results</tspan>
                        <tspan x={11} textAnchor="middle" y = {28} dy="1.2em" fill="white" >{this.props.tooltipValue}</tspan>
                    </text>
                </g>
                <polygon points={points} style={{display : this.props.tooltipDisplay}} fill="#0a0000" />
            </g>

        )
    }
}
export default ToolTipMobileComponent;