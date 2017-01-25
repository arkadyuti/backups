import * as d3 from 'd3';
import d3Tip from 'd3-tip';
d3.tip = d3Tip;
import '../../../styles/Dashboard/Skill-based-chart/SkillBasedChart.scss';

function SkillBasedChartCallBack (response) { 
	//Uses the response data and stores in two arrays
	let responseLength = Object.keys(response[0]).length;
	let frameworks = [],
    	values = [];
   
	for(var i=0; i<responseLength; i++){
		frameworks[i] = response[0][i].label;
		values[i] = parseInt(response[0][i].value);
	}

	let margin = { left: 10, top: 10, right: 10, bottom: 10 },
		width = d3.select("#skillBasedChartWrapper").node().clientWidth,
		height = 370,
		xRange = width - 120,
		yRange = 350,
	    barWidth = yRange/(frameworks.length)-7,
	    xTranslate = margin.left+70 ,
	    yTranslate = margin.top+10 ;

	//Appends the svg to the container div    
    let svg = d3.select('#skillBasedChartWrapper')
				.append('svg')
				.attr('id','svgContainer')
				.style('width',width)
    			.style('height',height);

    //Creates the x-axis scale
    let xScale =  d3.scaleLinear()
    				.domain([0,d3.max(values)])
    				.range([0, xRange]);

    //Defines the x-axis styles
    let xAxis = d3.axisTop(xScale)
				  .tickArguments([10])
				  .tickSize(1);

	//Appends the x-axis to the svg
	let xAxisGroup = svg.append('g')
       					.attr('class', 'xaxis')
						.call(xAxis)
				        .attr('transform', 'translate('+xTranslate+','+yTranslate+')')
				        .style('font-size',12);  


	//Creates the y-axis scale
	let yScale = d3.scaleBand()
				   .domain(frameworks)
				   .range([0, yRange]);

    //Defines the y-axis styles
    let yAxis = d3.axisLeft(yScale)
				  .tickArguments([frameworks.length])
				  .tickSize(1);

    
    //Appends the y-axis to the svg
	let yAxisGroup = svg.append('g')
					   .attr('class', 'yaxis')
					   .call(yAxis)
					   .attr('transform', 'translate('+xTranslate+','+yTranslate+')')
					   .style('font-size',12);
	/*var y = document.getElementsByClassName('yaxis');
*/
   /*console.log('test'+d3.selectAll("yaxis").datum());
	*/
	/*function shorten(text, maxLength) {

		var ret = text;
		if (ret.length > maxLength) {
		ret = ret.substr(0,maxLength-3) + “…”;
		}
		return ret;
	}*/
	
	//Creates tooltip and attaches to the svg
    let toolTip = d3.tip()
				.attr('class', 'd3-tip')
				.offset([-5, 10])
				.html(function(data,index) {
					return ("<span>Framework:</span> <span style='color:skyblue'><strong>"+frameworks[index]+"</strong></span><br><span>Number Of Projects:</span> <span style='color:skyblue'><strong>"+values[index]+"</strong></span>");
				})
	svg.call(toolTip);

	//Creates gradient 
	let gradient = svg.append("defs")
					  .append("linearGradient")
					    .attr("id", "gradient")
					    .attr("x1", "0%")
					    .attr("y1", "0%")
					    .attr("x2", "100%")
					    .attr("y2", "0%");

	gradient.append("stop")
	    .attr("offset", "0%")
	    .attr("stop-color", "#1E90FF");

	gradient.append("stop")
	    .attr("offset", "100%")
	    .attr("stop-color", "#33C5FF");

	//Event handlers    
	let mouseoverTooltip = (data,index) => {
	    	return(toolTip.show(data,index),
	    		   d3.event.currentTarget.style.fill='#2B4F81');	
	}

	let mouseoutTooltip = () => {
	    	return(toolTip.hide(),
				   d3.event.currentTarget.style.fill='url(#gradient)');	
	} 

	//Creates the horizontal bars and appends to the svg
	let hBarChart= svg.append('g')
					  .attr('transform', 'translate('+xTranslate+','+yTranslate+')')
					  .selectAll('rect')
					  .data(values)
					  .enter()
					  .append('rect')
					  .attr('class','bars')
					  .style('height',barWidth)
					  .attr('x',1)
					  .attr('y',(data,index) => index*(yRange/(values.length))+5)
				      .style('fill','url(#gradient)')
					  .attr('width',(data) => xScale(data))
					  .on("mouseover", mouseoverTooltip)
					  .on("mouseout", mouseoutTooltip)	;

	//Creates labels beside each bar
	let barText = hBarChart.select('text')
						  .data(values)
						  .enter()
						  .append('text')
						  .attr('x',(data) => xScale(data)+8)
						  .attr('y',(data,index) => index*(yRange/(values.length))+23)
						  .text((data) => data);

    //RESPONSIVENESS
	d3.select(window).on("resize", resizedChart);
	console.log(d3.select("#skillBasedChartWrapper").node().clientWidth);
	
	function resizedChart(){

		var newWidth = d3.select("#skillBasedChartWrapper").node().clientWidth;
	    
	    d3.select("#svgContainer")
	      .style("width", newWidth);

	    let newSvgWidth = d3.select("#svgContainer").node().clientWidth;
	   
	    //Updates x-axis according to the new width of the svg
		xScale =  d3.scaleLinear()
	    		.domain([0,d3.max(values)])
	    		.range([0, newSvgWidth-120]);

	    xAxis = d3.axisTop(xScale)
					.tickArguments([10])
					.tickSize(1);
	    
	    xAxisGroup.call(xAxis);
	    
	    //Updates bars according to the new width of the svg 
	    hBarChart.attr("width", (data) => xScale(data));

	    //Updates labels according to the new width of the svg
	    barText.attr("x", (data) => xScale(data) + 5 )
	     	   .attr('y', (data,index) => index*(yRange/(values.length))+25)
    }

}
export default SkillBasedChartCallBack;
