/**
	Logic function for Skill Based Chart.
	@param {object} response - API response
**/

import * as d3 from 'd3';
import d3Tip from 'd3-tip';
d3.tip = d3Tip;


let skillBasedChartCallBack = (response) => {
	let responseLength = Object.keys(response[0]).length;
	let frameworks = [],
		values = [],
		newFrameworks = [],
		margin,
		width,
		height,
		xRange,
		yRange,
		barWidth,
		xTranslate,
		yTranslate,
		svg,
		xScale,
		xAxis,
		xAxisGroup,
		yScale,
		yAxis,
		yAxisGroup,
		axisTooltip,
		toolTip,
		gradient,
		hBarChart,
		barText,
		transit;
    //Splits the object into Freameworks and Values
    for(var i=0; i<responseLength; i++){
		frameworks[i] = (response[0][i]).label;
		values[i] = parseInt(response[0][i].value);
	}

	
	for(i=0;i<frameworks.length;i++){
		newFrameworks.push(frameworks[i]);
	}

	for(i=0;i<newFrameworks.length;i++){
		var temp = newFrameworks[i];
		if(temp.length>11){
			temp = temp.substr(0,10) + '...';
			newFrameworks[i]=temp;
		}
	}

	//Positioning the SVG
	margin = { left: 10, top: 10, right: 10, bottom: 10 };
	width = d3.select(".skillBasedChartWrapper").node().clientWidth;
	height = 370;
	xRange = (width - 120);
	yRange = 350;
    barWidth = yRange/(frameworks.length)-7;
    xTranslate = margin.left+70 ;
    yTranslate = margin.top+10 ;

	//Appends the svg to the container div
    svg = d3.select('.skillBasedChartWrapper') 
				.append('svg')
				.attr('id','svgContainer')
				.attr('width',width)
    			.attr('height',height);

    //Creates the x-axis scale
    xScale =  d3.scaleLinear()
    				.domain([0,d3.max(values)])
    				.range([0, xRange]);


    xAxis = d3.axisTop(xScale)
				  .tickArguments([10])
				  .tickSize(1);

	//Appends the x-axis to above SVG
	xAxisGroup = svg.append('g')
       					.attr('class', 'xaxis')
						.call(xAxis)
				        .attr('transform', 'translate('+xTranslate+','+yTranslate+')')
				        .style('font-size',12+'px')
				        .style('font-family','SapientSansRegular');  

	//Creates the y-axis scale
	yScale = d3.scaleBand()
				   .domain(newFrameworks)
				   .range([0, yRange]);
    yAxis = d3.axisLeft(yScale)
				  .tickArguments([frameworks.length])
				  .tickSize(1);

	//Appends the y-axis to the svg
	yAxisGroup = svg.append('g')
					    .attr('class', 'yaxis')
					    .call(yAxis)
					    .attr('transform', 'translate('+xTranslate+','+yTranslate+')')
					    .style('font-size',12+'px')
					    .style('font-family','SapientSansRegular')
					    .on('mouseover',(data,index) =>{
							let textLength = d3.event.target.innerHTML.length;
					   		if(textLength>11){
					   			return axisTooltip.show(d3.event.target.innerHTML);
					   		}
					   	})
					    .on('mouseout',(data,index) => {
					 		axisTooltip.hide();
					    });

	//Applies tooltips for Ellipses for character more than 10
	axisTooltip = d3.tip()
						.attr('class', 'd3-tip')
						.offset([-5, 10])
						.html((tooltipData) => {
							for(i=0;i<frameworks.length;i++){
								if(newFrameworks[i]===tooltipData){
									return ("<span>"+frameworks[i]+"</span>");
								}
							}
						});
	svg.call(axisTooltip);

	//Creates Bar tooltip and attaches to the svg
    toolTip = d3.tip()
					.attr('class', 'd3-tip')
					.offset([-5, 10])
					.html((data,index) => {
						return ("<span>Framework:</span> <span style='color:skyblue'><strong>"+frameworks[index]+"</strong></span><br><span>Open Needs:</span> <span style='color:skyblue'><strong>"+values[index]+"</strong></span>");
					})
	svg.call(toolTip);

	//Creates gradient 
	gradient = svg.append("defs")
					  .append("linearGradient")
					  .attr("id", "gradient")
					  .attr("x1", 0+'%')
					  .attr("y1", 0+'%')
					  .attr("x2", 100+'%')
					  .attr("y2", 0+'%');

	gradient.append("stop")
		    .attr("offset", 0+'%')
		    .attr("stop-color", "#1E90FF");

	gradient.append("stop")
		    .attr("offset", 100+'%')
		    .attr("stop-color", "#33C5FF");

	//Event handlers for Bar tooltip
	let mouseoverTooltip = (data,index) => {
    	return(toolTip.show(data,index),d3.event.currentTarget.style.fill='#2B4F81');	
	}

	let mouseoutTooltip = () => {
	    return(toolTip.hide(),d3.event.currentTarget.style.fill='url(#gradient)');	
	} 

	//Appends the horizontal bars and appends to the svg
	hBarChart= svg.append('g')
					  .attr('transform', 'translate('+xTranslate+','+yTranslate+')')
					  .selectAll('rect')
					  .data(values)
					  .enter()
					  .append('rect')
					  .attr('class','bars')
					  .attr('height',barWidth)
					  .attr('x',1)
					  .attr('y',(data,index) => index*(yRange/(values.length))+5)
				      .attr('fill','url(#gradient)')
					  .attr('width',(data) => 0/*xScale(data)*/)
					  .on("mouseover", mouseoverTooltip)
					  .on("mouseout", mouseoutTooltip)	;

	//Appends labels beside each bar
	barText = hBarChart.select('text')
						   .data(values)
						   .enter()/**/
						   .append('text')
						   .attr('x',(data) => xScale(data)+8)
						   .attr('y',(data,index) => index*(yRange/(values.length))+23)
						   .text((data) => data)
						   .style('font-family','SapientSansMedium');
	
	//Transition animation while Loading
	transit =svg.selectAll("rect")
				    .data(values)
				    .transition()
				    .duration(1000) 
				    .attr("width",(data) => {return xScale(data); });


    //For Responsive Devices
    let resizedChart= () => {
		
		//Accomodates into the Client Width
		var newWidth = d3.select(".chart-name").node().clientWidth-30;
	    d3.select("#svgContainer")
	      .attr("width", newWidth);
	    
		xScale =  d3.scaleLinear()
	    		    .domain([0,d3.max(values)])
	    		    .range([0, newWidth-100]);

	    xAxis = d3.axisTop(xScale)
				  .tickArguments([10])
				  .tickSize(1);
	    
	    xAxisGroup.call(xAxis);
	    
	    hBarChart.attr("width", (data) => xScale(data));

	    barText.attr("x", (data) => xScale(data) + 5 )
	     	   .attr('y', (data,index) => index*(yRange/(values.length))+25)
    }
	
	//Call Resize event for current width
	d3.select(window).on('resize', resizedChart);

}

export default skillBasedChartCallBack;
