import React, { Component } from 'react'

import Arc from '../../../../containers/Dashboard/StatusChart/arc/index'
import * as d3 from 'd3'
import Legend from '../legend/index'
import ColorLuminance from '../../../colorLuminance/index'
import LinearGradient from '../..//statusChart/linearGradient/index'


export default class Pie extends Component {

    constructor(props) {
        super(props);

        this.state = {
            hover:"",
            ArcHover:""
        }

    }

    _handleHover(index) {
        this.setState ({
            hover:index
        })
    } // setting hover property on the correct legend group => in <legend>
    // hover-active class set

    _handleHoverOut() {
        this.setState ({
            hover:""
        })
    } // setting hover out to remove glow on legend

    _passLegendtoArc(i) {
        this.setState({
            ArcHover:i
        })
    } // on hovering on legend, arc should have glow. Setting state on appropriate ARC

    _handleHoverOutLegendOnArc() {
        this.setState({
            ArcHover:""
        })
    } // handling hover out on legend, ARC stops GLOWING

    _pieSlice(value,i,color) {
        return (
            <Arc key = {i}
                 index={i}
                 handleHover = {::this._handleHover}
                 handleHoverOut ={::this._handleHoverOut}
                 value = {value}
                 fill = {color}
                 label = {this.props.label}
                 ArcHover={this.state.ArcHover}/>
        );
    } // this creates every arc for the pie

    render () {
        var color = this.props.color;
        if(color.length === 0) {
            color = ["#3f25a3","#dd2e2f","#32c8b7"]; // defining first
            // three colours as seen in PSD for only first chart.
            var colours = d3.scaleOrdinal(d3.schemeCategory10);
            this.props.data.map((item,i) => {
                color.push(colours(i));
            }) // pushing extra colours into the array according to the
            // length of data
        }

        var pie = d3.pie();

        return (
            <div className = {`status-svg-container col-md-4 col-sm-6 col-xs-12`}>

                <svg width = {this.props.outerRadius * 2} // exact width so as to fit chart in svg
                     height = {this.props.outerRadius * 2} // exact height so as to fit chart in svg
                     className={`svg${this.props.uniqueId}`}>
                    {/* classname of svg0, svg1, svg2 to have more control */}

                    {this.props.label.map((value,i) => {
                        return <LinearGradient key ={`status${value}`} id={`status${value}`}
                                               x1="0%"
                                               y1="0%"
                                               x2="100%"
                                               y2="0%"
                                               startColor = {color[i]}
                                               stopColor = {ColorLuminance(color[i],-0.3)} >
                        </LinearGradient>})}
                    {/* Linear gradient given with an id = label. eg-"statusred", "statusBangalore" ,
                     this is used in arc component for FILL */}

                    <g transform = {`translate(${this.props.outerRadius}, ${this.props.outerRadius})`}>
                        {/* translating chart to exact center of svg to equal radius of chart */}
                        {pie(this.props.data).map((value,i) => ::this._pieSlice(value,i,color[i]))}
                    </g>

                </svg>

                <Legend hover = {this.state.hover} // to highlight legend on hover of arc
                        color = {color}
                        label = {this.props.label}
                        data = {this.props.data}
                        total = {this.props.total}
                        passLegendtoArc = {::this._passLegendtoArc} // returned from legend and passed to arc
                    // for HIGHLIGHTING ARC on hover of legend
                        handleHoverOutLegendOnArc = {::this._handleHoverOutLegendOnArc}>
                    {/*  handling hover out to arc */}
                </Legend>

            </div>
        )
    }
}