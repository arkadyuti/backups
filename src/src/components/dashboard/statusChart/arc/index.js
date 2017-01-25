/**
 * Created by amuru1 on 12/9/2016.
 */
import React, { Component, PropTypes } from 'react'
import * as d3 from 'd3'

export default (props) => {

        var arcStyle = (props.ArcHover === props.index )?{opacity : 0.4}:{};
        var arc = d3.arc()
            .innerRadius(props.Radius.innerRadius)
            .outerRadius(props.Radius.outerRadius);

        return (
            <path d = {arc(props.value)}
                  fill = {`url(#status${props.label[props.index]})`}
                  style = {arcStyle}
                  onMouseOver = {() => {props.handleHover(props.index)}}
                  onMouseOut ={props.handleHoverOut} />
        )
    }