import * as d3 from 'd3';

function SkillBasedChartCallBack (response) { 
	let responseLength = Object.keys(response[0]).length;
	let frameworks = [],
    	values = [];
    	console.log(responseLength);
	for(var i=0;i<responseLength;i++){
		frameworks[i] = response[0][i].label;
		values[i] = parseInt(response[0][i].value);
	}

	console.log(frameworks);
	console.log(values);

	function getRatio(side) {
	 return (( margin[side] / width ) * 100) + '%';
	}

	let margin = { left: 90, top: 10, right: 90, bottom: 30 },
	width = 610,
	height = 400,
	marginRatio = { 
      left:   getRatio('left'), 
      top:    getRatio('top'), 
      right:  getRatio('right'), 
      bottom: getRatio('bottom')
    },
    barWidth = height/(frameworks.length)-7,
    xTranslate = 0 ,
    yTranslate = 20 ;

    let svg = d3.select('div#wrapper')
    			.append('div')
    			.classed('svg-container',true)
    			.append('svg')
    			.attr('id','skillBasedSvg')
    			.style('padding', marginRatio.top + ' ' + marginRatio.right +  ' ' + marginRatio.bottom +  ' ' + marginRatio.left )
    			.attr('preserveAspectRatio', 'xMinYMin meet')
    			.attr('viewBox', '0 0 ' + ( width + margin.left + margin.right  )+ ' 400');

    let x =  d3.scaleLinear()
    		.domain([0,d3.max(values)])
    		.range([0, width]);

    let xAxis = d3.axisTop(x)
				.tickArguments([10])
				.tickSize(1);

	let y = d3.scaleBand()
				.domain(frameworks)
				.range([0,height],0.1,0.1);

    let yAxis = d3.axisLeft(y)
				.tickArguments([frameworks.length])
				.tickSize(1);

	let colors = ['#00BFFF'];

	let colorScale = d3.scaleQuantize()
					.domain([0,frameworks.length])
					.range(colors);
	 
	svg.append('g')
       .attr('class', 'x axis')
       .call(xAxis)
       .attr('transform', 'translate('+xTranslate+','+yTranslate+')');  

	svg.append('g')
	   .attr('class', 'y axis')
	   .call(yAxis)
	   .attr('transform', 'translate('+xTranslate+','+yTranslate+')');

	let hBarChart= svg.append('g')
					  .attr('transform', 'translate('+xTranslate+','+yTranslate+')')
					  .selectAll('rect')
					  .data(values)
					  .enter()
					  .append('rect')
					  .attr('class','bars')
					  .attr('height',barWidth)
					  .attr('x',1)
					  .attr('y',function(data,index){ return index*(height/(values.length))+8; })
				      .style('fill',function(data,index){ return colorScale(index); })
					  .attr('width',function(data){
							return x(data);
					   });


   let barText = hBarChart.select('text')
						  .data(values)
						  .enter()
						  .append('text')
						  .classed('barText',true)
						  .attr('x',function(data){
						   		return x(data)+10;
						   })
						  .attr('y',function(data,index){
						   		return index*(height/(values.length))+25;
						   })
						  .text(function(data){
						   	return data;
						   });

	   


 

}
export default SkillBasedChartCallBack;
