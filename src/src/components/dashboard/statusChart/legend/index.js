import React, { Component } from 'react';
import Tooltip from 'react-tooltip-component';

class Legend extends Component {

    constructor(props) {
        super(props);

        this.state = {
            activeLegend : ""
        }
    }
    _handleHoverOnLegend(evt,i) {
        this.setState({
            activeLegend:i
        })
        this.props.passLegendtoArc(i);
    }

    _handleHoverOutLegend() {
        this.setState({
            activeLegend:""
        })
        this.props.handleHoverOutLegendOnArc();
    }

    _handleEllipsisClass(i) {
        return (this.props.label[i].length > 5)?  "legend-group-ellipsis": "legend-group"
    } // ellipsis classnames given to enable tooltip on them

    _handleHoverClass(i) {
        return (i === this.props.hover)? "hover-active" : "hover-not-active"
    }// handling hover classNames to give more control

    _legendGroup(value,i) {
        var ellipsisText = "";
        var circleStyle = {
            background:this.props.color[i]
        }; // this is for the circle in legend

        var textStyle = (i === this.props.hover || this.state.activeLegend === i)?
            { color:this.props.color[i],
                fontWeight: "bold",
                opacity:1 } : {};
        // textStyle so that on hover of arc, or hover on legend itself the corresponding legend item GLOWS

        var percentage = ((this.props.data[i] / this.props.total)*100).toFixed(2); // percentage upto two decimal points
        var text = this.props.label[i].toUpperCase();
        if(text.length > 5) {
            text = text.substring(0,5)+"...";
            ellipsisText = this.props.label[i].toUpperCase();
        } // adding ellipsis
        // ellipsisText is given some value only for ellipsis else it is ""


        return(
            <Tooltip key={i} title={ellipsisText} position='top'>
                <li key={text}
                         className={`${::this._handleEllipsisClass(i)}`}
                         onMouseOver={(evt) => ::this._handleHoverOnLegend(evt,i)}
                         onMouseOut={::this._handleHoverOutLegend}>
                    <span className="status-chart-legend-color"
                          style={circleStyle}>
                    </span>
                    <span style={textStyle}
                          className={`${::this._handleHoverClass(i)}`} >
                          {`${text} ${percentage}%`}
                    </span>
                </li>
            </Tooltip>

        ) // React-tooltip enclosing TAG added only for required LI items.
    }

    render() {
        return(
			<ul>
                {this.props.data.map(::this._legendGroup)}
			</ul>
        )
    }
}

export default Legend