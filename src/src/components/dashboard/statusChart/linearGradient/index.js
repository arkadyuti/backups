/**
 * Created by amuru1 on 12/7/2016.
 */
import React from 'react'

export default (props) => {

		return (<defs>
                    <linearGradient id={props.id} x1={props.x1} y1={props.y1} x2={props.x2} y2={props.y2}>
             			<stop offset="0%" stopColor={props.startColor}></stop>
                		<stop offset="100%" stopColor={props.stopColor}></stop>
                	</linearGradient>
                </defs>)
}